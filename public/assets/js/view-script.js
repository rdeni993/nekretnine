$(document).ready(function(){
    /** View */
    $(".w-search input").on("focus", function(){
        $(this).css("text-align", "left");
    });
    /** Change description value */
    $("input[name='prop_price_min']").change(function(){
        $(".pp-min").html($(this).val())
    });
    $("input[name='prop_price_max']").change(function(){
        $(".pp-max").html($(this).val())
    });
    $("input[name='prop_size_min']").change(function(){
        $(".ps-min").html($(this).val())
    });
    $("input[name='prop_size_max']").change(function(){
        $(".ps-max").html($(this).val())
    });
    $(".more-options").click(function(button){
        button.preventDefault();
        $(".custom-search-option").slideToggle();
    });
    $(".open-form-button").click(function(button){
        button.preventDefault();
        $(".open-form-button").removeClass('active');
        $(this).addClass("active");
        var winOpn = $(this).attr('data-id');
        $(".image-form-info").hide();
        $(".basic-form-info").hide();
        $(".describe-form-info").hide();
        $("." + winOpn).show();
    });
    $(".user-profile-switcher a").click(function(link){
        link.preventDefault();
        $(".user-profile-switcher a").removeClass('active');
        $(this).addClass("active");
        var winOpn = $(this).attr('data-id');
        $(".user-dash").hide();
        $("."+winOpn).show();
        if(winOpn == 'admin'){
            location.href = localhost + 'admin';
        }
    });
    $(".prop-finish").click(function(button){
        // Prepare ID
        var articleId = $(this).attr('data-id');
        var userId = $(this).attr('data-user');
        // Make GET Request
        $.get(
            localhost + "adminservice/mark_article_as_finished",
            {
                'article_ID' : articleId,
                'user_ID' : userId
            },
            function(response){
                alert(response);
            }
        );
    });
    $(".article-prop-imgs img").click(function(){
        $(".page-carousel").show();
    });
    $(".nested-carousel-close button").click(function(){
        $(".page-carousel").hide();
    });
    $(".display-in-mob").click(function(button){
        button.preventDefault();    
        $(".open-fast").click();
    });
    $(".user-profile").click(function(link){
        alert("Hel");
    });
    $("#faq .card").click(function(){
        $(this).find('.card-body').toggle();
    });

});