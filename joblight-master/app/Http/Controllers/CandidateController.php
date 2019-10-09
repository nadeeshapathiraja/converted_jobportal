<?php

namespace App\Http\Controllers;
use App\Account;
use App\candidate_applications;
use App\candidate_languages;
use App\candidate_savedapplications;
use App\candidateeducations;
use App\candidatepreference;
use App\candidateprofiles;
use App\candidateworkexps;
use Illuminate\Http\Request;
use DB, Session, URL, Crypt, PDF, View, Excel;
use App\Http\Controllers\MailController;


class CandidateController extends Controller {


	public function create()
	{
		return view('front.candidate');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required'
        ]);

        $contact = new Contact([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'email' => $request->get('email'),
            'job_title' => $request->get('job_title'),
            'city' => $request->get('city'),
            'country' => $request->get('country')
        ]);
        $contact->save();
        return redirect('/contacts')->with('success', 'Contact saved!');
    }


}
