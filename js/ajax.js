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

    var id = getGet('id');
    var url = getFilePath('pages/' + getPageCat() + '/' + action + '.php?id=' + id);

    $.get(url, function(data) {
        $('#main').html(data);
        if (action == 'edit') {
            cancelBtnControl();
            $('.btn-edit').hide();
        } else {
            editBtnControl();
            $(window).off('beforeunload');
        }
    });
}

function insertData() {
    var formData = $('.form-edit').serialize();
    var id = getGet('id');
    var url = getFilePath(getPageCat() + '.php?page=details&id = ' + id);

    $.post(url, formData, function(data) {
        $('#main').replaceWith(data);
    });
}