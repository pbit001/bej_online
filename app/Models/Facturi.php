<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facturi extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_CLIENTI';
    public $timestamps = false;
    use HasFactory;
}
