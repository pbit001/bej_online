<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosareDeschise extends Model
{

    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_IRDosar';
    protected $primaryKey = 'id';
    public $timestamps = false;

    use HasFactory;
   
}
