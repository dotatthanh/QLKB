<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
    	'content',
    	'email',
    	'patient_id',
        'consulting_room_id',
    	'phone',
    	'name',
    	'time',
    	'date',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function consultingRoom()
    {
        return $this->belongsTo(ConsultingRoom::class);
    }
}
