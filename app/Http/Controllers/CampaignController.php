<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;  
use App\Models\Campaign;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendEmailJob;

class CampaignController extends Controller
{
    public function index()
    {
        $templates = \App\Models\Template::all();
        $campaigns = \App\Models\Campaign::all();
        return view('campaigns', compact('templates','campaigns'));
    }

    public function create(Request $req)
    {
        $campaign = Campaign::create([
            'template_id' => $req->template_id
        ]);

        $contacts = Contact::all();

        foreach ($contacts as $c) {
            DB::table('campaign_contacts')->insert([
                'campaign_id' => $campaign->id,
                'contact_id' => $c->id,
                'status' => 'pending'
            ]);
        }

        // return "Campaign Created";
        return redirect('/campaigns')->with('success', 'Campaign created successfully');
    }

    public function send($id)
    {
        $campaign = \App\Models\Campaign::find($id);
        $data = DB::table('campaign_contacts')
            ->where('campaign_id', $id)
            ->where('status', 'pending')
            ->get();

        foreach ($data as $d) {

            $contact = Contact::find($d->contact_id);
            //$template = DB::table('templates')->find(1);
            $template = DB::table('templates')->find($campaign->template_id);

            $message = str_replace('{{name}}', $contact->name, $template->body);

            SendEmailJob::dispatch([
                'email' => $contact->email,
                'message' => $message,
                'campaign_id' => $campaign->id
            ]);

            DB::table('campaign_contacts')
                ->where('id', $d->id)
                ->update(['status' => 'sent']);
        }
        return redirect('/campaigns')->with('success', 'Emails have been queued successfully');
        // return "Emails Queued!";
    }

    public function logs()
    {
        $sent = DB::table('email_logs')->where('status','sent')->count();
        $failed = DB::table('email_logs')->where('status','failed')->count();

        $logs = DB::table('email_logs')->get();

        return view('logs', compact('logs','sent','failed'));
    }
}
