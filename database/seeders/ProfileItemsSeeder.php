<?php

namespace Database\Seeders;

use App\Models\ProfileItems;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfileItemsSeeder extends Seeder
{
    use Helper;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->makeCollectionfromJSON($this->dataPath("profiles.json"))->each(function ($item) {
            ProfileItems::create([
                'title' => $item->title,
                'type' => $item->type ?? "text",
                'content' => $item->content ?? null,
                'show' => $item->show ?? false,
                'html' => $item->type == "html" ? $item->content : null,
            ]);
        });
    }
}
