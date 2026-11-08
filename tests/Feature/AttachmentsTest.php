<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    Storage::fake('public');
    $this->admin = User::factory()->admin()->create();
    $this->actingAs($this->admin);
});

test('attachment upload returns url', function () {
    $file = UploadedFile::fake()->create('doc.pdf', 10, 'application/pdf');

    $response = $this->post(route('attachments.store'), [
        'attachment' => $file,
    ]);

    $response->assertOk()->assertJsonStructure(['attachment_url']);
});
