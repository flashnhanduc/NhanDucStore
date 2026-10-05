<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    public function details()
    {
        return $this->hasMany(OrderDetail::class); 
    }
}
