<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShowcaseItem;
use App\Models\ShowcaseWork;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Log;

class ShowcaseController extends Controller
{
    public function index()
    {
        $showcaseItems = ShowcaseItem::where('approved', true)->with('works')->get();
        return view('showcase.index', compact('showcaseItems'));
    }

    public function create()
    {
        return view('showcase.create');
    }

    public function store(Request $request)
    {
        Log::info('Request received: ', $request->all());

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,mp3,wav,mp4|max:20480', // 20MB max
        ]);

        $showcaseItem = ShowcaseItem::create([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'approved' => false, // 初期値は「不採用」
        ]);

        if ($request->hasFile('file')) {
            Log::info('File found: ', ['file' => $request->file('file')]);

            $path = $request->file('file')->store('showcase_works', 'public');
            ShowcaseWork::create([
                'showcase_item_id' => $showcaseItem->id,
                'file_path' => $path,
            ]);
        }

        return redirect()->route('showcase.index')->with('success', 'Your work has been submitted and is awaiting approval.');
    }

    public function admin()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('showcase.create')->with('error', 'You do not have permission to approve/reject submissions.');
        }

        $submissions = ShowcaseItem::where('approved', false)->with('works')->get();
        $approvedSubmissions = ShowcaseItem::where('approved', true)->with('works')->get();

        return view('showcase.admin', compact('submissions', 'approvedSubmissions'));
    }

    public function approve($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('showcase.create')->with('error', 'You do not have permission to approve/reject submissions.');
        }

        $showcaseItem = ShowcaseItem::find($id);
        $showcaseItem->approved = true;
        $showcaseItem->save();

        return redirect()->route('showcase.admin')->with('success', 'The submission has been approved.');
    }

    public function reject($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('showcase.create')->with('error', 'You do not have permission to approve/reject submissions.');
        }
        
        $showcaseItem = ShowcaseItem::find($id);
        $showcaseItem->delete();

        return redirect()->route('showcase.admin')->with('success', 'The submission has been rejected.');
    }

    public function edit($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('showcase.index')->with('error', 'You do not have permission to edit submissions.');
        }

        $submission = ShowcaseItem::with('works')->findOrFail($id);
        return view('showcase.edit', compact('submission'));
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('showcase.index')->with('error', 'You do not have permission to update submissions.');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|mimes:jpeg,png,jpg,gif,svg,mp3,wav,mp4|max:20480', // 最大20MB
        ]);

        $submission = ShowcaseItem::findOrFail($id);
        $submission->update($request->only('name', 'title', 'description'));

        // もし新しいファイルがアップロードされていたら
        if ($request->hasFile('file')) {
            // 古いファイルを削除して
            if ($submission->works->isNotEmpty()) {
                $oldFile = $submission->works->first()->file_path;
                Storage::disk('public')->delete($oldFile);
                $submission->works->first()->delete();
            }

            // 新しいファイルを保存する
            $path = $request->file('file')->store('showcase_works', 'public');
            ShowcaseWork::create([
                'showcase_item_id' => $submission->id,
                'file_path' => $path,
            ]);
        }

        return redirect()->route('showcase.admin')->with('success', 'Submission updated successfully.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('showcase.index')->with('error', 'You do not have permission to delete submissions.');
        }

        $submission = ShowcaseItem::findOrFail($id);
        $submission->delete();

        return redirect()->route('showcase.admin')->with('success', 'Submission deleted successfully.');
    }

    public function deleteFile($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('showcase.index')->with('error', 'You do not have permission to delete files.');
        }

        $work = ShowcaseWork::findOrFail($id);
        $work->delete();

        return redirect()->back()->with('success', 'File deleted successfully.');
    }
}

