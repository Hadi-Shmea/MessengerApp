<?php

namespace App\Http\Controllers;

use App\Models\conversation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class conversationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user=Auth::user();
        return $user->conversations()->with([ 
            'lastMessage',
             'participants'=> function($builder) use ($user){
             $builder->where('id','<>' , $user->id);
             }])->get();
    }

    public function show(conversation $conversation){
        return $conversation->load('participants');
    }

    public function addParticipants(Request $request , conversation $conversation){
        $request->validate([
            'user_id' => ['integer','required','exists:users,id']
        ]);
        
        $conversation->participants()->attach([
            $request->post('user_id') => [
                'joined_at' => Carbon::now()
            ]
        ]);
        
        return 'Participant added successfully';
    }    
    public function removeParticipants(Request $request , conversation $conversation){
        $request->validate([
            'user_id' => ['integer','required','exists:users,id']
        ]);
     +    
        $conversation->participants()->detach($request->post('user_id'));
        
        return 'Participant removed successfully';
    }    
    // $request->validate([
        //     'user_id'=>'int|required|exist:users,id'
        // ]);
        // $conversation->participants()->attach([
        //     $request->post('user_id'),
        //     'joined_at'=>Carbon::now()
        // ]);
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
