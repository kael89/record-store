$(function() {
    var $signupForm = $('#signupForm');

    $signupForm.attr('novalidate', '');
    $signupForm.on('submit', function(e) {
        validateSignup(e);
    });
});

function validateSignup(e) {
    var valid;

    e.preventDefault();
    valid = hasValue('firstName') & hasValue('lastName');
    valid &= (hasValue('password') & hasValue('passwordRepeat')) ? validatePassword() : false;
    if (hasValue('email')) {
        validateEmail(valid);
    }
}

function validateEmail(valid) {
    var email = $('#email input').val().trim().toLowerCase(),
        pattern = "[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?";

    if (email.search(pattern) < 0) {
        addError('email', 'Please enter a valid email');
        return false;
    }

    return $.ajax({
        type: 'POST',
        url: '/record-store/lib/queries.php?action=get_rows',
        data: {
            "table": 'users',
            "columns": {
                "email": "='" + email + "'"
            }
        }
    }).done(function(result) {
        if (result) {
            addError('email', 'Email already exists');
        } else {
            removeError('email');
            if (valid) {
                $('#signupForm')[0].submit();
            }
        }
    });
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