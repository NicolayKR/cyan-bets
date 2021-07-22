window.addEventListener('DOMContentLoaded', () => {
    $('.nav-link').click(function () {
        $('.nav-link').not(this).removeClass('active');
        $(this).addClass('active');
    });
});