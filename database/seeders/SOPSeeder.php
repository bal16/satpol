<?php

namespace Database\Seeders;

use App\Models\SOP;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SOPSeeder extends Seeder
{
    use Helper;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->makeCollectionFromJSON($this->dataPath("sop.json"))->each(function ($sop) {
            SOP::create([
                'title' => $sop->title,
                'link' => $sop->link,
            ]);
        });
    }
}