<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Investition extends Model
{
    protected $table = 'insetition';

    protected $fillable = ['quantity_time', 'investment_amount', 'is_agreed', 'end_time', 'user_id'];
}
