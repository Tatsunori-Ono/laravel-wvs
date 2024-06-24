<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jukebox;

use Illuminate\Support\Facades\Auth;

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
            'youtube_url' => [
                'required',
                'url',
                function ($attribute, $value, $fail) {
                    $urlObj = parse_url($value);
                    if (!isset($urlObj['host']) || $urlObj['host'] !== 'www.youtube.com' || !isset($urlObj['query'])) {
                        $fail('The ' . $attribute . ' is not a valid YouTube URL.');
                    }
    
                    parse_str($urlObj['query'], $queryParams);
                    if (!isset($queryParams['v'])) {
                        $fail('The ' . $attribute . ' is not a valid YouTube URL.');
                    }
                },
            ],
        ]);

        Jukebox::create([
            'youtube_url' => $request->youtube_url,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', __('jukebox.success'));
    }

    public function admin()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }

        $jukeboxItems = Jukebox::all();
        return view('jukebox.admin', compact('jukeboxItems'));
    }

    public function play()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }

        // Implement play functionality using JavaScript
        return response()->json(['status' => 'Playing']);
    }

    public function pause()
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }

        // Implement pause functionality using JavaScript
        return response()->json(['status' => 'Paused']);
    }

    public function destroy($id)
    {
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to visit admin page.');
        }

        $jukeboxItem = Jukebox::findOrFail($id);
        $jukeboxItem->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
