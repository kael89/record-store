function sortList(cat, order) {
    var uri = '/record-store/pages/' + cat + '/list.php?sort=' + order;
    
    $.get(uri, function(data) {
        $('#main').html(data);
        listControl();
    })
}

function toggleDetailsPage(action = 'details') {
    var actions = ['details', 'edit', 'update'];
    if (!actions.includes(action)) {
        action = 'details';
    }
    var id = getGet('id');
    var page = (action == 'edit') ? 'edit.php' : 'details.php';
    var url = getFilePath('pages/' + getPageCat() + '/' + page + '?id=' + id);

    $.get(url, function(data) {
        $('#main').html(data);
        switch (action) {
            case 'edit':
                btnControls();
                $('.btn-edit').hide();
                break;
            case 'update':
                $('#successMsg').show();
                // fallthrough
            case 'details':
            default:
                btnControls();
                $(window).off('beforeunload');
                break;
        }
    });
}

function insertData(action) {
    var id = getGet('id');

    $.ajax({
        url: getFilePath('lib/ajax.php?action=' + action + '&id=' + id),
        type: 'POST',
        data: new FormData($('.form-edit')[0]),
        processData: false,
        contentType: false
    }).done(function(insertId) {
        if (insertId) {
            window.location.search = 'page=details&id=' + insertId + '&add=1';
        } else {
            toggleDetailsPage('update');
        }
    });
}

function deleteItem(action, id, destUrl) {
    var url = getFilePath('lib/ajax.php?action=' + action + '&id=' + id);

    $.get(url).done(function() {
        $.get(destUrl, function(data) {
            $('#main').html(data);
            $('#successMsg').show();
            btnControls();
        });
    });
}