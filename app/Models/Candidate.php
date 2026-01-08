<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'experience_years',
        'previous_experience',
        'age',
        'status',
    ];

    protected $casts = [
        'previous_experience' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function interviews()
    {
        return $this->hasMany(Interview::class);
    }

    public function firstInterview()
    {
        return $this->hasOne(Interview::class)->where('interview_type', 'first')->latest();
    }

    public function secondInterview()
    {
        return $this->hasOne(Interview::class)->where('interview_type', 'second')->latest();
    }
}