<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;

use App\Post;
use App\Tag;
use Mail;
use Session;

class PagesController extends Controller
{
    
    public function getIndex(){
        $tags=Tag::all();
        $posts=Post::orderBy('created_at','desc')->paginate(4);
        return view('pages.welcome')->withPosts($posts)->withTags($tags);
    }
    public function getAbout(){
        $first='Alex';
        $last='Curtis';
        $fullname=$first.' '.$last;
        $email='ruhid21@yandex.ru';
        $data=[];
        $data['email']=$email;
        $data['fullname']=$fullname;
        return view('pages.about')->withData($data);
    }
    public function getContact(){
        return view('pages.contact');
    }

    public function postContact(Request $request){
     
        $data=array(
            'email'=>$request->email,
            'subject'=>$request->subject,
            'bodyMessage'=>$request->message

        );
        Mail::send('emails.contact',$data,function($message) use ($data){
            $message->from($data['email']);
            $message->to('ruhid21@yandex.ru');
            $message->subject($data['subject']);

        });
        Session::flash('success','Your email was sent');
        return redirect('/');
    }

    public function show($id){
        $tag=Tag::find($id);
        return view ('pages.show')->withTag($tag);

    }
    
}
