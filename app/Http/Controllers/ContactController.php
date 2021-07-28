<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('contact.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $message = '<html><body>';
        $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
        $message .= "<tr style='background: #eee;'><td><strong>Topic:</strong> </td><td>" . $request->subject . "</td></tr>";
        $message .= "<tr><td><strong>Full name:</strong> </td><td>" . $request->fullname . "</td></tr>";
        $message .= "<tr><td><strong>Email:</strong> </td><td>" . $request->email . "</td></tr>";
        $message .= "<tr><td><strong>Message:</strong> </td><td>" . $request->message . "</td></tr>";
        $message .= "</table>";
        $message .= "</body></html>";

        $headers = "From: ".$request->email ." \r\n";
        $headers .= "Reply-To: ". $request->email . "\r\n";
        $headers .= "CC: door2coin@coin.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail("support@door2coin.com", "Door2coin.com buy bitcoin", $message, $headers);

//        mail("polarbear91781014@gmail.com", "Door2coin.com buy bitcoin", $message, $headers);
        //
        return redirect('/contact-us');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
