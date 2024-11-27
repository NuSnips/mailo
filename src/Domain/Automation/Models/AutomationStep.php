<?php


namespace Domain\Automation\Models;

use Domain\Shared\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AutomationStep extends BaseModel
{
    use HasFactory;

    public function automation()
    {
        return $this->belongsTo(Automation::class);
    }
}
