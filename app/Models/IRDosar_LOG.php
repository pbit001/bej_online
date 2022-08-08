<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IRDosar_LOG extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_IRDosar_LOG';
    public $timestamps = false;
    use HasFactory;
}
