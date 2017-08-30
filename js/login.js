$(function() {
    var $loginForm = $('#loginForm');

    $loginForm.attr('novalidate', '');
    $loginForm.on('submit', function(e) {
        validateLogin(e);
    });
})

function validateLogin(e) {
    var valid;

    e.preventDefault();
    valid = hasValue('password');
    if (hasValue('email')) {
        validateUser(valid);
    }
}

function validateUser(valid) {
    var email = $('#email input').val().trim().toLowerCase();
    var password = $('#password input').val();

    return $.ajax({
        type: 'POST',
        url: '/record-store/lib/queries.php?action=user_login',
        data: {
            "email": email,
            "password": password
        }
    }).done(function(result) {
        if (result) {
            removeError('email');
            $('#loginForm')[0].submit();
        } else {
            addError('email', 'Wrong username and/or password');
        }
    });
}