<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('jukebox.admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Jukeboxのキュー表示 -->
                    <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">{{ __('jukebox.queue') }}</h2>
                    @if($jukeboxItems->count())
                        <div class="lg:w-2/3 w-full mx-auto overflow-auto mt-4">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">{{ __('jukebox.id') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('jukebox.url') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('jukebox.by') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('jukebox.at') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('jukebox.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jukeboxItems as $index => $item)
                                        <tr data-index="{{ $index }}">
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->id }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->youtube_url }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->user->name }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->created_at }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">
                                                <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded mb-3" onclick="loadVideo('{{ $item->youtube_url }}', {{ $index }})">{{ __('jukebox.jump') }}</button>
                                                <form action="{{ route('jukebox.destroy', $item->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded">{{ __('jukebox.delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- 再生と一時停止ボタン -->
                        <div class="mt-4 flex justify-center space-x-4">
                            <button id="play" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">{{ __('jukebox.play') }}</button>
                            <button id="pause" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">{{ __('jukebox.pause') }}</button>
                        </div>
                        
                        <!-- YouTubeプレーヤー -->
                        <!-- YouTube Player -->
                        <div class="flex justify-center mt-4">
                            <div id="player"></div>
                        </div>

                    @else
                        <p class="text-red-500 mt-5">{{ __('jukebox.no-items') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script src="https://www.youtube.com/iframe_api"></script>
    <script>
        var player;
        var playerReady = false;
        var currentIndex = -1;
        var jukeboxItems = @json($jukeboxItems); // PHPで定義されたJukeboxアイテムのリストをJavaScriptに挿入

        // YouTubeのIFrame APIの準備ができたときに呼び出される関数
        function onYouTubeIframeAPIReady() {
            // YouTubeプレーヤーを作成
            player = new YT.Player('player', {
                height: '390',
                width: '640',
                videoId: '',
                events: {
                    'onReady': onPlayerReady, // プレーヤーの準備ができたときに呼び出される関数
                    'onStateChange': onPlayerStateChange // プレーヤーの状態が変化したときに呼び出される関数
                }
            });
        }

        // プレーヤーの準備ができたときに呼び出される関数
        function onPlayerReady(event) {
            playerReady = true; // プレーヤーが準備完了したことをフラグで示す
            if (currentIndex !== -1) {
                player.playVideo(); // currentIndexが-1でない場合、ビデオを再生
            }
        }

        // プレーヤーの状態が変化したときに呼び出される関数
        function onPlayerStateChange(event) {
            // ビデオの再生が終了した場合、次のビデオを再生する関数を呼び出す
            if (event.data === YT.PlayerState.ENDED) {
                playNextVideo();
            }
        }

        // YouTubeの動画をロードして再生する関数
        function loadVideo(url, index) {
            var videoId = getYouTubeVideoId(url);
            if (videoId) {
                currentIndex = index; // 現在のインデックスを更新
                if (playerReady) {
                    player.loadVideoById(videoId); // プレーヤーが準備完了していれば動画をロードして再生
                } else {
                    console.log('Player is not ready'); // プレーヤーが準備されていない場合のエラーメッセージ
                }
            } else {
                console.log('Invalid YouTube URL:', url); // 不正なYouTube URLの場合のエラーメッセージ
                alert('Invalid YouTube URL. Please enter a valid YouTube video URL.'); // アラートを表示してエラーを通知
            }
        }

        // YouTubeの動画URLから動画IDを取得する関数
        function getYouTubeVideoId(url) {
            var videoId = null;
            var urlObj = new URL(url);
            if (urlObj.hostname === 'www.youtube.com' && urlObj.pathname === '/watch') {
                videoId = urlObj.searchParams.get('v');
            }
            return videoId;
        }

        // 次のビデオを再生する関数
        function playNextVideo() {
            if (currentIndex + 1 < jukeboxItems.length) {
                var nextIndex = currentIndex + 1;
                loadVideo(jukeboxItems[nextIndex].youtube_url, nextIndex);
            }
        }

        // 再生ボタンのクリック時に呼び出される関数
        document.getElementById('play').addEventListener('click', function() {
            if (playerReady && currentIndex === -1 && jukeboxItems.length > 0) {
                loadVideo(jukeboxItems[0].youtube_url, 0); // 最初のビデオを再生
            } else if (playerReady) {
                player.playVideo(); // プレーヤーが準備完了していて、currentIndexが-1でない場合、ビデオを再生
            } else {
                console.log('Player is not ready'); // プレーヤーが準備されていない場合のエラーメッセージ
            }
        });

        // 一時停止ボタンのクリック時に呼び出される関数
        document.getElementById('pause').addEventListener('click', function() {
            if (playerReady) {
                player.pauseVideo(); // プレーヤーが準備完了していればビデオを一時停止
            } else {
                console.log('Player is not ready'); // プレーヤーが準備されていない場合のエラーメッセージ
            }
        });
    </script>
</x-app-layout>
