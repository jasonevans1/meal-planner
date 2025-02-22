<?php
declare(strict_types=1);

use function Pest\Gwt\scenario;
use function PHPUnit\Framework\assertEquals;
use App\Livewire\Actions\Logout;

scenario('User registers with valid data')
    ->given(function () {
        // I am logged out
        // laravel breeze logout test
        \Livewire\Livewire::test(Logout::class);
    })
    ->when(function () {
        // I sign up with valid user data
    })
    ->then(function () {
        // I should see a successful user registration message
    });
