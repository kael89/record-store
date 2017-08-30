$(function() {
    recordNavbarController();
})

function recordNavbarController() {
    var getParams,
        letter,
        href;

    getParams = window.location.search.substr(1);
    letter = getParams.match(/(letter=)([A-Z])/i)[2];
    href = 'browse-records.php?letter=' + letter;
    $('.pagination li').has('a[href="' + href + '"]').addClass('active');
}