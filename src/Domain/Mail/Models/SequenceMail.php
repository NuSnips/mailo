<?php

namespace Domain\Mail\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SequenceMail extends BaseModel
{
    use HasFactory;

    public function sequence()
    {
        return $this->belongsTo(Sequence::class);
    }

    public function sequenceMailSchedule()
    {
        return $this->belongsTo(SequenceMailSchedule::class);
    }

    public function sentMails()
    {
        return $this->morphMany(SentMail::class, 'sendable');
    }
}
