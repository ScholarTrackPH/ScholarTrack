<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Email extends Model
{
    use HasFactory;

    protected $table = 'emails';

    protected $primaryKey = 'id';

    protected $fillable = [
        'email'
    ];
}
