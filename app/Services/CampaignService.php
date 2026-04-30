<?php

namespace App\Services;

use App\Models\Campaign;
use App\Models\Contact;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Facades\DB;

class CampaignService
{
    public function createCampaign($template_id)
    {
        $campaign = Campaign::create([
            'template_id' => $template_id
        ]);

        $contacts = Contact::all();

        foreach ($contacts as $c) {
            DB::table('campaign_contacts')->insert([
                'campaign_id' => $campaign->id,
                'contact_id' => $c->id,
                'status' => 'pending'
            ]);
        }

        return $campaign;
    }

    public function send($id)
    {
        $data = DB::table('campaign_contacts')
            ->where('campaign_id', $id)
            ->where('status', 'pending')
            ->get();

        foreach ($data as $d) {

            $contact = DB::table('contacts')->find($d->contact_id);

            SendEmailJob::dispatch([
                'email' => $contact->email,
                'message' => "Hello ".$contact->name
            ]);

            DB::table('campaign_contacts')
                ->where('id', $d->id)
                ->update(['status' => 'sent']);
        }

        return "Emails Queued!";
    }
}