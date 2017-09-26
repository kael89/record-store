$(function() {
    bindLoadingImage();
    headerControl();
    letterNavbarControl();
    listControl();
    editBtnControl();
    cancelBtnControl();
    insertBtnControl();
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
    if (!$('.letter-navbar').length) {
        return;
    }

    var getParams = window.location.search.substr(1);
    var matches = getParams.match(/letter=([A-Z])/i);
    var letter = (matches) ? matches[1] : 'a';
    var index = letter.charCodeAt() - 'a'.charCodeAt();
    $('.letter-navbar ul li').eq(index).addClass('active');
}

function listControl() {
    var $sortList = $('.sortlist');
    if (!$sortList.length) {
        return;
    }
    var cat = $sortList.data('content');

    $sortList.find('th').on('click', function() {
        sortList(cat, $(this).data('sort'));
    });
}

function editBtnControl() {
    var $editBtn = $('.btn-edit');
    if (!$editBtn.length) {
        return;
    }

    $editBtn.on('click', function() {
        toggleDetailsPage('edit');
    });
}

function cancelBtnControl() {
    var $cancelBtn = $('.btn-cancel');
    if (!$cancelBtn.length) {
        return;
    }

    $cancelBtn.on('click', function() {
        if (discardAlert()) {
            toggleDetailsPage('details');
        }
    });

    alertOnUnload();
}

function insertBtnControl() {
    var $insertBtn = $('.btn-insert');
    if (!$insertBtn.length) {
        return;
    }

    $insertBtn.on('click', alertOnUnload);
}

function alertOnUnload() {
    $(window).on('beforeunload', function() {
        return 'Alert';
    });
}

function discardAlert() {
    return window.confirm('Your changes have not been saved. Are you sure you want to cancel?');
}