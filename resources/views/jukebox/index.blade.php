<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('jukebox.title') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Jukeboxアイテムの追加フォーム -->
                    <form id="jukebox-form" action="{{ route('jukebox.store') }}" method="POST" class="mb-8">
                        @csrf
                        <label for="youtube_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('jukebox.url') }}</label>
                        <input type="url" name="youtube_url" id="youtube_url" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white" required>
                        <button type="submit" class="mt-4 text-white bg-pink-500 border-0 py-2 px-8 focus:outline-none hover:bg-pink-600 rounded text-base">{{ __('jukebox.add') }}</button>
                    </form>

                    <!-- 成功メッセージの表示 -->
                    @if(session('success'))
                        <div class="mb-4 text-green-500">{{ session('success') }}</div>
                    @endif

                    <h2 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">{{ __('jukebox.queue') }}</h2>
                    @if($jukeboxItems->count())
                        <!-- Jukeboxアイテムのテーブル表示 -->
                        <div class="lg:w-2/3 w-full mx-auto overflow-auto mt-4">
                            <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">{{ __('jukebox.id') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('jukebox.url') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('jukebox.by') }}</th>
                                        <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">{{ __('jukebox.at') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jukeboxItems as $item)
                                        <tr>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->id }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->youtube_url }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->user->name }}</td>
                                            <td class="border-t-2 border-gray-200 px-4 py-3">{{ $item->created_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-red-500 mt-4">{{ __('jukebox.no-items') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        // フォームの送信時にYouTubeのURLが有効か確認する関数
        document.getElementById('jukebox-form').addEventListener('submit', function(event) {
            var urlInput = document.getElementById('youtube_url');
            var url = urlInput.value;
            if (!isValidYouTubeUrl(url)) {
                alert('The provided URL is not a valid YouTube URL.'); // 正しい形式ではないURLの場合はアラートを表示してフォーム送信をキャンセル
                event.preventDefault();
            }
        });

        // YouTubeのURLが有効かどうかをチェックする関数
        function isValidYouTubeUrl(url) {
            var urlObj;
            try {
                urlObj = new URL(url); // URLオブジェクトを作成し、エラーが発生しなければ有効なURLと判断
            } catch (_) {
                return false; // エラーが発生した場合は無効なURLと判断
            }
            if (urlObj.hostname === 'www.youtube.com' && urlObj.pathname === '/watch') {
                var videoId = urlObj.searchParams.get('v'); // URLがYouTubeの規定に従っているか確認し、動画IDを取得
                return videoId !== null; // 動画IDが取得できれば有効なYouTube URLと判断
            }
            return false; // 上記の条件に該当しない場合は無効なURLと判断
        }
    </script>

</x-app-layout>
