$(function() {
    letterNavbarController();
})

function letterNavbarController() {
    var getParams = window.location.search.substr(1);
    var matches = getParams.match(/letter=([A-Z])/i);
    var letter = (matches) ? matches[1] : 'a';
    var index = letter.charCodeAt() - 'a'.charCodeAt();
    $('.letterNavbar ul li').eq(index).addClass('active');
}