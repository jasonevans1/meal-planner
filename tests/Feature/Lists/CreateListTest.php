<?php

namespace Tests\Feature\Lists;

use App\Models\User;
use Livewire\Volt\Volt;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

// Feature: Create List
//  As a user
//  I want to be able to create lists
//  So that I can organize tasks

// Given I am logged in
test('list creation screen can be rendered', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('to-do.create-todo-list')
        ->set('title', 'My Test List')
        ->set('description', 'List description');
    $component->call('submit');

    $component
        ->assertHasNoErrors()
        ->assertRedirect(route('lists', absolute: false));
});

// Scenario: User creates list with valid data
//      Given I am logged in
//      When the user creates a list with valid data
//      Then the user should see a successful created list message
test('user can create a list with valid data', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $component = Volt::test('to-do.create-todo-list')
        ->set('title', 'My Test List')
        ->set('description', 'List description');
    $component->call('submit');

    $component
        ->assertHasNoErrors()
        ->assertRedirect(route('lists', absolute: false));

    $listData = [
        'title' => 'My Test List',
        'description' => 'List description',
    ];

    $this->assertDatabaseHas('lists', [
        'title' => $listData['title'],
        'description' => $listData['description'],
        'user_id' => $user->id,
    ]);
});

// Scenario: User creates list without title
//      Given I am logged in
//      When the user creates a list without a title
//      Then the user should see a missing title message
test('user cannot create a list without a title', function () {
    $user = User::factory()->create();

    $listData = [
        'description' => 'This is a test list with no title',
    ];

    $this->actingAs($user);

    $component = Volt::test('to-do.create-todo-list')
        ->set('description', 'List description');
    $component->call('submit');

    $component
        ->assertHasErrors()
        ->assertNoRedirect();

    $this->assertDatabaseMissing('lists', [
        'description' => $listData['description'],
        'user_id' => $user->id,
    ]);
});
