$(function() {
    headerControl();
    letterNavbarControl();
    logoutBtnControl();
})

function headerControl() {
    var getParams = window.location.search.substr(1);
    var matches = getParams.match(/page=[^&]*/);
    var page = (matches != null) ? matches[0] : 'main';
    var regex = page + '$';

    var found = false;
    $('.navbar-nav li a').each(function() {
        var href = $(this).attr('href');

        if (href.search(regex) != -1) {
            $(this).parents('li').addClass('active');
            found = true;
            return false;
        }
        return true;
    });

    if (!found) {
        $('#main-page').addClass('active');
    }
}

function letterNavbarControl() {
    if (!$('.letter-navbar')) {
        return;
    }

    var getParams = window.location.search.substr(1);
    var matches = getParams.match(/letter=([A-Z])/i);
    var letter = (matches) ? matches[1] : 'a';
    var index = letter.charCodeAt() - 'a'.charCodeAt();
    $('.letter-navbar ul li').eq(index).addClass('active');
}
function logoutBtnControl() {
    $('#logoutBtn').on('click', function() {
        $.get('/record-store/lib/ajax.php?action=user_logout');
    })
}