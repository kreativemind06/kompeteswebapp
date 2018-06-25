/*
    Author's: Aizaz.dinho, Meezi (geeks of meralesson.com)
    Website: Meralesson.com
*/

//if follow button click run function
$('.follow').click( function(e){
e.preventDefault();
//Make variable for this button
$button = $(this);
//Get follow_id from follow button rel tag
 var follow_id = $(this).attr("rel");
//if button has class following
    if($button.hasClass('following')){
    //send ajax request to ajax.php for unfollow
    //$.post('../ajax/ajax.php',{Unfollow:follow_id});
    $.post('follow/unfollow',{Unfollow:follow_id});
    //Remove button class Following
    $button.removeClass('following');
    //Remove button class unfollow
    $button.removeClass('unfollow');
    //Add text to follow button after unfollow
    $button.html('<i class="fa fa-user-plus"></i> Follow');
} else {
    //else send ajax request for follow
     //$.post('../ajax/ajax.php',{follow:follow_id});
     $.post('follow/following',{follow:follow_id});
    //And remove class follow
    $button.removeClass('follow');
    //And add class following
    $button.addClass('following');
    //All text to follow button
    $button.text('Following');         
    }
});
//run a function on hover on follow button 
$('.follow').hover(function(){
	//Make variable for button
     $button = $(this);
     //if button have class following
    if($button.hasClass('following')){
    	//then add class unfollow
        $button.addClass('unfollow');
        //and add text unfollow so 
        //when you hover on follow button you'll see unfollow button
        $button.text('Unfollow');
    }
}, function(){
	 //if button have class following
    if($button.hasClass('following')){
    	 //if remove class unfollow
        $button.removeClass('unfollow');
        //add text following
        $button.text('Following');
    }
});
	 