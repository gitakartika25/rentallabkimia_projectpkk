<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordersin extends Model
{
    protected $table = 'transactions';
    protected $guarded = ['id'];
    use HasFactory;
}
