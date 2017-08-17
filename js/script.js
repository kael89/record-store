$(function() {
    headerController();
})

function headerController() {
    var url = window.location.pathname.split('/').slice(-1);
    $('.navbar-nav li').has('a[href="' + url + '"]').addClass('active');
}