<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
   public function add_comment(Request $request)  {
         if(Auth::id()){

            $comment = new Comment();

            $comment->name = Auth::user()->name;
            $comment->user_id = Auth::user()->id;
            $comment->comment = $request->message;
            $comment->product_id = $request->product_id;
            $comment->save();

            return redirect()->back();
         }
         else{
            return redirect('login');
         }
   }

   public function add_reply(Request $request){
      if(Auth::id()){

         $reply= new Reply();

         $reply->name = Auth::user()->name;
         $reply->user_id = Auth::user()->id;
         $reply->comment_id = $request->Comment_id;
         $reply->reply = $request->reply;
         $reply->product_id = $request->product_id_reply;
         $reply->save();

         return redirect()->back();
      }
      else{
         return redirect('login');
      }
   }
}
