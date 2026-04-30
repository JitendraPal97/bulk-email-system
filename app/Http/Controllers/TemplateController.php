<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{
    public function index()
    {
        // $templates = Template::all();
        // return view('templates', compact('templates'));
        $templates = \App\Models\Template::all();
        return view('templates', compact('templates'));
    }

    public function store(Request $req)
    {
        Template::create([
            'subject' => $req->subject,
            'body' => $req->body
        ]);

        return redirect('/templates')->with('success', 'Template created successfully');
    }

    public function edit($id)
    {
        $template = \App\Models\Template::find($id);
        return view('edit-template', compact('template'));
    }

    public function update(Request $req, $id)
    {
        \App\Models\Template::find($id)->update([
            'subject' => $req->subject,
            'body' => $req->body
        ]);

        return redirect('/templates')->with('success', 'Template Update successfully');
    }
}