$(function() {
    bindLoadingImage();
    navbarControl();
    letterNavbarControl();
    listControl();
    btnControls();
    bindSuccessMsg();
})

function bindLoadingImage() {
    $('#loading').ajaxStart(function() {
        $(this).show();
    }).ajaxStop(function() {
        $(this).hide();
    });
}

function navbarControl() {
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

    $sortList.find('th[data-sort]').on('click', function() {
        sortList(cat, $(this).data('sort'));
    });
}

function btnControls() {
    deleteBtnControl();
    editBtnControl();
    cancelBtnControl();
    saveBtnControl();
}

function deleteBtnControl() {
    $('.btn-delete').on('click', function() {
        var item = $(this).data('item');
        var action = $(this).data('action');
        var id = $(this).data('id');
        var redirect = (getGet('page') != 'list');
        var destUrl;
        switch (action) {
            case 'delete_artist':
                if (redirect) {
                    destUrl = 'artists.php?page=list&action=delete'
                } else {
                    destUrl = getFilePath('pages/artists/list.php');
                }
                break;
            case 'delete_record':
                if (redirect) {
                    destUrl = 'records.php?page=list&action=delete'
                } else {
                    destUrl = getFilePath('pages/records/list.php');
                }
                break;
            default:
                return;
        }

        if (window.confirm('Are you sure you want to delete ' + item + '?')) {
            deleteItem(action, id, destUrl, redirect);
        }
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

function saveBtnControl() {
    var $saveBtn = $('.btn-save');
    if (!$saveBtn.length) {
        return;
    }

    $saveBtn.on('click', function(e) {
        e.preventDefault();
        $(window).off('beforeunload');
        var action = $(this).data('action');
        insertData(action);
    })
}

function alertOnUnload() {
    $(window).on('beforeunload', function() {
        return 'Alert';
    });
}

function discardAlert() {
    return window.confirm('Your changes have not been saved. Are you sure you want to cancel?');
}

function bindSuccessMsg() {
    var actions = ['add', 'delete'];

    if (performance.navigation.type != 1 && actions.indexOf(getGet('action')) != -1) {
        $('#successMsg').show();
    }
}