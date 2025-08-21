<?php

namespace App\Data;

use Illuminate\Http\Request;

class AdminDto
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email,
        public string $password,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            id: $request->id,
            name: $request->name,
            email: $request->email,
            password: $request->password,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}