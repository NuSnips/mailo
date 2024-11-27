<?php

namespace Domain\Shared\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasFactory;

    // Define how laravel should resolve the namespaced factories
    protected static function newFactory()
    {
        $parts = str(get_called_class())->explode('\\');
        $domain = $parts->get(1);
        $model = $parts->last();
        return app("Database\\Factories\\{$domain}\\{$model}Factory");
    }
}
