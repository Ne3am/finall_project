<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\User;
use App\Models\NumOrderOfUser;
class MailerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Admin.email');
    }

    public function composeEmail(Request $request) {

        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {
            
            $request->validate([
                'subject' => 'required',
                'view' => 'required'
            ]);
            
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'nanaqrc12345@gmail.com';   //  sender username
            $mail->Password = 'asecobzmvhumnmjf';       // sender password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                  // encryption - ssl/tls
            $mail->Port = 465;                          // port - 587/465

            $mail->setFrom('nanaqrc12345@gmail.com', 'Resturant');
            $mail->addAddress('deeb93549@gmail.com', 'Nana');   
            

            //$mail->addReplyTo('contact@alfredouribe.com', 'contact@alfredouribe.com');


            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = $request->input('subject');
            $mail->Body    = $request->input('view');;

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                return redirect('sendmail')->with("success", "Email has been sent.");
            }

        } catch (Exception $e) {
            return back()->with('error','Message could not be sent.');
        }

    }

    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        require base_path("vendor/autoload.php");
        $mail = new PHPMailer(true);     // Passing `true` enables exceptions

        try {
            
            $request->validate([
                'email' => 'required',
                'subject' => 'required',
                'view' => 'required'
            ]);
            
            // Email server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';             //  smtp host
            $mail->SMTPAuth = true;
            $mail->Username = 'nanaqrc12345@gmail.com';   //  sender username
            $mail->Password = 'asecobzmvhumnmjf';       // sender password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                  // encryption - ssl/tls
            $mail->Port = 465;                          // port - 587/465

            $mail->setFrom('nanaqrc12345@gmail.com', 'Resturant');
            $mail->addAddress($request->input('email'), 'Nana');   
            

            //$mail->addReplyTo('contact@alfredouribe.com', 'contact@alfredouribe.com');


            $mail->isHTML(true);                // Set email content format to HTML

            $mail->Subject = $request->input('subject');
            $mail->Body    = $request->input('view');;

            // $mail->AltBody = plain text version of email body;

            if( !$mail->send() ) {
                return back()->with("failed", "Email not sent.")->withErrors($mail->ErrorInfo);
            }
            
            else {
                return redirect('sendmail')->with("success", "Email has been sent.");
            }

        } catch (Exception $e) {
            return back()->with('error','Message could not be sent.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('Admin.email', [
            'users' => User::all()->where('id',$id),
        ]);
    }

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
