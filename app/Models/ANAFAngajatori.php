<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ANAFAngajatori extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_ANAFAngajatori';
    public $timestamps = false;
    use HasFactory;
}
