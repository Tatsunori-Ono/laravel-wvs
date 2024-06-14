<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactForm;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = ContactForm::select('id', 'name', 'subject', 'created_at')
        ->get();

        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        ContactForm::create([
            'name' => $request->name,
            'email' => $request->email,
            'non_warwick_student' => $request->non_warwick_student,
            'subject' => $request->subject,
            'contact' => $request->contact,
        ]);

        return to_route('contacts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $contact = ContactForm::find($id);

        if($contact->non_warwick_student === 0){
            $non_warwick_student = __('contact.warwick-student');
        } else {
            $non_warwick_student = __('contact.non-warwick-student');
        }

        return view('contacts.show', compact('contact', 'non_warwick_student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contact = ContactForm::find($id);

        return view('contacts.edit', compact('contact'));
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
