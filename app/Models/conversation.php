<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class conversation extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id',
        'label',
        'type'
    ]; 
    public function participants(){
        return $this->belongsToMany(user::class , 'participants')->withPivot([
            'joined_at','role'
        ]);
    } 
    public function messages(){
        return $this->hasMany(message::class,'conversation_id','id') ;
    } 
  
        public function user()
        {
            return $this->belongsTo(user::class, 'user_id', 'id');
        }
    public function lastMessage(){
      return $this->belongsTo(message::class,'last_message_id')->withDefault();  
    }
 }

