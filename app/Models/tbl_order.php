<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tbl_order extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_tbl_order';
    protected $primaryKey = 'order_id';
    public $timestamps = false;
    use HasFactory;
}
