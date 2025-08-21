<?php

namespace App\Enums\Notification;

class NotificationType
{
    const INFO = "info";
    const WARNING = "warning";
    const ERROR = "error";
    const SUCCESS = "success";

    public static function labels(): array
    {
        return [
            self::INFO => "Info",
            self::WARNING => "Warning",
            self::ERROR => "Error",
            self::SUCCESS => "Success",
        ];
    }
}