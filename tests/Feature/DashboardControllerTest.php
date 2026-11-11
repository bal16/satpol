<?php

namespace Tests\Feature;

// use App\Models\News;
// use Database\Seeders\SliderSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardControllerTest extends TestCase
{
    use RefreshDatabase;

    // protected function setUp(): void
    // {
    // parent::setUp();
    // Jalankan hanya seeder slider (hindari seeder lain yang mungkin berat)
    // $this->seed(SliderSeeder::class);
    // }

    public function test_dashboard_route_returns_successful_response(): void
    {
        $response = $this->get('/');

        $response
            ->assertStatus(200);

        // ->assertOk()
        // ->assertViewIs('dashboard');
        // ->assertViewHas(
        //     'sliders',
        //     fn($sliders) => $sliders->count() === 5
        // );
    }

    // public function test_news_latest_limit_5(): void
    // {
    //     News::factory()->count(7)->create();

    //     $response = $this->get('/');
    //     $response->assertOk();

    //     $response->assertViewHas('news', function ($news) {
    //         return $news->count() === 5;
    //     });
    // }
}
