<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'balance',
        'account',
        'debit',
        'credit',
        'totalbalance',
    ];

    public function accounts()
    {
        return $this->hasOne('App\Models\ChartOfAccount', 'id', 'account');
    }
}
