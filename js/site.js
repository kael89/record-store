$(function() {
    initButtons();
})

function initButtons() {
    var $signupBtn = $('#signup');

    $signupBtn.on('click', function(e) {
        validateSignup(e);
    });
}