<?php

namespace App\Http\Controllers\Admin;

use App\Data\ProfileItemData;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileItemsRequest;
use App\Models\ProfileItems;
use App\Services\ProfileItemService;

class ProfileController extends Controller
{
    public function __construct(private ProfileItemService $service) {}

    public function index()
    {
        return view('admin.profile.index', [
            'items' => $this->service->list(),
        ]);
    }

    public function edit(ProfileItems $profileItem)
    {
        return view('admin.profile.edit', [
            'item' => $profileItem,
        ]);
    }

    public function update(UpdateProfileItemsRequest $request, ProfileItems $profileItem)
    {
        $this->service->update(
            $profileItem,
            ProfileItemData::fromArray($request->validated()),
            $request->file('content_image')
        );

        return redirect()->route('admin.profile')->with('success', 'Profile item berhasil diperbarui.');
    }
}
