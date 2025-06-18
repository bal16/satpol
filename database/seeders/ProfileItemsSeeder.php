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
                'type' => isset($item->type) ? $item->type : "text",
                'content' => isset($item->content) ? $item->content : null,
                'show' => isset($item->show) ? $item->show : false,
            ]);
        });
    }
}
