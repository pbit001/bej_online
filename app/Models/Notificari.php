<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notificari extends Model
{
    protected $connection = 'mysql2';
    protected $table = 'ARTESTEXECUTOR_Notificari';
    public $timestamps = false;
    use HasFactory;
}
