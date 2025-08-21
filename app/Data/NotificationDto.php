<?php

namespace App\Data;

use Illuminate\Http\Request;
use Spatie\LaravelData\Dto;

class NotificationDto extends Dto
{
    public function __construct(
        public string $title,
        public string $message,
        public string $type,
        public string $action_url,
    ){}

    public function fromRequest(Request $request)
    {
        return new self(
            title: $request->title,
            message: $request->message,
            type: $request->type,
            action_url: $request->action_url,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type,
            'action_url' => $this->action_url,
        ];
    }
}