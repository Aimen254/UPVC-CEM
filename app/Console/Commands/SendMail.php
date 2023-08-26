<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Reminder;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Carbon\Carbon;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lead:sendmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send mail to all leads';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Log::info('every minute testing');
       $now = Carbon::now();
      $nowdate = $now->toDateString();
        
        //PHPMailer Object
    $rem = Reminder::where('date' ,'>=', $nowdate)->get();
      if($rem){
                    $mail = new PHPMailer(true); //Argument true in constructor enables exceptions
            
            //From email address and name
            // $mail->From = "crm@babarrashid.com";
            $mail->From = "crm@babarrashid.com";
            $mail->FromName = "Rashid Co";
            
            //To address and name
            $mail->addAddress("babar@babarrashid.com", "Babar Rasheed");
           
            // $mail->addAddress("recepient1@example.com"); //Recipient name is optional
            
            //Address to which recipient will reply
            // $mail->addReplyTo("reply@yourdomain.com", "Reply");
            
            //CC and BCC
            // $mail->addCC("cc@example.com");
            // $mail->addBCC("bcc@example.com");
            
            //Send HTML or Plain Text email
            $mail->isHTML(true);
            
            $mail->Subject = "Reminder Email";
            $mail->Body = "<i>You have a reminder in your Lead that will be send soon</i>";
            $mail->AltBody = "This is the plain text version of the email content";
            
            try {
                $mail->send();
                echo "Message has been sent successfully";
            } catch (Exception $e) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            }
            
      }else{
          echo "expire";
      }
      
 


    }
}
