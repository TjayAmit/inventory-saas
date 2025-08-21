<?php

namespace App\Data;

use Illuminate\Http\Request;
use Spatie\LaravelData\Dto;

use App\Data\TargetRecepientDto;

class NotificationDto extends Dto
{
    public function __construct(
        public string $title,
        public string $message,
        public string $type,
        public string $action_url,
        public TargetRecepientDto $targetRecepientDto,
    ){}

    public function fromRequest(Request $request)
    {
        return new self(
            title: $request->title,
            message: $request->message,
            type: $request->type,
            action_url: $request->action_url,
            targetRecepientDto: $request->targetRecepientDto,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'message' => $this->message,
            'type' => $this->type,
            'action_url' => $this->action_url,
            'targetRecepientDto' => $this->targetRecepientDto,
        ];
    }
}