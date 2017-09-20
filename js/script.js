$(function() {
    bindLoadingImage();
    headerControl();
    letterNavbarControl();
    sortList();
})

function bindLoadingImage() {
    $('#loading').ajaxStart(function() {
        $(this).show();
    }).ajaxStop(function() {
        $(this).hide();
    });
}

function headerControl() {
    var uri = window.location.pathname.substr(1);
    var matches = uri.match(/\/(.*).php/);
    var menu = (matches != null) ? matches[1] : 'index';

    $('#navbar > ul > li#menu-' + menu).addClass('active')
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

function sortList() {
    var $sortList = $('.sortlist');
    var cat = $sortList.data('content');

    if (!$sortList) {
        return;
    }

    $sortList.find('th').on('click', function() {
        var uri = '/record-store/pages/' + cat + '/list.php?sort=' + $(this).data('sort');

        $.get(uri, function(data) {
            $('#listContainer').replaceWith(data);
            sortList();
        })
    });
}
