var tracklist;

$(function() {
    bindLoadingImage();
    navbarControl();
    letterNavbarControl();
    listControl();
    dataEditControls();
    bindSuccessMsg();
});

function bindLoadingImage() {
    $('#loading').ajaxStart(function() {
        $(this).show();
    }).ajaxStop(function() {
        $(this).hide();
    });
}

function navbarControl() {
    cat = getPageCat();
    if (cat === '') {
        cat = 'index';
    }
    console.log('#menu -' + cat);
    $('#navbar #menu-' + cat).addClass('active')
}

function letterNavbarControl() {
    if (!$('.letter-navbar').length) {
        return;
    }

    var getParams = window.location.search.substr(1);
    var matches = getParams.match(/letter=([A-Z])/i);
    var index;
    if (matches) {
        index = matches[1].charCodeAt() - 'A'.charCodeAt() + 1;
    } else {
        // Corresponds to 'All' option
        index = 0;
    }

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

function dataEditControls() {
    // btn-save, btn-edit, btn-delete: final database changes
    // btn-insert, btn-update, btn-remove: temporary display changes

    cancelBtnControl();

    insertBtnControl();
    updateBtnControl();
    removeBtnControl();

    editBtnControl();
    deleteBtnControl();
    saveBtnControl();

    tracklistControl();
    draggableControl();
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
    $('.btn-insert').on('click', function(e) {
        e.stopPropagation();

        var target = $(this).data('target');
        var $target = $('#' + target);
        var cat = getListCat(target);

        addFormUpdateNew(cat);
        toggleUpdateForm($target);
        $target.show();
        enumerateList(cat);
        bindOnClickOutside($target, function() {
            updateForm($target);
            updateTracklist($target, 'insert');
        });
    });
}

function updateBtnControl($btnUpdate = $('.btn-update')) {
    $btnUpdate.on('click', function() {
        var target = $(this).data('target');
        var $target = $('#' + target);

        toggleUpdateForm($target);
        bindOnClickOutside($target, function() {
            updateForm($target);
            updateTracklist($target, 'update');
        });
    });
}

function removeBtnControl($btnRemove = $('.btn-remove')) {
    $btnRemove.on('click', function() {
        var target = $(this).data('target');
        var $target = $('#' + target);

        var listCat = getListCat(target);
        $target.hide();
        enumerateList(listCat);
        updateTracklist($target, 'remove');
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

function deleteBtnControl() {
    $('.btn-delete').on('click', function() {
        var item = $(this).data('item');
        var action = $(this).data('action');
        var id = $(this).data('id');
        var destUrl,
            redirect,
            recordId;

        switch (action) {
            case 'delete_artist':
                redirect = (getGet('page') != 'list');
                if (redirect) {
                    destUrl = 'artists.php?page=list&action=delete'
                } else {
                    destUrl = 'pages/artists/list.php';
                }
                break;
            case 'delete_record':
                redirect = (getGet('page') != 'list');
                if (redirect) {
                    destUrl = 'records.php?page=list&action=delete'
                } else {
                    destUrl = 'pages/records/list.php';
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

function updateForm($form) {
    $form.find(':input').each(function() {
        var val = $(this).val();
        $(this).siblings('.update-val').html(val);
    })
    toggleUpdateForm($form);
}

function addFormUpdateNew(cat) {
    var ids = [];
    $('[id^="' + cat + '-new-"]').each(function() {
        var id = $(this).attr('id').split('-')[2];
        ids.push(parseInt(id) + 1);
    });

    var id = (ids.length > 0) ? Math.max(ids) : 1;
    var newId = cat + '-new-' + id;
    var oldId = new RegExp(cat + '-new', 'g');
    var $insertedEl = $('#' + cat + '-new');
    var $formUpdateNew = $insertedEl.clone().hide();

    $insertedEl.html($insertedEl.html().replace(oldId, newId))
               .attr('id', newId)
               .removeClass('form-update-new')
               .after($formUpdateNew);

    updateBtnControl($insertedEl.find('.btn-update'));
    removeBtnControl($insertedEl.find('.btn-remove'));
}

function toggleUpdateForm($form) {
    $form.find('.update-val').toggle();
    $form.find(':input').each(function() {
        $(this).toggle();
    });
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

function getListCat(id) {
    var parts = id.split('-');
    return (parts) ? parts[0] : '';
}

function enumerateList(cat) {
    $i = 1;
    $('.' + cat + '-list.list-enum').find('.' + cat + '-index:visible').each(function() {
        $(this).text($i + '.');
        $i++;
    });
    updateTracklist();
}

function draggableControl() {
    $('[draggable]').on('dragstart', function(e) {
        e.originalEvent.dataTransfer.setData('text', e.target.id);

        var dropId = $(this).data('drop');
        var $dropTarget = $('#' + dropId);
        // check if the draggable element belongs in an enumerated list
        var listCat = getListCat($(this).attr('id'));

        $dropTarget.on('dragover', function(e) {
            e.preventDefault();
        });
    
        $dropTarget.on('drop', function(e) {
            e.preventDefault();
            var id = e.originalEvent.dataTransfer.getData('text');
            $(e.target).closest('tr').after($('#' + id));
            enumerateList(listCat);
        });
    });
}

function tracklistControl() {
    if (!$('#tracklist').length) {
        return false;
    }

    tracklist = new Tracklist('tracklist');
    return true;
}

function updateTracklist($track, action) {
    if (!tracklist) {
        return;
    }
    
    if (!arguments.length) {
        tracklist.update();
    } else {
        var trackId = $track.attr('id');
        if (getListCat(trackId) != 'tracks') {
            return;
        }

        switch (action) {
            case 'insert':
                tracklist.insertTrack(trackId);
                break;
            case 'update':
            // fallthrough
            case 'remove':
                $track.trigger(action);
                break;
            default:
                break;
        }
    }
}