<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'task_name', 'district_id', 'status'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }
}
