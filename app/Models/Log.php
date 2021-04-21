<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'logs';

    /**
     * @var array
     */
    protected $fillable = [
        'type', 'message',
    ];
}
