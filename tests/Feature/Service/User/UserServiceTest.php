<?php

use App\Data\UserData;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\User\CreateUserService;
use Mockery;

it('should register a user', function () {
    $mockRepo = Mockery::mock([UserRepositoryInterface::class]);
    $mockRepo->shouldReceive('create')->andReturn(new User([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'role' => 'Tenant Admin',
    ]));

    $userService = new CreateUserService($mockRepo[0]);

    $userData = UserData::fromRequest(new Request([
        'name' => 'John Doe',
        'email' => 'john@example.com',
        'password' => 'password',
        'role' => 'Tenant Admin',
    ]));
    
    $result = $userService->handle($userData);

    expect($result)->toBeInstanceOf(User::class);
    expect($result->name)->toBe('John Doe');
    expect($result->email)->toBe('john@example.com');
    expect($result->role)->toBe('Tenant Admin');
}); 
