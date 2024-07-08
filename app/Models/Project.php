<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'supervisor_id',
        'end_date',
        'actual_end_date',
        'budget',
        'status',
        'priority'
    ];

    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    public function changes()
    {
        return $this->hasMany(Change::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')
                    ->using(ProjectUser::class)
                    ->withTimestamps();
    }
}
