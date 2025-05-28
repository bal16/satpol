<?php
 
use App\Models\News;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
 
return new class extends Migration
{
    public function up(): void
    {
        News::withoutTouching(function () {
            News::withoutTimestamps(function () {
                News::query()->withoutGlobalScopes()->eachById(function (News $news) {
                    $news->update([
                        'body' => $news->body,
                    ]);
                });
            });
        });
 
 
        Schema::dropColumns('news', 'body');
    }
};