<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jukebox;

class JukeboxController extends Controller
{
    public function index()
    {
        $jukeboxItems = Jukebox::all();
        return view('jukebox.index', compact('jukeboxItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'youtube_url' => 'required|url',
        ]);

        Jukebox::create([
            'youtube_url' => $request->youtube_url,
        ]);

        return redirect()->back()->with('success', 'YouTube URL added to the queue.');
    }

    public function admin()
    {
        $jukeboxItems = Jukebox::all();
        return view('jukebox.admin', compact('jukeboxItems'));
    }

    public function play()
    {
        // Implement play functionality using JavaScript
        return response()->json(['status' => 'Playing']);
    }

    public function pause()
    {
        // Implement pause functionality using JavaScript
        return response()->json(['status' => 'Paused']);
    }
}
