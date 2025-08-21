<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Dto;

class TargetRecepientDto extends Dto
{
    public function __construct(
        public Model $model,
        public Model $notificationModel
    ) {}

    public function getModel(): Model
    {
        return $this->model;
    }

    public function getNotificationModel(): Model
    {
        return $this->notificationModel;
    }
}
