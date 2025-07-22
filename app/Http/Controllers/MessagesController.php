<?php

namespace App\Http\Controllers;

use App\Events\Message_created;
use App\Models\conversation;
use App\Models\recipients;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Throwable;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {   
        $user =Auth::user();
        $conversation = $user->conversations()->with(['participants'=> function($builder) use ($user){
             $builder->where('id','<>' , $user->id);
             }])->findOrFail($id);
        return [
            'conversation'=>$conversation,
            'messages'=>$conversation->messages()->with('user')->paginate()
        ];        
    }

    /**
     * Store a newly created resource in storage.
     */
  
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'conversation_id'=>Rule::requiredIf(
                        function() use($request) {
                            return !$request->has('user_id');        
                        }) ,
                    'int',
                    'exists:conversation,id' ,
                'user_id'=>Rule::requiredIf(
                        function() use($request) {
                            return !$request->has('conversation_id');        
                        }) ,
                    'int',
                    'exists:user,id' ,
                'body'=> 'required|text',
                #'type'=>'required|in:admin,member'#
            ]
            );
        
        $user= Auth::user();
        $conversation_id=$request->post('conversation_id');
        $user_id = DB::table('participants')
            ->where('conversation_id', $conversation_id)
            ->where('user_id', '<>', $user->id)
            ->first()?->user_id;
            
        DB::beginTransaction();
        try{
            if($conversation_id){
                $conversation=$user->conversations()->findOrFail($conversation_id);
            } else {
                // $conversation = Conversation::join('participants', 'conversations.id', '=', 'participants.conversation_id')
                //     ->join('participants as participants2', 'participants.conversation_id', '=', 'participants2.conversation_id')
                //     ->where('conversations.type', '=', 'peer')
                //     ->where('participants.user_id', '=', $user_id)
                //     ->where('participants2.user_id', '=', $user->id)
                //     ->first();
           
                
                $conversation=conversation::where('type','=','peer')->whereHas('participants', function ($builder) use($user_id,$user) {
                    $builder->join('participants as participants2' , 'participants.conversation_id')
                    ->where('participants.user_id','=',$user_id)
                    ->where('participants2.user_id','=',$user->id);
                })->first();

            if(!$conversation){
                $conversation=conversation::create([
                    'user_id'=>$user->id,
                    'type'=>'peer',
                ]);
                $conversation->participants()->attach([
                    $user->id=>['joined_at'=>now()],
                    $user_id=>['joined_at'=>now()]
                ]);
            }
            }
            $message=$conversation->messages()->create([
                'user_id'=>$user_id,
                'body'=>$request->post('message')
            ]);
            DB::statement('
                INSERT INTO recipients (user_id , message_id)
                select user_id, ? FROM participants WHERE conversation_id = ?
            ',[$message->id,$conversation->id]);
            //The ? in the SQL query is replaced by the values of $message->id and $conversation->id at runtime
            // DB::table('conversations')->where('id', $conversation->id)->update(['last_message_id' => $message->id]);

            $conversation->where('id', $conversation->id)->update(['last_message_id'=>$message->id]);
           
            DB::commit();
            $message->load('user');
            broadcast(new Message_created($message));
        }catch(Throwable $E){
            
            DB::rollBack();
            throw $E;
            
        }
        return $message;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        // $validator = Validator::make(
        //     $request->body,
        //     [
        //         'body'=> 'required|text',
        //     ]
        //     );if ($validator->fails()) {
        //         return  $this->requiredField($validator->errors());
        //     } else {
        //         $data = ([
        //             'body'=>$request->body,
        //             'updated_at'=>now()
        //         ]);
        //         recipients::where([
        //             'user_id'=>Auth::user(),
        //             'message_id'=>$id
        //         ])->update($data);
    // }}
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        recipients::where([
            'user_id'=>Auth::id(),
            'message_id'=>$id
        ])->delete();
            return 'message has been deleted successfully';
    }
}
