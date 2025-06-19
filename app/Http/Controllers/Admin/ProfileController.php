<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SOP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\ProfileItems;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman pengelolaan p.
     */
    public function index()
    {
        // Ambil data p dari database, diurutkan berdasarkan slot_number
        // dan di-key berdasarkan slot_number untuk memudahkan pencarian
        $profileItems = ProfileItems::all();


        return view('admin.profile.index', [
            'items' => $profileItems,
        ]);
    }

    /**
     * Show the form for editing the specified profile item.
     */
    public function edit(ProfileItems $profileItem) // Route model binding
    {
        return view('admin.profile.edit', [
            'item' => $profileItem,
        ]);
    }


    /**
     * Update the specified profile item in storage.
     */
    public function update(Request $request, ProfileItems $profileItem)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'type' => 'required|string|max:50', // e.g., text, image_url, json_list
            'body' => 'nullable|string',
            'show' => 'boolean',
        ];

        // dd($request->all());

        // Adjust validation rules for content based on type
        if ($request->input('type') === 'image') {
            // If a new image is being uploaded, it's required or can be nullable if keeping old image is an option
            // For simplicity, let's make it nullable, meaning if no new file is sent, old content (path) is kept or cleared.
            // If a file is sent, it must be an image.
            $rules['content'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'; // Max 2MB
        } else {
            $rules['content'] = 'nullable|string';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            dd($validator->errors());

            return redirect()->route('admin.profile.edit', $profileItem->id)
                        ->withErrors($validator)
                        ->withInput();
        }



        try {
            $validatedData = $validator->validated();
            // Ensure 'show' is present, as checkboxes don't send value if unchecked
            // dd($validatedData);
            $validatedData['show'] = $request->has('show');


            // Handle image upload if type is 'image' and a file is present
            if ($validatedData['type'] === 'image' && $request->hasFile('content')) {
                // Delete old image if it exists
                if ($profileItem->content && Storage::disk('public')->exists($profileItem->content)) {
                    Storage::disk('public')->delete($profileItem->content);
                }
                // Store new image
                $imagePath = $request->file('content')->store('profile_images', 'public');
                $validatedData['content'] = $imagePath;
            } elseif ($validatedData['type'] !== 'image' && $profileItem->type === 'image' && $profileItem->content) {
                // If type changed from image to something else, delete the old image
                if (Storage::disk('public')->exists($profileItem->content)) {
                    Storage::disk('public')->delete($profileItem->content);
                }
            }
            // If type is 'image' but no new file is uploaded, $validatedData['content'] will be null from validation
            // if 'content' was not sent. We might want to keep the old image path in this case.
            // However, the current validation makes 'content' nullable, so if no file is sent,
            // $validatedData['content'] will not be set by $validator->validated() if it was not in the request.
            // If 'content' field is not sent at all (e.g. type changed from image to text and content field removed from form for image)
            // we need to ensure it's handled.
            // The current blade logic for type 'image' sends 'content' as a file input.
            // If type is 'image' and no new file is sent, and we want to keep the old image:
            if ($validatedData['type'] === 'image' && !$request->hasFile('content') && $profileItem->content) {
                $validatedData['content'] = $profileItem->content; // Keep old image path
            }

            $profileItem->update($validatedData);
            return redirect()->route('admin.profile')->with('success', 'Profile item berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.profile.edit', $profileItem->id)->with('error', 'Gagal memperbarui item profile: ' . $e->getMessage())->withInput();
        }
    }
}
