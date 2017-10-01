function sortList(cat, order) {
    var uri = '/record-store/pages/' + cat + '/list.php?sort=' + order;
    
    $.get(uri, function(data) {
        $('#main').replaceWith(data);
        listControl();
    })
}

function toggleDetailsPage(action = 'details') {
    var actions = ['details', 'edit', 'insert'];
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
                insertBtnControl();
                cancelBtnControl();
                $('.btn-edit').hide();
                break;
            case 'insert':
                $('#successMsg').show();
                // fallthrough
            case 'edit':
            default:
                editBtnControl();
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
    }).done(function(data) {
        console.log(data);
        toggleDetailsPage('insert');
    });
}