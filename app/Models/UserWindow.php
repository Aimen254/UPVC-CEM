<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWindow extends Model
{
    use HasFactory;
      protected $fillable = [
        'user_id',
        'formula_id',
        'image_id',
        'fixheight',
        'fixwidth',
        'outerheigh',
        'outerwidth',
        'innerheight',
        'innerwidth',
        'size',
        'projects',
        'assignto',
        'netwidth',
        'netheight',
        'status',
        'created_by',
    ];

    public static $windows_status=[
        'on_hold' => 'On Hold',
        'in_progress' => 'In Progress',
        'complete' => 'Complete',
        'canceled' => 'Canceled'
    ];
     public function project()
    {
        return $this->hasOne('App\Models\Project', 'id', 'projects');
    }
 public function valuesum()
    {
        $data =UserSlidingAccess::where('value_id', '=', $this->id)->first();
        $sum = $data->aluminium_rail + $data->brush_rolls + $data->bumpler_block + $data->DTape_screws + $data->dummy_wheels + $data->fiber_net + $data->flat_handle + $data->fly_screen_gaskit + $data->fly_screen_slidingwheel + $data->gear_handles + $data->sliding_gearkeep + $data->sliding_gear + $data->sliding_gearwheels + $data->stoppers + $data->wind_break ;
        return $sum;
    }
}
