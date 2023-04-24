<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterpartyUpdate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function counterparty()
    {
        $this->belongsTo(CounterpartyUpdate::class, 'counterparty_id', 'id');
    }
}
