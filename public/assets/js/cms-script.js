var localhost = "http://localhost/nekretnine/public/";

/* CMS-Script */
$(document).ready(function(){

    /***************************************************
     * 
     *  Action Part
     *  =============
     * 
     ***************************************************/

    // Delete Property
    // This Work with all types
    $(".delete-prop").click(function(){

        var attr_ID   = $(this).attr('data-id'); // Return ID of property
        var db_table  = $("input[name='db_table']").val(); // Return TableName (important)
        var valid_uri = localhost + 'adminservice/remove_property'; // Set Uri where magic happen

        if( window.confirm("Are Your Sure?")){

            $.post( valid_uri, { 'prop_delete' : attr_ID, 'db_table' : db_table }, function(res){
                /** Action */
                var res_tran = JSON.parse(res);
                if( res_tran.error == false ){
                    $("tr[data-table-id=" + attr_ID + "]").remove();
                } else {
                    console.log("Error");
                }
            });

        }
    });

    // Add More images
    $("#add_more_imgs").click(function(button){
        // Prevent Default Action ==> Submit Form
        button.preventDefault();
        // Set image Tag
        var imgButton = "<input class='form-control' type='file' name='property_images[]' />";
        // Duplicate Image
        $(".more-images").append(imgButton);
    });

    // Avatars Button
    $(".avatars button").click(function(button){
        button.preventDefault();
        
        $(".avatars button").css("border", "1px solid red");
        $(this).css("border", "1px solid blue");
        $("input[name='user_avatar']").val( $(this).val() );
    });
    // Delete User
    $(".delete-user").click(function(button){
        // Prevent any default action
        button.preventDefault();
        // Check for confirmation
        if( window.confirm("Are you sure? This action cannot be undone..") ){     
            // Complete Form with user
            // ID
            var user_id_form = $(this).attr('data-id');
            // Send ajax
            $.post(
                localhost + "adminservice/remove_user",
                { 'user_ID' : user_id_form },
                function(res){
                    // Response is in ajax
                    // format
                    var response = JSON.parse(res);
                    // Check is action legal
                    if( response.response == true ){
                        $("tr[data-id=" + user_id_form + "]").remove();
                    } else {
                        alert("Ne obrisan");
                    }
                }
            );
        }
    });
    // Delete PRop
    $(".prop-remove").click(function(button){
        // Prevent any default action
        button.preventDefault();
        // Check for confirmation
        if( window.confirm("Are you sure? This action cannot be undone..") ){     
            // Complete Form with user
            // ID
            var prop_id_form = $(this).attr('data-id');
            // Send ajax
            $.post(
                localhost + "adminservice/remove_prop",
                { 'prop_ID' : prop_id_form },
                function(res){
                    // Response is in ajax
                    // format
                    var response = JSON.parse(res);
                    // Check is action legal
                    if( response.response == true ){
                        $("tr[data-id=" + prop_id_form + "]").remove();
                    } else {
                        alert("Ne obrisan");
                    }
                }
            );
        }
    });
    // Search user form
    $(".search-user-din").submit(function(form){
        // Disable Form
        form.preventDefault();
        // Get Value From Form
        var user_ID_form = $("input[name='user_id_search']").val();
        // Send POOST
        $.post(
            localhost + "adminservice/get_user",
            { 'user_ID' : user_ID_form },
            function(response){
                var res_rep = JSON.parse(response);
                if( res_rep.response == true ){
                    // Set Header And other option
                    $(".search-user-title").html("<h4>" + res_rep.data.user_name + "</h4>" );
                    $(".search-user-data-tit").html(res_rep.data.user_name);
                    $(".search-user-data button").attr('data-id', user_ID_form);
                    $(".search-user-data button").slideDown();
                } else {
                    alert("Nema korisnika sa ovim ID-em");
                }
            }
        );
    });

    /**
     * 
     * User Dsicvoer For Admin purpose
     * 
     */
    $("#discover_user").submit(function(form){
        // Prevent Form Execution
        form.preventDefault();
        // Get User ID
        var userID = $("#discover_user input").val();
        if(userID){
            $.post(
                localhost + "adminservice/discover_user",
                { 'user_ID' : userID }, 
                function(response){
                    // Convert To JSon
                    var result = JSON.parse(response);
                    if(result.response == true){
                        /** Create Object */
                        $(".users_user_name").html(result.userdata[0].user_name);
                        $(".users_user_email").html(result.userdata[0].user_email);
                        if(result.userdata[0].user_activate == 1){
                            $("#user-active-status").addClass("btn").text("Aktivan");
                        } else {
                            $("#user-active-status").removeClass("btn").addClass("btn").html("Nije aktiviran");
                        }
                        $("#user-last-online").text(result.userdata[0].user_last_update);
                        $("#user-remove button").attr('data-id', result.userdata[0].user_ID);
                        
                        if(result.props.length == 0){
                            $("#user-remove button").removeAttr('disabled');
                        } else {
                            $("#user-remove button").attr('disabled', 'disabled');
                        }

                        var td = "";

                        result.props.forEach(function(item){
                                td+= "<tr data-id='" + item.property_ID + "'>";
                                td+= "<td>" + item.property_ID + "</td>";
                                td+= "<td>" + item.property_title + "</td>";
                                td+= "<td><button data-id='" + item.property_ID + "' class='btn btn-danger prop-remove-admin'>Obriši</button></td>";
                                td+= "</tr>";
                        });

                        $(".user-props-admin").html(td);
                        $("#display_user_admin").removeClass("d-none").slideDown();

                        /** Object is end */
                    } else {
                        alert("User Data Are Not Found");
                    }
                }
            );
        } else {
            alert("Prazan ID");
        }
    });

    // Find properties
    $(".find-prop .btn").click(function(){
        // myValue
        var myValue = $(".find-prop input").val();
        // Send to ajax
        $.post(
            localhost + "adminservice/jsonprop",
            { 'prop_ID' : myValue },
            function(response){
                var resp = JSON.parse(response);
                if(resp.response === true){
                    //
                    $(".find-prop-din h4").html(resp.data[0].property_title);
                    var li = "";
                    li += "<li>Lokacija: "+resp.data[0].property_location+"</li>";
                    li += "<li>Cijena: "+resp.data[0].property_price+"</li>";
                    li += "<li>Vlasnik(ID): "+resp.data[0].property_owner+"</li>";
                    $(".find-prop-din ul").html(li);
                    $(".find-prop-din a").attr("href", localhost + "article/index/" + resp.data[0].property_ID + "/" + resp.data[0].property_title).show();
                    $(".find-prop-din button").attr("data-id", resp.data[0].property_ID).show();
                } else {
                    alert("There is no Valid Value");
                }
            }
        )
    });

    // Open Message
    $(".report-article-mess a").click(function(a){
        a.preventDefault();
        var dataID = $(this).attr('data-id');
        $(".card-body[data-id='"+dataID+"']").slideToggle();
    });
    $(".report-article-mess .card-body a").click(function(a){
        a.preventDefault();
        var dataID = $(this).attr('data-id');
        $.get(
            localhost + "adminservice/endup_report",
            { "report_ID" : dataID },
            function(response){
                var res = JSON.parse(response);
                if(res.response == true){
                    var fullTranferDiv = $(".report-article-mess[data-id='"+dataID+"'] .card-header").html();
                    $(".report-article-mess[data-id='"+dataID+"']").remove();
                    $(".endup-reports ul").prepend( "<li>" + fullTranferDiv + "</li>");
                } else {
                    alert("Desila se nekakva greška");
                }
            }
        );
    });
    $(".endup-reports a").click(function(a){a.preventDefault()});

    /*************************************************
     * 
     * Delete Small Property
     * ======================
     * 
     ************************************************/
    $(document).on('click','.prop-remove-admin',function(){
        var myID = $(this).attr('data-id');
        if(window.confirm("Are You sure about this?")){

            $.post(
                localhost + "adminservice/remove_prop",
                { "prop_ID" : myID },
                function(response){
                    var result = JSON.parse(response);
                    if(result.response == true){
                        $("tr[data-id='" + myID + "']").remove();

                        if($(".user-props-admin tr").length == 0){
                            $("#user-remove button").removeAttr('disabled');
                            $("#display_user_admin").hide();
                        }
                    }
                }
            );

        };
    });

    /*************************************************
     * 
     * Validation Part
     * ===============
     * 
     **************************************************/

    // Validate Property
    $("#add_property").validate({
        rules : {
            prop_type : "required"
        },
        submitHandler : function(form){

            /** Submit Form */
            form.submit();

        },
        errorLabelContainer : 'error-prop-type'
    });

    // Validate Form
    $("#main-article-form").validate({
        rules : {
            property_title : { 
                required : true,
                maxlength: 45
            },
            property_location : {
                required : true,
                maxlength : 45
            },
            property_price : {
                required: true
            }
        },
        submitHandler : function(form){ form.submit(); }
    });

    // Validate Register Form
    $("#register-article-form").validate({
        rules : {
            user_name  : { required : true },
            user_email : { required : true },
            user_password : {
                required : true,
                minlength : 8
            },
            user_password_retype : {
                required : true,
                equalTo : $("input[name='user_password']")
            }
        },
        submitHandler : function(form){ form.submit(); }
    })

});