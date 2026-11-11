<?php

use App\Models\SOP;
use App\Models\User;

beforeEach(function () {
    $this->admin = User::factory()->admin()->create();
    $this->actingAs($this->admin);
});

test('admin can manage sop', function () {
    $this->post(route('admin.profile.sop.store'), [
        'title' => 'SOP 1',
        'link' => 'https://example.com/sop',
    ])->assertRedirect();

    $sop = SOP::first();
    expect($sop->title)->toBe('SOP 1');

    $this->put(route('admin.profile.sop.update', $sop), [
        'title' => 'SOP 2',
        'link' => 'https://example.com/sop2',
    ])->assertRedirect();

    $sop->refresh();
    expect($sop->title)->toBe('SOP 2');

    $this->delete(route('admin.profile.sop.destroy', $sop))->assertRedirect();
    expect(SOP::find($sop->id))->toBeNull();
});
