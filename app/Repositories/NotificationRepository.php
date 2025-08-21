<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

use App\Data\NotificationDto;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use App\Models\Notification\Notification;

class NotificationRepository implements NotificationRepositoryInterface
{
    public function index(Request $request) :Collection
    {
        return Notification::all();
    }

    public function create(NotificationDto $notificationDto): Notification
    {
        return Notification::create($notificationDto->toArray());
    }

    public function delete(Notification $notification): bool
    {
        return $notification->delete();
    }
}