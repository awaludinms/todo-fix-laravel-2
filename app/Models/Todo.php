<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    //
    protected $fillable = [
        'task',
        'status',
        'id',
        'created_at',
        'deleted_at',
        'is_deleted',
        'deleted_by',
        'created_by',
        'updated_at'
    ];
}
