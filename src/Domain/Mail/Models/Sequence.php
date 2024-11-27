<?php

namespace Domain\Mail\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Sequence extends BaseModel
{
    use HasFactory;

    public function sequenceMails()
    {
        return $this->hasMany(SequenceMail::class);
    }
}
