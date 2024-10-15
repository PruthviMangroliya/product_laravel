<?php

namespace App\Jobs;

use App\Mail\SendEmailTest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $details;

    /**
     * Create a new job instance.
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $data = $this->details;
        $email = new SendEmailTest();
        Mail::to($this->details['email'])->send($email);

        // Mail::send(['html'=>'demo_email_template'], $data, function($message) use ($data)
        // {
        
        // $message->to('receiver@gmail.com', 'John')->subject('This is test Queue.');
        
        // $message->from('info@demo.com','LaravelQueue');
        
        // });
    }   
}
