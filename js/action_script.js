
$(document).ready(function() {

    $('.buttons > a').livequery("click",function(e){

        var parent  = $(this).parent();
        var getID   =  parent.attr('id').replace('button_','');

        //$.post("<?php echo base_url()?>follow/following/"+getID, {
        $.post("/follow.php?id="+getID, {

        }, function(response){

            $('#button_'+getID).html($(response).fadeIn('slow'));
        });
    });





    $('.likex > a').livequery("click",function(e){

        var parent  = $(this).parent();
        var getID   =  parent.attr('id').replace('likex_','');

        //$.post("<?php echo base_url()?>follow/following/"+getID, {
        $.post("<?php echo base_url()?>like.php?id="+getID, {

        }, function(response){

            $('#button_'+getID).html($(response).fadeIn('slow'));
        });
    });
});


