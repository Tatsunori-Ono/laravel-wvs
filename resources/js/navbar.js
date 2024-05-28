var prevScrollY = window.scrollY;
var topbar = document.getElementById("navbar");
var initialScroll = true;

// Show taskbar every time page is opened
window.onpageshow = () => {
    topbar.style.top = "0";
}

window.onscroll = () => {
    var currScrollY = window.scrollY;
    if (currScrollY > 20) {
      // Avoid scroll event being automatically triggered by browser
      if (!initialScroll) {
          // When usr scrolls up, don't hide navbar
          if (prevScrollY > currScrollY) {
              topbar.style.top = "0";
          // Otherwise hide navbar
          } else {
              topbar.style.top = "-80px";
          }
      
          prevScrollY = currScrollY;
      }
    
    initialScroll = false;
  }
}
