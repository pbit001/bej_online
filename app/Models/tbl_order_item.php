<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_order_item extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_tbl_order_item';
    public $timestamps = false;
    use HasFactory;
}
