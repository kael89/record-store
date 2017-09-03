$(function() {
    recordNavbarController();
})

function recordNavbarController() {
    var getParams,
        matches,
        letter,
        index;

    getParams = window.location.search.substr(1);
    matches = getParams.match(/letter=([A-Z])/i);
    letter = (matches) ? matches[1] : 'a';
    index = letter.charCodeAt() - 'a'.charCodeAt();
    $('.pagination li').eq(index).addClass('active');
}