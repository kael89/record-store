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