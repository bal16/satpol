<?php

namespace App\Services;

use App\Contracts\ImageStorage;
use App\Data\ProfileItemData;
use App\Models\ProfileItems;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProfileItemService
{
    public function __construct(private ImageStorage $images) {}

    public function list(): Collection
    {
        return ProfileItems::all();
    }

    public function update(ProfileItems $item, ProfileItemData $data, ?UploadedFile $photo = null): ProfileItems
    {
        return DB::transaction(function () use ($item, $data, $photo) {
            $updateData = [
                'title' => $data->title,
                'type' => $data->type,
                'show' => $data->show,
                'content' => $item->content,
                'body' => $item->body,
            ];

            if ($data->type === 'image') {
                if ($photo) {
                    $this->images->delete($item->content);
                    $updateData['content'] = $this->images->store($photo, 'profile_images');
                }

                $updateData['body'] = null;
            } elseif ($data->type === 'text') {
                $updateData['content'] = $data->contentText;
                $updateData['body'] = null;

                if ($item->type === 'image' && $item->content) {
                    $this->images->delete($item->content);
                }
            } elseif ($data->type === 'html') {
                $updateData['body'] = $data->body;
                $updateData['content'] = null;

                if ($item->type === 'image' && $item->content) {
                    $this->images->delete($item->content);
                }
            }

            $item->update($updateData);

            return $item;
        });
    }
}
