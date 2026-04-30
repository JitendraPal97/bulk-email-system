<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;  
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts', compact('contacts'));
    }

    public function upload(Request $req)
    {
        //$file = fopen($req->file('file'), 'r');
        $file = fopen($req->file('file')->getRealPath(), 'r');
        fgetcsv($file);
        while (($data = fgetcsv($file)) !== false) {
            Contact::create([
                'name' => $data[0],
                'email' => $data[1]
            ]);
        }

        return redirect('/')->with('success', 'Contact added successfully');
    }

    public function delete($id)
    {
        \App\Models\Contact::find($id)->delete();

        return redirect('/')->with('success', 'Contact deleted successfully');
    }

    public function edit($id)
    {
        $contact = \App\Models\Contact::find($id);
        return view('edit-contact', compact('contact'));
    }

    public function update(Request $req, $id)
    {
        \App\Models\Contact::find($id)->update([
            'name' => $req->name,
            'email' => $req->email
        ]);

        return redirect('/')->with('success', 'Contact Updated successfully');
    }

    public function downloadCsvFormat()
    {
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="contacts_format.csv"',
        ];

        $columns = ['Name', 'Email'];

        $callback = function() use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
