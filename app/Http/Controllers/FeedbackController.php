<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Mail\SendFeedback;

class FeedbackController extends Controller
{
    public function store(Request $request){

        $feedback = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ];


        Mail::to('rizdhanhr@gmail.com')->send(new SendFeedback($feedback));

        toastr()->success('Feedback terkirim!');
        return redirect('/');
    }
}
