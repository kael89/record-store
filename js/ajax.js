function sortList(cat, order) {
    var uri = '/pages/' + cat + '/list.php?sort=' + order;
    
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
    var url = 'pages/' + getPageCat() + '/' + page + '?id=' + id;

    $('#loading').show();
    $.get(url, function(data) {
        $('#main').html(data);
        switch (action) {
            case 'edit':
                dataEditControls();
                $('.btn-edit').hide();
                break;
            case 'update':
                $('#successMsg').show();
                // fallthrough
            case 'details':
            default:
                dataEditControls();
                $(window).off('beforeunload');
                break;
        }
    }).done(function() {
        $('#loading').hide();
    });
}

function insertData(action) {
    var id = getGet('id');
    var data = new FormData($('.form-edit')[0]);
    if (tracklist) {
        tracklist.fetchArtist();
        data.append('tracks', JSON.stringify(tracklist.getTrackData()));
    }

    $('#loading').show();
    $.ajax({
        url: 'lib/ajax.php?action=' + action + '&id=' + id,
        type: 'POST',
        data: data,
        processData: false,
        contentType: false
    }).done(function(insertId) {
        // debug AJAX result
        // console.log(insertId); return;
        $('#loading').hide();
        if (action.indexOf('add') == 0) {
            window.location.search = 'page=details&id=' + insertId + '&action=insert';
        } else {
            toggleDetailsPage('update');
        }
    });
}

function deleteItem(action, id, destUrl, redirect = false) {
    var url = 'lib/ajax.php?action=' + action + '&id=' + id;

    $('#loading').show();
    $.get(url).done(function() {
        $('#loading').hide();
        if (redirect) {
            window.location = destUrl;
        } else {
            $.get(destUrl, function(data) {
                $('#main').html(data);
                $('#successMsg').show();
                dataEditControls();
            });
        }
    });
}