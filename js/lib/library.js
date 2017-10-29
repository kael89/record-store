function hasValue(field) {
    var fieldValue = $('#' + field + ' input').val(),
        $fieldLabel = $('label[for="' + field + '"]');

    if (field != 'password') {
        fieldValue = fieldValue.trim();
    }

    if (!fieldValue) {
        addError(field, 'Field required');
        return false;
    } else {
        removeError(field);
        return true;
    }
}

function addError(field, err) {
    var $fieldGroup = $('#' + field),
        $fieldFeedback = $('#' + field + ' .form-control-feedback');
        $fieldLabel =  $('label[for="' + field + '"]');

    $fieldGroup.addClass('has-error has-feedback');
    $fieldFeedback.addClass('glyphicon glyphicon-remove');
    $fieldLabel.html(err);
}

function removeError(field) {
    var $fieldGroup = $('#' + field),
        $fieldFeedback = $('#' + field + ' .form-control-feedback');
        $fieldLabel =  $('label[for="' + field + '"]');

    $fieldGroup.removeClass('has-error has-feedback');
    $fieldFeedback.removeClass('glyphicon glyphicon-remove');
    $fieldLabel.html('');
}

function getPageCat() {
    return window.location.pathname.substr(1).replace('.php', '');
}

function getGet(name) {
    var regex = name + '=([^&]*)';
    var match = window.location.search.match(regex);

    return (match) ? match[1] : '';
}

function getSelected(selector) {
    $el = $(selector);
    return ($el.length) ? $el.find(':selected').val() : '';
}

function bindOnClickOutside($el, callback) {
    var clickOutside = 'click.outside' + $el.attr('id');

    $(document).on(clickOutside, function(e) {
        // check if user has clicked outside $updateTarget element
        if (!$(e.target).closest($el).length) {
            callback();
            $(document).off(clickOutside);
        }
    });
}