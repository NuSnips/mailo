<?php

namespace Domain\Subscriber\Actions;

use Domain\Shared\Models\User;
use Domain\Subscriber\DataTransferObjects\SubscriberDTO;

class UpsertSubscriber
{
    public function execute(SubscriberDTO $subscriberDTO, User $user) {}
}
