<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    /**
     * コントローラの動作確認用
     * Controller for testing the application
     *
     * @return \Illuminate\View\View
     */
    public function index() {

        // エロクアントを使用して全てのレコードを取得
        $values = Test::all();

        // レコードのカウントを取得
        $count = Test::count();

        // IDが1のレコードを取得（見つからなければエラーを発生させる）
        $first = Test::findOrFail(1);

        // text列が'bbb'のレコードを取得
        $whereBBB = Test::where('text', '=', 'bbb');

        // クエリビルダを使用してtext列が'bbb'のレコードを取得し、idとtext列のみを選択
        $queryBuilder = DB::table('tests')->where('text', '=', 'bbb')
        ->select('id', 'text')
        ->get();

         // デバッグ情報を出力
        dd($values, $count,$first, $whereBBB, $queryBuilder);

        return view('tests.test', compact('values'));
    }
}
