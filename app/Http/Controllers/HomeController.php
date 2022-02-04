<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    
     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function aboutUs()
    {
        return view('about-us');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function contact()
    {
        return view('contact');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function features()
    {
        return view('features');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function industryNews()
    {
        return view('industry-news');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function pricing()
    {
        return view('pricing');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function scheduleDemo()
    {
        return view('schedule-demo');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function submitContact(Request $request)
    {
		$name    		= $request->name;
		$email 			= $request->email;
		$phone 			= $request->phone;
		//$message 			= $request->message;
		$company 	= $request->company;
		$input = $request->all();
		
		//echo "<pre>";
		//print_r($input); die;
		        //  Send mail to admin
        \Mail::send('contactMail', array(
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'company' => $input['company'],
            'messagetext' => $input['message'],
        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('kumar.vishal437@gmail.com', 'Admin')->subject("Contact Enquery");
        });

		
		return redirect()->back()->with('success',"Successfully submitted");
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function submitscheduleDemo(Request $request)
    {
		$name    		= $request->name;
		$email 			= $request->email;

		$company 	= $request->company;
		$input = $request->all();
		
		//echo "<pre>";
		//print_r($input); die;
		        //  Send mail to admin
        \Mail::send('scheduleMail', array(
            'name' => $input['name'],
            'email' => $input['email'],

            'company' => $input['company'],

        ), function($message) use ($request){
            $message->from($request->email);
            $message->to('kumar.vishal437@gmail.com', 'Admin')->subject("Contact Enquery");
        });

		
		return redirect()->back()->with('success',"Successfully submitted");
    }
}
