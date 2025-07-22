<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class message extends Model
{
    use HasFactory , SoftDeletes;

    protected $fillable=[
        'conversation_id','user_id','body','type'
    ];
    public function user(){
        return $this->belongsTo(user::class,'user_id','id')->withDefault([
            'name'=>__('user')
        ]);
    }
    public function conversation(){
        return $this->belongsTo(conversation::class,'conversation_id','id');
    }
    public function recipients(){
        return $this->belongsToMany(user::class,'user_id','id')->withPivot(
            ['read_at','deleted_at']);
    }
}
