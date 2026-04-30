<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, Queueable, SerializesModels;

    protected $data;

    // constructor
    public function __construct($data)
    {
        $this->data = $data;
    }

    // main logic
    public function handle()
    {
        try {

            $email = new \SendGrid\Mail\Mail();
            $email->setFrom("jitendrapal0181@gmail.com", "Test");
            $email->setSubject("Campaign Mail");
            $email->addTo($this->data['email']);
            $email->addContent("text/html", $this->data['message']);

            $sendgrid = new \SendGrid(env('SENDGRID_API_KEY'));
            $sendgrid->send($email);

            // DB::table('email_logs')->insert([
            //     'email' => $this->data['email'],
            //     'status' => 'sent'
            // ]);
            DB::table('email_logs')->insert([
                'email' => $this->data['email'],
                'status' => 'sent',
                'campaign_id' => $this->data['campaign_id'] ?? null,
                'created_at' => now()
            ]);

        } catch (\Exception $e) {

            // DB::table('email_logs')->insert([
            //     'email' => $this->data['email'],
            //     'status' => 'failed'
            // ]);
            DB::table('email_logs')->insert([
                'email' => $this->data['email'],
                'status' => 'failed',
                'campaign_id' => $this->data['campaign_id'] ?? null,
                'created_at' => now()
            ]);
            // dd($e->getMessage());
        }
    }
}