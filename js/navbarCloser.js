let x = false;
let isScroll = false;
var menuIcon = document.getElementById("navbarClose");
window.onscroll = function () {
    myFunction()
};

function myFunction() {
    if (x) {
        x = false;
        isScroll = true;
        menuIcon.click();
    } else {
        isScroll = false;
    }
}

function myFun() {
    if (!isScroll) {
        x = true;
    }
}