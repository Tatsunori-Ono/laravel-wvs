<?php

namespace App\Jobs;

use App\Models\JukeboxQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PlayNextVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * 新しいジョブインスタンスを作成する。
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * ジョブを実行する。
     * Execute the job.
     */
    public function handle(): void
    {
        // JukeboxQueueControllerのインスタンスを作成して、次のビデオを再生する。
        $controller = new \App\Http\Controllers\JukeboxQueueController;
        $controller->playNextVideo();
    }
}
