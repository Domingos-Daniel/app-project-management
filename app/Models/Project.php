<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;

class Project extends Model
{
    use HasFactory, HasFilamentComments;

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
        return $this->belongsToMany(User::class, 'project_users')
            ->using(ProjectUser::class)
            ->withTimestamps();
    }

    public function projectUsers()
    {
        return $this->hasMany(ProjectUser::class, 'project_id', 'id');
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'user_id'); // Supondo que o campo user_id no projeto seja para o usuário atribuído
    }
}
