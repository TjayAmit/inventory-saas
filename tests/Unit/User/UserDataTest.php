<?php

use App\Data\UserData;
use Illuminate\Http\Request;

it('should create a user data', function () {
    $userData = new UserData(
        id: null,
        first_name: 'John',
        last_name: 'Doe',
        middle_name: 'Doe',
        ext_name: 'Doe',
        address: 'Doe',
        email: 'john@example.com',
        password: 'password',
        role: 'Tenant Admin',
    );

    expect($userData)->toBeInstanceOf(UserData::class);
    expect($userData->firstName)->toBe('John');
    expect($userData->lastName)->toBe('Doe');
    expect($userData->middleName)->toBe('Doe');
    expect($userData->extName)->toBe('Doe');
    expect($userData->address)->toBe('Doe');
    expect($userData->email)->toBe('john@example.com');
    expect($userData->password)->toBe('password');
    expect($userData->role)->toBe('Tenant Admin');
});

it('should create a user data from request', function () {
    $userData = UserData::fromRequest(new Request([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'middle_name' => 'Doe',
        'ext_name' => 'Doe',
        'address' => 'Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'role' => 'Tenant Admin',
    ]));

    expect($userData)->toBeInstanceOf(UserData::class);
    expect($userData->firstName)->toBe('John');
    expect($userData->lastName)->toBe('Doe');
    expect($userData->middleName)->toBe('Doe');
    expect($userData->extName)->toBe('Doe');
    expect($userData->address)->toBe('Doe');
    expect($userData->email)->toBe('john@example.com');
    expect($userData->password)->toBe('password');
    expect($userData->role)->toBe('Tenant Admin');
});

it('should convert user data to array', function () {
    $userData = UserData::fromRequest(new Request([
        'first_name' => 'John',
        'last_name' => 'Doe',
        'middle_name' => 'Doe',
        'ext_name' => 'Doe',
        'address' => 'Doe',
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
