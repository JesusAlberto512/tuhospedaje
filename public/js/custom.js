var lastScrollTop = 0;
$(window).scroll(function(event){
    if( $("#bar-menu-movil-bottom").length ){
        var st = $(this).scrollTop() + $(window).height();
        if (st > lastScrollTop){
            var topPositionBar = $("#bar-menu-movil-bottom").prev().position().top + $("#bar-menu-movil-bottom").prev().height();
            if( st < topPositionBar ){
                $("#bar-menu-movil-bottom").addClass("scrollDown");
            }else{
                $("#bar-menu-movil-bottom").removeClass("scrollDown");
            }
        } else {
            $("#bar-menu-movil-bottom").removeClass("scrollDown");
        }
        lastScrollTop = st;
    }
});
