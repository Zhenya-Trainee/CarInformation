jQuery(function ($){
    let navbarList = $('.navbar-nav div');

    navbarList.hover(
        function (){
            $('.newMenu li ul').stop().fadeIn(300);
        },
        function (){
            $('.newMenu li ul').stop().fadeOut(300);
        }
    );
});
