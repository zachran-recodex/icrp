<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Hero;
use App\Models\CallToAction;

uses(RefreshDatabase::class);

it('returns a successful response', function () {
    // Create test data
    Hero::factory()->create();
    CallToAction::factory()->create();
    
    $response = $this->get('/');

    $response->assertStatus(200);
});
