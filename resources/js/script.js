window.addEventListener('DOMContentLoaded', () => {
    $('.nav-link').click(function () {
        $('.nav-link').not(this).removeClass('active');
        $(this).addClass('active');
    });
    $(window).click(function(event){
        if($(event.target).hasClass('navbar-toggler-icon') == false ){
            if($(event.target).hasClass('navbar-mobile') == false && $('body').hasClass('navbar-open')){	
                $('body').removeClass('navbar-open');
             }
        }
	});
    $("div.pswp").remove();
    $(window).click(function(event){
		if($(event.target).attr('id')!='hamburger' && $('#sidebarMenu').hasClass('show')){	
            event.preventDefault();
			$('#sidebarMenu').removeClass('show');
		}
	});
});