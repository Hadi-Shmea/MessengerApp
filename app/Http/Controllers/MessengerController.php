<?php

namespace App\Http\Controllers;

use App\Models\conversation;
use App\Models\participants;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class MessengerController extends Controller
{
    
    public function index( $id = null)
    {    
        $user = Auth::user();
        
        $friend = User::where('id','<>' , $user->id)
            ->orderBy('name')->paginate();
       
        return view('messenger', [
            'friends' => $friend , 
            ] );
    }
}
    