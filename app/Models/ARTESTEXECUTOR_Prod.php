<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ARTESTEXECUTOR_Prod extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_Prod';
    public $timestamps = false;
    use HasFactory;
}
