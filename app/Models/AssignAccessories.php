<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignAccessories extends Model
{
    use HasFactory;
    protected $fillable=[
        'window_id',
        'sashroll',
        'sashrollqty',
        'sashrollrate',
        'bumperblock',
        'bumperblockqty',
        'bumperblockrate',
        'dummywheel',
        'dummywheelqty',
        'dummywheelrate',
        'flathandle',
        'flathandleqty',
         'flathandlerate',
         'netwheel',
         'netwheelqty',
         'netwheelrate',
         'stopper',
         'stopperqty',
         'stopperrate',
         'windbreak',
         'windbreakqty',
         'windbreakrate',
         'silicon',
         'siliconqty',
         'siliconrate',
         'fixer',
         'fixerqty',
         'fixerrate',
         'slidekeep',
         'slidekeepqty',
         'slidekeeprate'
     ];
 
}
