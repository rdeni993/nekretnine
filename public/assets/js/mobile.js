$(document).ready(function(){
    $(".open-menu").click(function(){
        $(".w-search").slideToggle();
        $(".nav-menu").slideToggle();
    });
    $(".open-fast").click(function(){
        $(".in-page-nav").slideToggle();
        $(".article-search").toggle();
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });
    $(".user-profile-open").click(function(link){
        link.preventDefault();
        var targetLink = $(this).attr("href");
        location.href=targetLink;
    });
    $(".article-info").click(function(link){
        alert("Heloo")
    });
    $(".share-btn").click(function(link){
        link.preventDefault();
        window.open("https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fr-writter.tk%2Farticle%2Findex%2F135%2FStan&amp;src=sdkpreparse")
    });
    $(".set-cookie").click(function(){
        $.get(
            localhost + 'adminservice/gdpr',
            function(response){
                var res = JSON.parse(response);
                if(res.response == true){
                    $(".cookies-info").remove();
                }
            }
        )
    });
});