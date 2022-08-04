<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_Doc';
    protected $primaryKey = 'ID_Inregistrare';
    public $timestamps = false;
    
    use HasFactory;
}
