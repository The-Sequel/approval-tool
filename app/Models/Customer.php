<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    
    public function tasks()
    {
        return $this->hasManyThrough(Task::class, Project::class);
    }

    // public function users()
    // {
    //     return $this->hasManyThrough(User::class, Project::class);
    // }
}
