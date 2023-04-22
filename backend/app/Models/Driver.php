<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Trip;
use App\Models\User;

class Driver extends Model
{
    use HasFactory;

    protected $guarded = [];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function trips() {
        return $this->hasMany(Trip::class);
    }
}
