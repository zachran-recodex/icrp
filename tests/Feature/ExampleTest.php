<?php

use App\Models\CallToAction;
use App\Models\Hero;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('returns a successful response', function () {
    // Create test data
    Hero::factory()->create();
    CallToAction::factory()->create();

    $response = $this->get('/');

    $response->assertStatus(200);
});
