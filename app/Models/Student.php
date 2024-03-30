<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'first_surname', 'second_surname', 'date_of_birth', 'gender', 'curp', 'blood_type', 'photo', 'birth_certificate', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
