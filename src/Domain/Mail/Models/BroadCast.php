<?php

namespace Domain\Mail\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BroadCast extends BaseModel
{
    use HasFactory;

    public function sentMails()
    {
        return $this->morphMany(SentMail::class, 'sendable');
    }
}
