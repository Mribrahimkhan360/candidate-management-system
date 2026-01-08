<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'interview_type',
        'scheduled_date',
        'status',
        'notes',
    ];

    protected $casts = [
        'scheduled_date' => 'datetime',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function isPast()
    {
        return Carbon::parse($this->scheduled_date)->isPast();
    }

    public function isUpcoming()
    {
        return !$this->isPast();
    }
}