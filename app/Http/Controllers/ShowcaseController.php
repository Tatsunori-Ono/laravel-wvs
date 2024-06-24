<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShowcaseItem;
use App\Models\ShowcaseWork;
use Illuminate\Support\Facades\Auth;

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
        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'file' => 'required|mimes:jpeg,png,jpg,gif,svg,mp3,mp4|max:20480', // 20MB max
        ]);

        $showcaseItem = ShowcaseItem::create([
            'name' => $request->name,
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id(),
            'approved' => false, // initially not approved
        ]);

        if ($request->hasFile('file')) {
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
        return view('showcase.admin', compact('submissions'));
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
}

