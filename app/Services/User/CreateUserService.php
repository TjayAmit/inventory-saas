<?php

namespace App\Services\User;

use Illuminate\Support\Facades\DB;

use App\Exceptions\FailedToCreationRecipientNotification;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\Notification\CreateNotificationService;

use App\Enums\Notification\NotificationType;
use App\Data\NotificationDto;
use App\Data\TargetRecipientDto;
use App\Data\UserData;
use App\Models\User;
use App\Models\Admin;
use App\Models\Notification\Notification;

class CreateUserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private CreateNotificationService $createNotificationService,
    ) {}

    public function handle(UserData $userData): User
    {
        return DB::transaction(function () use ($userData) {
            $user = $this->userRepository->create($userData);

            $notification = $this->notify();

            if (!$notification) {
                throw new FailedToCreationRecipientNotification();
            }

            return $user;
        });
    }

    protected function notify():Notification
    {
        $notificationDto = new NotificationDto(
            title: 'New User Created',
            message: 'A new user has been created',
            type: NotificationType::SUCCESS,
            action_url: route('users.index'),
            targetRecipientDto: new TargetRecipientDto(
                model: new Admin(),
            ),
        );

        return $this->createNotificationService->handle($notificationDto);
    }
}
