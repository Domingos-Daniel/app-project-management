<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;

class Change extends Model
{
    use HasFactory,  HasFilamentComments;

    protected $fillable = [
        'project_id',
        'user_id',
        'title',
        'description',
        'approved',
        'timestamp',
        'attachment',
        'reason'
    ];

    protected $casts = [
        'attachment' => 'array',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
