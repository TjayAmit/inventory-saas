<?php

namespace App\Services\Notification;

use Illuminate\Database\Eloquent\Collection;

use App\Repositories\Contracts\AdminRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Data\TargetRecepientDto;

class RetrieveTargetRecipients
{
    public function __construct(
        private AdminRepositoryInterface $adminRespositoryInterface,
        private UserRepositoryInterface $userRepositoryInterface,   
    ) {}

    public function handle(TargetRecepientDto $targetRecepientDto): Collection
    {
        if($targetRecepientDto->getModel() instanceof Admin)
        {
            return $this->retrieveAdmins();
        }

        return $this->retrieveUsers();
    }

    protected function retrieveAdmins(): Collection
    {
        $query = ['is_active' => true];
        return $this->adminRespositoryInterface->findWithQuery($query);
    }

    protected function retrieveUsers(): Collection
    {
        $query = ['is_active' => true];
        return $this->userRepositoryInterface->findWithQuery($query);
    }
}