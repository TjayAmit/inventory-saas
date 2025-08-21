<?php

namespace App\Services\Notification;

use App\Data\NotificationData;
use App\Models\Notification;
use App\Repositories\Contracts\NotificationRepositoryInterface;

class CreateNotificationService
{
    public function __construct(
        private NotificationRepositoryInterface $notificationRepository,
    ) {}

    public function handle(NotificationData $notificationData): Notification
    {
        return $this->notificationRepository->create($notificationData);
    }
}