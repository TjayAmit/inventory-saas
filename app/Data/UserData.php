<?php

namespace App\Data;

use Illuminate\Http\Request;
use Spatie\LaravelData\Data;

class UserData extends Data
{
    public ?int $id;
    public string $lastName;
    public string $firstName;
    public ?string $middleName;
    public ?string $extName;
    public string $address;
    public string $email;
    public string $password;
    public string $role;

    public function __construct(
        ?int $id,
        string $last_name,
        string $first_name,
        ?string $middle_name,
        ?string $ext_name,
        string $address,
        string $email,
        string $password,
        string $role,
    ) {
        $this->id = $id;
        $this->lastName = $last_name;
        $this->firstName = $first_name;
        $this->middleName = $middle_name;
        $this->extName = $ext_name;
        $this->address = $address;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            id: $request->id,
            last_name: $request->last_name,
            first_name: $request->first_name,
            middle_name: $request->middle_name,
            ext_name: $request->ext_name,
            address: $request->address,
            email: $request->email,
            password: $request->password,
            role: $request->role,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'middleName' => $this->middleName,
            'extName' => $this->extName,
            'address' => $this->address,
            'email' => $this->email,
            'password' => $this->password,
            'role' => $this->role,
        ];
    }
}
