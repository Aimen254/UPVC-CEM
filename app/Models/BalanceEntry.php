<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BalanceEntry extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'description',
        'created_by',
    ];

    public function accounts()
    {
        return $this->hasmany('App\Models\BalanceItem', 'balance', 'id');
    }
    
    public function totalExpense()
    {
        $total = 0;
        foreach($this->accounts as $account)
        {
            $total += $account->expense;
        }

        return $total;
    }
    public function totalRevenue()
    {
        $total = 0;
        foreach($this->accounts as $account)
        {
            $total += $account->revenue;
        }

        return $total;
    }


}
