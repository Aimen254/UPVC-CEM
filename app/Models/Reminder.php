<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lead;
class Reminder extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'date',
        'time',
        'lead_id',
      
    ];

    public function leads()
    {
        return $this->belongsTo(Lead::class);
    }
}
