<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
        'leave_name',
        'leave_description',
        'number_of_days_allowed',
    ];

    public function users_applied_for()
    {
        return $this->belongsToMany(User::class, 'applied_fors');
    }
    public function users_decided_by()
    {
        return $this->belongsToMany(User::class, 'decided_bies');
    }
}
