<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

use App\Data\NotificationDto;
use Illuminate\Http\Request;
use App\Models\Notification\Notification;

interface NotificationRepositoryInterface
{
    public function index(Request $request): Collection;
    public function create(NotificationDto $notificationDto): Notification;
    public function delete(Notification $notification): bool;
}
