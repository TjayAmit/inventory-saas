<?php

namespace App\Data;

use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\Dto;

class TargetRecipientDto extends Dto
{
    public function __construct(
        public Model $model
    ) {}

    public function getModel(): Model
    {
        return $this->model;
    }
}
