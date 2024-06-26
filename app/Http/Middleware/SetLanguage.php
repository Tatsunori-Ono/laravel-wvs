<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class SetLanguage
{
    /**
     * リクエストを処理する。
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // セッションから言語設定を取得し、存在しない場合はデフォルトの言語設定を使用
        $locale = Session::get('locale', config('app.locale'));
        Log::info('Current locale:', ['locale' => $locale]);

        // アプリケーションのロケールを設定
        App::setLocale($locale);

        return $next($request);
    }
}
