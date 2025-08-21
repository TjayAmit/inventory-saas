<?php

namespace App\Services\Notification;

use App\Exceptions\FailedToCreationRecipientNotification;
use Illuminate\Support\Facades\DB;

use App\Models\Notification\Notification;
use App\Repositories\Contracts\NotificationRepositoryInterface;
use App\Services\Notification\RetrieveTargetRecipients;
use App\Data\NotificationDto;
use App\Models\Admin;

class CreateNotificationService
{
    public function __construct(
        private NotificationRepositoryInterface $notificationRepository,
        private RetrieveTargetRecipients $retrieveTargetRecipients,
    ) {}

    public function handle(NotificationDto $notificationDto): Notification
    {
        return DB::transaction(function () use ($notificationDto) {
            $notification = $this->notificationRepository->create($notificationDto);

            $result = $this->createNotificationTargetRecipients($notification, $notificationDto);

            if (!$result) {
                throw new FailedToCreationRecipientNotification();
            }

            return $notification;
        });
    }

    protected function createNotificationTargetRecipients(Notification $notification, NotificationDto $notificationDto): bool
    {
        $targetRecipients = $this->retrieveTargetRecipients->handle($notificationDto->targetRecipientDto);

        if ($notificationDto->targetRecipientDto->getModel() instanceof Admin) {
            $notification->admins()->attach($targetRecipients->pluck('id')->toArray());

            return true;
        }

        if ($notificationDto->targetRecipientDto->getModel() instanceof User) {
            $notification->users()->attach($targetRecipients->pluck('id')->toArray());

            return true;
        }

        return false;
    }
}