<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class participant extends Pivot
{
    use HasFactory;
    public $timestamps=false;
    protected $casts=['joined_at'=>'datetime',];

    public function conversation(){
        return $this->belongsTo(conversation::class,'conversation_id','id');
    }
    public function user(){
        return $this->belongsTo(user::class,'conversation_id','id');
    }
}
