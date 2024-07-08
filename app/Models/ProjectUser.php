<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProjectUser extends Pivot
{
    use HasFactory;
    protected $table = 'project_user';
    protected $fillable = [
        'project_id',
        'user_id',
        'assigned_at',
        'role',
        'hours_allocated',
        'is_active'
    ];

}
