<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JukeboxQueue;
use App\Models\User;

class JukeboxQueueController extends Controller
{
    public function addToQueue(Request $request)
    {
        $request->validate([
            'video_url' => 'required|url',
        ]);

        $videoInfo = $this->getYouTubeVideoInfo($request->video_url);

        $video = JukeboxQueue::create([
            'user_id' => auth()->id(),
            'video_title' => $videoInfo['title'],
            'video_url' => $request->video_url,
            'video_length' => $videoInfo['length'],
        ]);

        return response()->json($video, 201);
    }

    public function getQueue()
    {
        $queue = JukeboxQueue::where('status', 'queued')
                            ->orWhere('status', 'playing')
                            ->orderBy('created_at', 'asc')
                            ->get();

        return response()->json($queue);
    }

    public function playNextVideo()
    {
        $currentPlaying = JukeboxQueue::where('status', 'playing')->first();

        if ($currentPlaying) {
            $currentPlaying->update(['status' => 'played']);
        }

        $nextVideo = JukeboxQueue::where('status', 'queued')->first();

        if ($nextVideo) {
            $nextVideo->update(['status' => 'playing']);
        }

        return response()->json($nextVideo);
    }

    private function getYouTubeVideoInfo($url)
    {
        // You can use a package like Alaouy/Youtube to fetch video details
        // or YouTube Data API. Here's a mock return for simplicity.
        return [
            'title' => 'Sample Video Title',
            'length' => 300 // in seconds
        ];
    }
}
