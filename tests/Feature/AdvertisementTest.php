<?php

use App\Models\Advertisement;
use App\Models\User;
use Livewire\Livewire;

it('can display manage advertisements page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/dashboard/manage-advertisements')
        ->assertSuccessful()
        ->assertSeeLivewire('dashboard.manage-advertisements');
});

it('can create new advertisement when none exists', function () {
    $user = User::factory()->create();

    Livewire::actingAs($user)
        ->test('dashboard.manage-advertisements')
        ->set('is_active', true)
        ->call('save')
        ->assertHasNoErrors();

    expect(Advertisement::where('is_active', true)->exists())->toBeTrue();
});

it('can update existing advertisement', function () {
    $user = User::factory()->create();

    // Clear existing data and create new
    Advertisement::truncate();
    Advertisement::create([
        'image' => null,
        'is_active' => false,
    ]);

    Livewire::actingAs($user)
        ->test('dashboard.manage-advertisements')
        ->assertSet('is_active', false)
        ->set('is_active', true)
        ->call('save')
        ->assertHasNoErrors();

    $advertisement = Advertisement::first();
    expect($advertisement->is_active)->toBeTrue();
});

it('loads existing advertisement data on mount', function () {
    $user = User::factory()->create();

    // Clear existing data and create new
    Advertisement::truncate();
    Advertisement::create([
        'image' => null,
        'is_active' => false,
    ]);

    Livewire::actingAs($user)
        ->test('dashboard.manage-advertisements')
        ->assertSet('is_active', false);
});

it('can render popup component', function () {
    // Test that popup component can be rendered without errors
    Livewire::test('popup-iklan')
        ->assertSuccessful();
});

it('does not show popup when no active advertisement exists', function () {
    Advertisement::create([
        'image' => null,
        'is_active' => false,
    ]);

    Livewire::test('popup-iklan')
        ->assertSet('showPopup', false);
});

it('does not show popup when no advertisement exists', function () {
    Livewire::test('popup-iklan')
        ->assertSet('showPopup', false);
});
