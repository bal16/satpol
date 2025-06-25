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
        // Base validation rules
        $rules = [
            'title' => 'required|string|max:255',
            'type' => 'required|string|in:text,image,html',
            'show' => 'boolean',
        ];

        // Add type-specific validation rules
        $type = $request->input('type');
        if ($type === 'image') {
            // Image is only required if there isn't one already. Otherwise, it's optional.
            $rule = $profileItem->content ? 'nullable' : 'required';
            $rules['content_image'] = [$rule, 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'];
        } elseif ($type === 'text') {
            $rules['content_text'] = 'required|string';
        } elseif ($type === 'html') {
            $rules['body'] = 'required|string';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('admin.profile.edit', $profileItem->id)
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $validatedData = $validator->validated();

            // Prepare data for update
            $updateData = [
                'title' => $validatedData['title'],
                'type' => $validatedData['type'],
                'show' => $request->has('show'),
                'content' => $profileItem->content, // Default to old content
                'body' => $profileItem->body, // Default to old body
            ];

            // Handle content based on type
            if ($updateData['type'] === 'image') {
                if ($request->hasFile('content_image')) {
                    // Delete old image if it exists
                    if ($profileItem->content && Storage::disk('public')->exists($profileItem->content)) {
                        Storage::disk('public')->delete($profileItem->content);
                    }
                    // Store new image and update path
                    $imagePath = $request->file('content_image')->store('profile_images', 'public');
                    $updateData['content'] = $imagePath;
                }
                // Clear body if switching to image type
                $updateData['body'] = null;
            } elseif ($updateData['type'] === 'text') {
                $updateData['content'] = $validatedData['content_text'];
                // Clear body if switching to text type
                $updateData['body'] = null;
                // Delete old image if switching from image type
                if ($profileItem->type === 'image' && $profileItem->content && Storage::disk('public')->exists($profileItem->content)) {
                    Storage::disk('public')->delete($profileItem->content);
                }
            } elseif ($updateData['type'] === 'html') {
                $updateData['body'] = $validatedData['body'];
                // Clear content if switching to html type
                $updateData['content'] = null;
                // Delete old image if switching from image type
                if ($profileItem->type === 'image' && $profileItem->content && Storage::disk('public')->exists($profileItem->content)) {
                    Storage::disk('public')->delete($profileItem->content);
                }
            }

            $profileItem->update($updateData);
            return redirect()->route('admin.profile')->with('success', 'Profile item berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->route('admin.profile.edit', $profileItem->id)->with('error', 'Gagal memperbarui item profile: ' . $e->getMessage())->withInput();
        }
    }
}
