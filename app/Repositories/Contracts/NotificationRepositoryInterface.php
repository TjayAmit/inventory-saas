<?php

namespace App\Repositories\Contracts;

use Illuminate\Database\Eloquent\Collection;

use App\Data\NotificationDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Notification\Notification;
use App\Models\Notification\UserNotification;
use App\Models\Notification\AdminNotification;
use App\Models\Admin;
use App\Models\User;

interface NotificationRepositoryInterface
{
    public function index(Request $request): Collection;
    public function create(NotificationDto $notificationDto): Notification;
    
    public function attachAdminNotification(Admin $admin, Notification $notification): AdminNotification;
    public function attachUserNotification(User $user, Notification $notification): UserNotification;
    public function attachPivot(Model $model, Notification $notification): Model;
    public function delete(Notification $notification): bool;
}
