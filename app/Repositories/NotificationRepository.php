<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Collection;

use App\Data\NotificationDto;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use App\Models\Notification\Notification;
use App\Models\Notification\AdminNotification;
use App\Models\Notification\UserNotification;
use App\Models\Admin;
use App\Models\User;

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

    public function attachAdminNotification(Admin $admin, Notification $notification): AdminNotification
    {
        return AdminNotification::create([
            'admin_id' => $admin->id,
            'notification_id' => $notification->id,
        ]);
    }

    public function attachUserNotification(User $user, Notification $notification): UserNotification
    {
        return UserNotification::create([
            'user_id' => $user->id,
            'notification_id' => $notification->id,
        ]);
    }

    public function attachPivot(Model $model, Notification $notification): Model
    {
        return $model->create([
            'notification_id' => $notification->id,
            'model_id' => $model->id,
        ]);
    }

    public function delete(Notification $notification): bool
    {
        return $notification->delete();
    }
}