<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counterparty extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function counterpartyUpdates()
    {
        $this->hasMany(CounterpartyUpdate::class);
    }
}
