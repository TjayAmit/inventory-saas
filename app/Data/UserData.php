<?php

namespace App\Data;

use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public ?int $id;
    public string $name;
    public string $email;
    public string $password;
    public string $role;

    public function __construct(
        ?int $id,
        string $name,
        string $email,
        string $password,
        string $role,
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            id: $request->id,
            name: $request->name,
            email: $request->email,
            password: $request->password,
            role: $request->role,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
        ];
    }
}
