<?php

return [
    // index画面
    'title' => '機材貸し出しサービス',
    'create' => 'カタログに新しく機材を登録する',
    'search' => '検索',
    'all-categories' => '全カテゴリ',
    'filter' => '絞り込み',
    'favourites' => 'お気に入り',
    'go-to-cart' => 'カートへ移動する',
    'details' => '詳細を表示する',
    'status-rented' => '現在、全て貸し出し中です',
    'status-available' => '個 在庫あり',
    'no-items' => '該当商品なし',

    // create画面
    'product_name' => '商品名',
    'product_type' => '機材の種類',
    'manufacturer' => '製造元',
    'category' => 'カテゴリ',
    'location_stored' => '保管場所',
    'description' => '詳細',
    'purchase_date' => '購入日',
    'quantity' => '個数',
    'max_rental_days' => 'レンタルできる最大日数（特に指定がなければ、７日を推奨）',
    'price' => 'レンタル料金（無料の場合は０を入力）',
    'images' => '商品の画像（９枚まで）',
    'submit' => '商品を新規登録',

    // show画面
    'back-to-catalogue' => 'カタログに戻る',
    'rental_days' => 'レンタル日数',
    'add-to-cart' => 'カートに追加する',
    'rented-times' => '回レンタルされました',
    'edit' => '編集する',
    'delete' => '削除する',

    // edit画面
    'edit-equipment' => '商品を編集する',
    'current-images' => '現在の画像',
    'new-images' => '新しい画像',
    'remove-image' => '削除',

    // cart/index.blade.php
    'cart' => 'カート',
    'item' => '商品',
    'update' => '更新',
    'remove' => '削除',
    'checkout-next' => '次に進む',
    'empty' => "カートは空です。",

    // checkout/index.blade.php
    'checkout' => "注文の確認",
    'confirm' => '注文を確定する',
    
    // rentals/index.blade.php
    'rental-log' => "貸し出し記録",
    'user' => 'ユーザー',
    'borrowed-at' => '借りた日時',
    'return-by' => '返却予定日',
    'actions' => '操作',
    'cancel' => 'キャンセルする',
    'no-logs' => '貸し出し記録なし',

    // rentals/edit.blade.php
    'edit-log' => '貸し出し記録を編集する',

    //dashboard.blade.php
    'no-rental' => '現在、あなたが借りている機材はありません。',
];
