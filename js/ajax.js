function sortList(cat, order) {
    var uri = '/record-store/pages/' + cat + '/list.php?sort=' + order;
    
    $.get(uri, function(data) {
        $('#main').replaceWith(data);
        listControl();
    })
}

function toggleDetailsPage(action) {
    var actions = ['details', 'edit'];
    if (!actions.includes(action)) {
        return;
    }

    var cat = getUrlPath().replace('.php', '');
    var id = getGet('id');
    var url = getFilePath('pages/' + cat + '/' + action + '.php?id=' + id);

    $.get(url, function(data) {
        $('#main').html(data);
        if (action == 'edit') {
            bindEditControls();
        } else {
            bindDetailsControls();
        }
    })
}

function bindEditControls() {
    $(window).on('beforeunload', function() {
        return 'Alert';
    })
    cancelBtnControl();
}

function bindDetailsControls() {
    editBtnControl();
}


function cancelBtnControl() {
    var $cancelBtn = $('#cancel');
    if (!$cancelBtn) {
        return;
    }

    $cancelBtn.on('click', function() {
        if (discardAlert()) {
            toggleDetailsPage('details');
        }
    })
}

function discardAlert() {
    return window.confirm('Your changes have not been saved. Are you sure you want to cancel?');
}
