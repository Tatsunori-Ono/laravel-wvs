<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Jukebox Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">{{ __('Queue') }}</h2>
                    @if($jukeboxItems->count())
                        <div class="lg:w-2/3 w-full mx-auto overflow-auto mt-4">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">{{ __('ID') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('YouTube URL') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('Added By') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('Added At') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('Actions') }}</th>
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
                                                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-3" onclick="loadVideo('{{ $item->youtube_url }}', {{ $index }})">{{ __('Jump here') }}</button>
                                                <form action="{{ route('jukebox.destroy', $item->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">{{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 flex justify-center space-x-4">
                            <button id="play" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">{{ __('Play') }}</button>
                            <button id="pause" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">{{ __('Pause') }}</button>
                        </div>
                        
                        <div class="flex justify-center mt-4">
                            <div id="player"></div> <!-- YouTube Player -->
                        </div>

                    @else
                        <p>{{ __('No items in the queue.') }}</p>
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
        var jukeboxItems = @json($jukeboxItems);

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('player', {
                height: '390',
                width: '640',
                videoId: '',
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        function onPlayerReady(event) {
            playerReady = true;
            if (currentIndex !== -1) {
                player.playVideo();
            }
        }

        function onPlayerStateChange(event) {
            if (event.data === YT.PlayerState.ENDED) {
                playNextVideo();
            }
        }

        function loadVideo(url, index) {
            var videoId = getYouTubeVideoId(url);
            if (videoId) {
                currentIndex = index;
                if (playerReady) {
                    player.loadVideoById(videoId);
                } else {
                    console.log('Player is not ready');
                }
            } else {
                console.log('Invalid YouTube URL:', url);
                alert('Invalid YouTube URL. Please enter a valid YouTube video URL.');
            }
        }

        function getYouTubeVideoId(url) {
            var videoId = null;
            var urlObj = new URL(url);
            if (urlObj.hostname === 'www.youtube.com' && urlObj.pathname === '/watch') {
                videoId = urlObj.searchParams.get('v');
            }
            return videoId;
        }

        function playNextVideo() {
            if (currentIndex + 1 < jukeboxItems.length) {
                var nextIndex = currentIndex + 1;
                loadVideo(jukeboxItems[nextIndex].youtube_url, nextIndex);
            }
        }

        document.getElementById('play').addEventListener('click', function() {
            if (playerReady && currentIndex === -1 && jukeboxItems.length > 0) {
                loadVideo(jukeboxItems[0].youtube_url, 0);
            } else if (playerReady) {
                player.playVideo();
            } else {
                console.log('Player is not ready');
            }
        });

        document.getElementById('pause').addEventListener('click', function() {
            if (playerReady) {
                player.pauseVideo();
            } else {
                console.log('Player is not ready');
            }
        });
    </script>
</x-app-layout>
