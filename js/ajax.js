function sortList(cat, order) {
    var uri = '/record-store/pages/' + cat + '/list.php?sort=' + order;
    
    $.get(uri, function(data) {
        $('#main').replaceWith(data);
        listControl();
    })
}

function editPage() {
    var cat = getUrlPath().replace('.php', '');
    var id = getGet('id');
    var url = getFilePath('pages/' + cat + '/edit.php?id=' + id);

    $.get(url, function(data) {
        $('#main').replaceWith(data);
    })
}