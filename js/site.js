$(function() {
    initButtons();
})

function initButtons() {
    var $signupBtn = $('#signup');

    $signupBtn.on('submit', function(e) {
        validateSignup(e);
    });
}