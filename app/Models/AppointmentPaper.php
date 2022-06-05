<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentPaper extends Model
{
    use HasFactory;

    protected $fillable = [
    	'health_certification_id',
    	'date',
    	'title',
    ];

    public function healthCertification()
    {
        return $this->belongsTo(HealthCertification::class);
    }
}
