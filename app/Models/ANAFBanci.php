<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ANAFBanci extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_ANAFBanci';
    public $timestamps = false;
    use HasFactory;
}
