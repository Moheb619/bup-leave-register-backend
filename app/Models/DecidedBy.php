<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecidedBy extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'leave_id',
        'from',
        'to',
    ];
}
