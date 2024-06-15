<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactForm;
use League\Flysystem\CalculateChecksumFromStream;

// サービスへの切り離し（ファットコントローラー防止）
use App\Services\CheckFormService;

// バリデーション（フォームリクエスト）
use App\Http\Requests\StoreContactRequest;

class ContactFormController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // $contacts = ContactForm::select('id', 'name', 'subject', 'created_at')
        // ->get();

        //ページネーション
        // $contacts = ContactForm::select('id', 'name', 'subject', 'created_at')
        // ->paginate(10);

        $search = $request->search;
        $query = ContactForm::search($search);

        $contacts = $query->select('id', 'name', 'subject', 'created_at')
        ->paginate(10);

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
    public function store(StoreContactRequest $request)
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

        $non_warwick_student = CheckFormService::checkNonWarwickStudent($contact);

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
        $contact = ContactForm::find($id);

        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->non_warwick_student = $request->non_warwick_student;
        $contact->subject = $request->subject;
        $contact->contact = $request->contact;
        $contact->save();

        return to_route('contacts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contact = ContactForm::find($id);
        $contact->delete();

        return to_route('contacts.index');
    }
}
