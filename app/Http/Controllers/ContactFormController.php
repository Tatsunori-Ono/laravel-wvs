<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ContactForm;
use League\Flysystem\CalculateChecksumFromStream;

// サービスへの切り離し（ファットコントローラー防止）
use App\Services\CheckFormService;

// バリデーション（フォームリクエスト）
use App\Http\Requests\StoreContactRequest;

use Illuminate\Support\Facades\Auth;

class ContactFormController extends Controller
{
    /**
     * 問い合わせ一覧を表示する。
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
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

        if (Auth::user()->role === 'admin') {
            // アドミン（管理者）は全ての問い合わせを閲覧できる。
            $contacts = $query->search($search)
                ->select('id', 'name', 'subject', 'created_at')
                ->orderBy('id', 'desc')
                ->paginate(10);
        } else {
            // その他のユーザーは自分自身の問い合わせのみ閲覧できる。
            $contacts = $query->where('user_id', Auth::id())
                ->select('id', 'name', 'subject', 'created_at')
                ->orderBy('id', 'desc')
                ->paginate(10);
        }

        return view('contacts.index', compact('contacts'));
    }

    /**
     * 新しい問い合わせを作成するフォームを表示する。
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     * 新しい問い合わせを保存する。
     *
     * @param \App\Http\Requests\StoreContactRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreContactRequest $request)
    {
        ContactForm::create([
            'name' => $request->name,
            'email' => $request->email,
            'non_warwick_student' => $request->non_warwick_student,
            'subject' => $request->subject,
            'contact' => $request->contact,
            'user_id' => Auth::id(),
        ]);

        return to_route('contacts.index');
    }

    /**
     * 特定の問い合わせを表示する。
     * Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(string $id)
    {
        $contact = ContactForm::find($id);

        // ユーザーがその問い合わせ主、またはアドミンではない場合
        if (Auth::user()->id !== $contact->user_id && Auth::user()->role !== 'admin') {
            return redirect()->route('contacts.index')->with('error', 'You do not have permission to view this contact.');
        }

        $non_warwick_student = CheckFormService::checkNonWarwickStudent($contact);

        return view('contacts.show', compact('contact', 'non_warwick_student'));
    }

    /**
     * 問い合わせの編集フォームを表示する。
     * Show the form for editing the specified resource.
     *
     * @param string $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to edit this contact.');
        }
    
        $contact = ContactForm::find($id);

        return view('contacts.edit', compact('contact'));
    }

    /**
     * 特定の問い合わせを更新する。
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to update this contact.');
        }
    
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
     * 特定の問い合わせを削除する。
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->back()->with('error', 'You do not have permission to delete this contact.');
        }
    
        $contact = ContactForm::find($id);
        $contact->delete();
    
        return to_route('contacts.index');
    }
}
