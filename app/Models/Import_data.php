<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import_data extends Model
{
    use HasFactory;

    protected $fillable = [
        'agent_id',
        'name',
        'phone',
        'update_date',
        
    ];
}
