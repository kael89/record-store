function validateSignup(e) {
    var valid;

    valid = isSet('firstName') & isSet('lastName');
    valid &= (isSet('email')) ? validateEmail(e) : false;
    valid &= (isSet('password') & isSet('passwordRepeat')) ? validatePassword() : false;

    if (!valid) {
        e.preventDefault();
    }
}

function isSet(field) {
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

function validateEmail(e) {
    var email = $('#email input').val().trim().toLowerCase(),
        pattern = "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?";
e.preventDefault();
    if (email.search(pattern) < 0) {
        addError('email', 'Please enter a valid email');
        return false;
    } else  {
        var data = {
            "table": 'users',
            "columns": {
                'email': "='" + email + "'"
            }
        };

        $.post('/record_store/lib/database.php?action=get_rows', data, function(result) {
            alert(result);
            if (result) {
                addError('email', 'Email already exists');
                return false;
            } else {
                removeError('email');
                return true;
            }
        });
    }
}

function validatePassword() {
    var password = $('#password input').val(),
        passwordRepeat = $('#passwordRepeat input').val(),
        $passwordLabel = $('label[for="password"]');

    if (password != passwordRepeat) {
        addError('password', 'Passwords do not match');
        addError('passwordRepeat', '');
        return false;
    } else if (password.length < 4 || password.length > 16) {
        addError('password', 'Your password must be 4-16 characters long');
        removeError('passwordRepeat');
        return false;
    } else if (password.search(/[A-Z]|[^a-z\d\s]/) < 0) {
        addError('password', 'Your password must containt at least one uppercase or special character');
        removeError('passwordRepeat');
        return false;
    } else {
        removeError('password');
        removeError('passwordRepeat');
        return true;
    }
}