<?php

use App\Models\ProfileItems;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        ProfileItems::withoutTouching(function () {
            ProfileItems::withoutTimestamps(function () {
                ProfileItems::query()->withoutGlobalScopes()->eachById(function (ProfileItems $item) {
                    $item->update([
                        'body' => $item->body,
                    ]);
                });
            });
        });


        // Schema::dropColumns('profileitems', 'body');
    }
};
