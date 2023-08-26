<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjWinEntry extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'project_id',
        'created_by',
    ];
    public function window()
    {
        return $this->hasmany('App\Models\ProjectWindow', 'projwin_id', 'id');
    }
 public function count(){
        return $this->hasmany('App\Models\ProjectWindow', 'projwin_id', 'id')->count();
    }
}
