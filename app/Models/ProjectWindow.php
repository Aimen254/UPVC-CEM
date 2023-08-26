<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectWindow extends Model
{
    use HasFactory;

    protected $fillable=[
       'project',
       'fixheight',
       'fixwidth',
       'outerheight',
       'outerwidth',
       'innerheight',
       'innerwidth',
       'quantity',
       'totalexpense',
       'image',
       'frame',
       'frame_id',
       'jobcost',
       'frame',
        'created_by'
    ];
   public static $design_type=[
        'sliding' => 'Sliding',
        'fix' => 'Fix',
        'openable' => 'Openable'
    ];
     public static $brand=[
        'Buraq' => 'Buraq',
        'Asaspen' => 'Asaspen',
        'Winplast' => 'Winplast'
    ];
      public static $alldesign_type=[
        'sliding' => 'Sliding',
        'fix' => 'Fix',
        'openable' => 'Openable',
        'door' => 'Door'
    ];
      public static $ratio=[
        'singleopener' => 'Single Opener',
        'doubleopener' => 'Double Dpener'
    ];
    public static $hing=[
        '2Dhindge' => '2D hing',
        '3Dhindge' => '3D hing'
    ];
    public static $handle=[
        'imphandlesp' => 'Imported Handle Espanglet',
        'imphandlecyl' => 'Imported Handle Cylinder',
        'imphandle' => 'Imported Handle',
        'cockspur' => 'Cockspur Handle'
    ];
    public static function price($profile)
    {

    }
    public function prices()
    {
        return $this->hasOne('App\Models\AssignWindow', 'id', 'frame_id');
    }
     public function pricesqty()
    {
        return $this->hasOne('App\Models\AssignAccessories', 'window_id', 'frame_id');
    }
     public function openpricesqty()
    {
        return $this->hasOne('App\Models\OpenAssignAccess', 'window_id', 'frame_id');
    }
    public function projwinacces()
    {
        return $this->hasOne('App\Models\ProjWindowAcces', 'projwin_id', 'id');
    }
       public function fixpricesqty($frame)
    {
       $get = UserSlidingAccess::where('frame',$frame)->first();
       return $get;

    }

}
