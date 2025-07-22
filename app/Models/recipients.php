<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class recipients extends Pivot
{
    use HasFactory , SoftDeletes;
    public $timestamps=false;
    protected $casts=['read_at'=>'datetime',];
    
    public function message(){
        return $this->belongsTo(message::class);
    } 
    public function user(){
        return $this->belongsTo(user::class);
    }
}

