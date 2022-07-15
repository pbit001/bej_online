<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clienti extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_CLIENTVIEW';
    public $timestamps = false;
    use HasFactory;
}
