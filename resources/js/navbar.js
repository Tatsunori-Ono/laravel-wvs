var prevScrollY = window.scrollY;
var topbar = document.getElementById("navbar");
var initialScroll = true;

// ページが表示されるたびにタスクバーを表示する
// Show taskbar every time page is opened
window.onpageshow = () => {
    topbar.style.top = "0";
}

// スクロールイベントの処理
window.onscroll = () => {
    var currScrollY = window.scrollY;
    if (currScrollY > 20) {
        // ブラウザによって自動的にトリガーされるスクロールイベントを避ける
        // Avoid scroll event being automatically triggered by browser
        if (!initialScroll) {
            // ユーザーがスクロールアップしたとき、ナビゲーションバーを隠さない
            // When usr scrolls up, don't hide navbar
            if (prevScrollY > currScrollY) {
                topbar.style.top = "0";
            // それ以外の場合はナビゲーションバーを隠す
            // Otherwise hide navbar
            } else {
                topbar.style.top = "-80px";
            }
        
            prevScrollY = currScrollY;
        }
    
    initialScroll = false;
  }
}
