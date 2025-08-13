<?php

use App\Data\UserData;
use Illuminate\Http\Request;

it('should create a user data', function () {
    $userData = new UserData(
        id: null,
        name: 'John Doe',
        email: 'john@example.com',
        password: 'password',
        role: 'Tenant Admin',
    );

    expect($userData)->toBeInstanceOf(UserData::class);
    expect($userData->name)->toBe('John Doe');
    expect($userData->email)->toBe('john@example.com');
    expect($userData->password)->toBe('password');
    expect($userData->role)->toBe('Tenant Admin');
});

it('should create a user data from request', function () {
    $userData = UserData::fromRequest(new Request([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'role' => 'Tenant Admin',
    ]));

    expect($userData)->toBeInstanceOf(UserData::class);
    expect($userData->name)->toBe('John Doe');
    expect($userData->email)->toBe('john@example.com');
    expect($userData->password)->toBe('password');
    expect($userData->role)->toBe('Tenant Admin');
});

it('should convert user data to array', function () {
    $userData = UserData::fromRequest(new Request([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'role' => 'Tenant Admin',
    ]));

    expect($userData->toArray())->toBe([
        'id' => null,
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'role' => 'Tenant Admin',
    ]);
});
