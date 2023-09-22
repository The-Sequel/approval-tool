<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function subProjects()
    {
        return $this->hasMany(SubProject::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
