/*
Copyright © 2016 Themeportal
------------------------------------------------------------------
[Admin Javascript]

Project:	Themeportal

-------------------------------------------------------------------*/

(function ($) {
	"use strict";
	var themeportal = {
		initialised: false,
		version: 1.0,
		mobile: false,
		init: function () {

			if(!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}

			/*-------------- themeportal Functions Calling ---------------------------------------------------
			------------------------------------------------------------------------------------------------*/
            this.Initialize();
            this.Auth();
            this.Language();
            this.RevenueJS();
            this.ProductJS();
            this.TransactionHistoryJS();
            this.SearchSection();
            this.headerSearchSection();
        },

		/*-------------- themeportal Functions definition ---------------------------------------------------
		---------------------------------------------------------------------------------------------------*/





		Initialize: function() {

		   // set banner height
            var h = $(window).innerHeight();
            $(".th_main_wrapper").css("height", h);

            //smooth scrolling
            $.smoothScroll();

            // wow animation
            var wow = new WOW({
                boxClass: 'wow', // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset: 0, // distance to the element when triggering the animation (default is 0)
                mobile: true, // trigger animations on mobile devices (default is true)
                live: true, // act on asynchronously loaded content (default is true)
                callback: function(box) {
                    // the callback is fired every time an animation is started
                    // the argument that is passed in is the DOM node being animated
                }
            });
            wow.init();

            // menu at small width
            $(".menu_toggle").on('click', function() {
               var w = window.innerWidth;
                    $(".th_menu").toggleClass('open_menu');
                    $(".th_main_wrapper").toggleClass('slide_wrapper');
             });


            //sub menu .th_menu_container ul li ul
            $(".th_menu_container ul > li:has(ul) > a").on('click', function(e) {
				e.preventDefault();
				$(this).parent('.th_menu_container ul li').children('ul').slideToggle();
            });
            $(".th_menu_container ul li ul li a").on('click', function(e) {
                $(this).parent('.th_menu_container ul li ul li').children('ul').slideToggle();
            });

            // user profile popup
            $(".user_name").on('click', function() {
               var w = window.innerWidth;
                    $(".th_user_profile").toggleClass('open_popup');
             });

             //data table
             if( $('.commonTable').length > 0 ) {
                $('.commonTable').DataTable();
             }

            // Reorder Testimonial
            if( $('#sortable').length > 0 ) {
                $( "#sortable" ).sortable();
                $( "#sortable" ).disableSelection();
            }
            if( $('.datepicker').length > 0 ) {
                $(".datepicker").datepicker({
					//defaultDate: new Date(),
                    inline: true,
					Default: true,
					// defaultDate:'now'
					todayHighlight: true
                });
            }
            removeMessage();
		},
		Auth: function(){
		// on enter submit every form
            $('.validate').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    checkformvalidation();
                }
            });
		    $('.validate').on('blur', function(){

                var err_count = 0;
    			var CurrentId = $(this).attr('id');
				var CurrentCls = $(this).parent();
                CurrentCls.removeClass('ts_error_input');
                CurrentCls.removeClass('ts_success_input');

                if( $.trim($(this).val()) == '' ) {

                    CurrentCls.addClass('ts_error_input');
					CurrentCls.removeClass('ts_success_input');
                    err_count++;
                }
                else {
                    var clsStr = $(this).attr('class');

                    if( clsStr.search('email') != -1 ) {

                        var em = $.trim($(this).val());
                        var emRegex = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,15}(?:\.[a-z]{2})?)$/i;

                        if(!emRegex.test(em)) {
                            CurrentCls.addClass('ts_error_input');
					        CurrentCls.removeClass('ts_success_input');
                             err_count++;
                        }
                    }

                    if( clsStr.search('pwd') != -1 ) {

                        var pwd = $.trim($(this).val());

                        if(pwd.length < 7) {
                            CurrentCls.addClass('ts_error_input');
					        CurrentCls.removeClass('ts_success_input');
                             err_count++;
                        }
                    }

                    if( clsStr.search('repwd') != -1 ) {

                        var repwd = $.trim($(this).val());
                        var pwd = $.trim($('.pwd').val());

                        if(pwd != repwd) {
                            CurrentCls.addClass('ts_error_input');
					        CurrentCls.removeClass('ts_success_input');
                             err_count++;
                        }
                    }
                }

                if( err_count == 0 ) {
                    CurrentCls.addClass('ts_success_input');
                    CurrentCls.removeClass('ts_error_input');
                }
			});
		},
		Language : function(){

		    $('body').on('dblclick','.dblclicklang',function(){
		        var currentText = $(this).text();
		        var dataAttr = $(this).attr('data-id');
		        $('#langText').val(currentText);
		        $('#langText').attr('data-db',dataAttr);
		        $('#commonLanguageModel').modal('show');
		    });

		    $('.languageUpdateBtn').on('click',function(){
		        var basepath = $('#basepath').val();
		        var currentText = $('#langText').val();
		        var dataId = $('#langText').attr('data-db');
		        var dataArr = {};
                dataArr [ 'currentText' ] = currentText;
                dataArr [ 'dataId' ] = dataId;
                $.post(basepath+"settings/update_languagetext",dataArr,function(data, status) {

                    if(data == '1'){
                        $('[ data-id = "'+dataId+'" ]').text(currentText);
                        $('.ts_message_popup_text').text('Language updated successfully.');
                        $('.ts_message_popup').addClass('ts_popup_success');
                    }
                    else {
                        $('.ts_message_popup_text').text('Language cannot be updated.');
                        $('.ts_message_popup').addClass('ts_popup_error');
                    }
                    $('#commonLanguageModel').modal('hide');
                    removeMessage();
                });
		    });
		},
		RevenueJS : function() {
		    $('#portal_revenuemodel').on('change',function(){
		        var idd = $(this).val();
		        if(idd == 'subscription') {
                    $('.plan_products_section').removeClass('hideme');
                    $('.prod_plan_btn').removeClass('hideme');

                    $('.marketvendor_commission').addClass('hideme');
                    $('.subscription_type').addClass('hideme');
                    $('.plan_vendor_section').addClass('hideme');
                    $('.vend_plan_btn').addClass('hideme');
                    $('.marketplace_vendortype').addClass('hideme');
                }
                else {
                    $('.plan_products_section').addClass('hideme');
                    $('.prod_plan_btn').addClass('hideme');

                    $('.subscription_type').removeClass('hideme');
                    $('.marketplace_vendortype').removeClass('hideme');
                    if( $('#marketplace_typevendor').val() == 'multi' && $('#vendor_revenuemodel').val() == 'plans' ) {
                        $('.marketvendor_commission').addClass('hideme');
                        $('.plan_vendor_section').removeClass('hideme');
                        $('.vend_plan_btn').removeClass('hideme');
                    }
                    else if( $('#marketplace_typevendor').val() == 'multi' && $('#vendor_revenuemodel').val() == 'commission' ) {
                        $('.marketvendor_commission').removeClass('hideme');
                        $('.plan_vendor_section').addClass('hideme');
                        $('.vend_plan_btn').addClass('hideme');
                    }
                }
		    });

		    $('#marketplace_typevendor').on('change',function(){
		        var idd = $(this).val();
		        if(idd == 'multi') {
                    $('.marketplace_vendortype').removeClass('hideme');
                    if( $('#vendor_revenuemodel').val() == 'plans' ) {
                        $('.marketvendor_commission').addClass('hideme');
                        $('.plan_vendor_section').removeClass('hideme');
                        $('.vend_plan_btn').removeClass('hideme');
                    }
                    else {
                        $('.marketvendor_commission').removeClass('hideme');
                        $('.plan_vendor_section').addClass('hideme');
                        $('.vend_plan_btn').addClass('hideme');
                    }
                }
                else {
                    $('.marketplace_vendortype').addClass('hideme');

                    $('.marketvendor_commission').addClass('hideme');
                    $('.plan_vendor_section').addClass('hideme');
                    $('.vend_plan_btn').addClass('hideme')
                }
		    });

		    $('#vendor_revenuemodel').on('change',function(){
		        var idd = $(this).val();
		        if(idd == 'plans') {
		            $('.marketvendor_commission').addClass('hideme');
                    $('.plan_vendor_section').removeClass('hideme');
                    $('.vend_plan_btn').removeClass('hideme');
                }
                else {
                    $('.marketvendor_commission').removeClass('hideme');
                    $('.plan_vendor_section').addClass('hideme');
                    $('.vend_plan_btn').addClass('hideme');
                }
		    });


            /******** update revenue model STARTS ********/
		    $('#update_revenuemodel').on('click',function(){
		        var curHTML = $('#plan_html_content').html('');
		        var vcurHTML = $('#vplan_html_content').html('');
		        $(this).text('WAIT');
		        $(this).removeAttr('id');
		        var settingsArr = {};
		        var planArr = {};
		        var vplanArr = {};
                var dataArr = {};
                var planDataArr = {};
                var vplanDataArr = {};

                $('.revenuefields').each(function(){
                    settingsArr[ $(this).attr('id') ] = $.trim($(this).val()) ;
                });
                //var typeofsubsc = $('#subscription_type').val();

                $('.timetype_input').each(function(){
                    planArr[ $(this).attr('id') ] = $.trim($(this).val()) ;
                });
                $('.vendortype_input').each(function(){
                    vplanArr[ $(this).attr('id') ] = $.trim($(this).val()) ;
                });

                var basepath = $('#basepath').val();
                dataArr [ 'updateform' ] = 'yes';
                dataArr [ 'updatedata' ] = JSON.stringify(settingsArr);

                planDataArr [ 'planupdate' ] = 'yes';
                planDataArr [ 'updatedata' ] = JSON.stringify(planArr);

                vplanDataArr [ 'vplanupdate' ] = 'yes';
                vplanDataArr [ 'updatedata' ] = JSON.stringify(vplanArr);

                var chkRevModal = $('#portal_revenuemodel').val();

                $.post(basepath+"settings/update_settingsdetails",dataArr,function(data, status) {
                    if(data == '1'){

                        if( chkRevModal == 'subscription' ) {
                            $.post(basepath+"backend/update_plantable",planDataArr,function(data, status)
                            {
                                if(data == '1'){
                                    $('.ts_message_popup_text').text('Revenue model updated successfully.');
                                    $('.ts_message_popup').addClass('ts_popup_success');
                                }
                            });
                        }
                        else {
                            $.post(basepath+"backend/update_vendore_plantable",vplanDataArr,function(data, status)
                            {
                                if(data == '1'){
                                    $('.ts_message_popup_text').text('Revenue model updated successfully.');
                                    $('.ts_message_popup').addClass('ts_popup_success');
                                }
                            });
                        }
                    }
                });

                setTimeout(function(){
                    $('.ts_message_popup_text').text('');
                    $('.ts_message_popup').removeClass('ts_popup_error ts_popup_success');

                    $('.portalBtn').text('UPDATE');
		            $('.portalBtn').attr('id','update_revenuemodel');
		            $('#plan_html_content').html(curHTML);
		            $('#vplan_html_content').html(vcurHTML);

                }, 3000);
                return false;

		    });
		    /******** update revenue model ENDS ********/
		},
		ProductJS : function() {
		    $('input[name="p_name"]').on('keyup',function(){
		        var curLength = ($(this).val()).length;
		        if( curLength > 79 ) {
		            $(this).val(
                        function(index, value){
                            return value.substr(0, value.length - 1);
                    });
		        }
		        $('.name_counter').text(80 - curLength);
		    });
		    $('input[name="p_urlname"]').on('keyup',function(){
		        var curLength = ($(this).val()).length;
		        if( curLength > 79 ) {
		            $(this).val(
                        function(index, value){
                            return value.substr(0, value.length - 1);
                    });
		        }
		        $('.urlname_counter').text(80 - curLength);
		    });
		},
		TransactionHistoryJS : function(){

		    $('body').on('click','.detailss',function(){
		        var currentId = $(this).attr('id');
		        if( $(this).is('.bankTranscDetails') ) {
		            var bnkTr = '1';
		        }
		        else {
		            var bnkTr = '0';
		        }

		        if( $('#vendorpage').length > 0 ) {
		            var controller = 'vendorboard';
		        }
		        else {
		            var controller = 'backend';
		        }

		        var basepath = $('#basepath').val();
		        var dataArr = {};
                dataArr [ 'currentId' ] = currentId;
                $.post(basepath+controller+"/transaction_history_detail",dataArr,function(data, status) {
                    if( bnkTr == '1' ) {
                        $('.transactionHeading').text('Check and Approve');
                    }
                    else {
                        $('.transactionHeading').text('Transaction Details');
                    }
                    $('#trans_data').html(data);
                    $('#transactiondetails').modal('show');
                });
		    });
		},
        SearchSection: function () {
            $('#searchInputBtn').on('click',function(){
                internalsearchfunction();
            });
            $('#searchInput').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    internalsearchfunction();
                }
            });

            $('#searchInput').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    internalsearchfunction();
                }
            });


            function internalsearchfunction() {
                var searchInput = $('#searchInput').val();
                var basepath = $('#basepath').val();

                if( searchInput != '' ) {
                    window.location.href = basepath+"home/products/"+searchInput;
                }
            }
        },
        headerSearchSection: function () {
            $('#headerSearchInputBtn').on('click',function(){
                internalheadersearchfunction();
            });
            $('#headerSearchInput').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    internalheadersearchfunction();
                }
            });

            $('#headerSearchInput').on('keyup',function(event){
                event.preventDefault();
                if(event.keyCode == 13){
                    internalsearchfunction();
                }
            });


            function internalheadersearchfunction() {
                var searchInput = $('#headerSearchInput').val();
                var basepath = $('#basepath').val();

                if( searchInput != '' ) {
                    window.location.href = basepath+"home/products/"+searchInput;
                }
            }
        },

    };

	themeportal.init();

})(jQuery);

/********** Remove Error / Success Message *************/
function removeMessage(){
    if( $('.ts_message_popup').is('.ts_popup_error') || $('.ts_message_popup').is('.ts_popup_success') ) {
        setTimeout(function(){
            $('.ts_message_popup_text').text('');
            $('.ts_message_popup').removeClass('ts_popup_error ts_popup_success');
        }, 3000);
    }
}

/********** Update Settings *************/

function updateSettings(commonclass) {
    if( commonclass == 'logoform' ) {
        // image upload
        $('#logoform').submit();
    }
    else if( commonclass == 'languageSettings' ) {
        // language settings
        var addnewlanguage = ($.trim($('#addnewlanguage').val())).toLowerCase();
        var existinglanguage = $('#existinglanguage').val();
        if( addnewlanguage != '' ) {
            if( existinglanguage.search(addnewlanguage) != '-1' ) {
                // already exists
                $('.ts_message_popup_text').text(addnewlanguage+' is already added.');
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
                return false;
            }
            else if( existinglanguage.search(' ') != '-1' ) {
                // Space cannot be allowed
                $('.ts_message_popup_text').text('Space is not allowed.');
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
                return false;
            }
        }
        $('#addnewlanguage').val(addnewlanguage);
        $('#languageForm').submit();
    }
    else if( commonclass == 'add_testi_form' ) {
        // Testimonial Section
        if( $('#old_testid').val() != '0' ) {
            $('#add_testi_form').submit();
            return false;
        }

        $(this).removeAttr('onlick');
        // Add testimonial
        var err = 0;
        $('.add_testi_form').each(function(){
            if($.trim($(this).val()) == '') {
                err++;
            }
        });
        if(err == 0) {
            $('#add_testi_form').submit();
        }
        else {
            $(this).attr('onlick',"updateSettings('add_testi_form')");
            $('.ts_message_popup_text').text('All fields are required.');
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
        }

    }
    else if( commonclass == 'add_cate_form' ) {
        // Category Section
        $(this).removeAttr('onlick');
        var err = 0;
        $('.add_cate_form').each(function(){
            if($.trim($(this).val()) == '') {
                err++;
            }
        });

        var c_urlname = $.trim($('input[name="cateurlname"]').val());
        if(/^[a-zA-Z0-9- ]*$/.test(c_urlname) == false) {
            $('.ts_message_popup_text').text("Category URL name should not contain special characters.");
            $('.ts_message_popup').addClass('ts_popup_error');
            err++;

            removeMessage();
            return false;
        }

        if(err == 0) {
            $('#add_cate_form').submit();
        }
        else {
            $(this).attr('onlick',"updateSettings('add_cate_form')");
            $('.ts_message_popup_text').text('Category name is required.');
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
        }

    }
    else {
        var allData = {};
        var dataArr = {};
        $('.'+commonclass).each(function(){
            if( $(this).attr('id').search("_checkbox") != '-1' ) {
                var chk = $('#'+$(this).attr('id')).is(':checked') ? '1' : '0' ;
                allData[ $(this).attr('id') ] = chk;
            }
            else {
                allData[ $(this).attr('id') ] = $.trim($(this).val()) ;
            }
        });
        var basepath = $('#basepath').val();
        dataArr [ 'updateform' ] = 'yes';
        dataArr [ 'updatedata' ] = JSON.stringify(allData);
        $.post(basepath+"settings/update_settingsdetails",dataArr,function(data, status) {

        console.log(data);
            if(data == '1'){
                $('.ts_message_popup_text').text('Data updated successfully.');
                $('.ts_message_popup').addClass('ts_popup_success');
            }
            else {
                $('.ts_message_popup_text').text('Data cannot be updated.');
                $('.ts_message_popup').addClass('ts_popup_error');
            }
            removeMessage();
        });
    }
}


/*********** Add / Update Products START  *********************/

function addproductsbutton(){
    var errCount = 0;
    var oldprod_id = $('#oldprod_id').val();
    var p_name = $.trim($('input[name="p_name"]').val());
    var p_urlname = $.trim($('input[name="p_urlname"]').val());
    if(/^[a-zA-Z0-9- ]*$/.test(p_urlname) == false) {
        $('.ts_message_popup_text').text("URL Name should not contain special characters.");
        $('.ts_message_popup').addClass('ts_popup_error');

        removeMessage();
        return false;
    }

    if(p_name.length > 80) {
        $('.ts_message_popup_text').text("Name should not be more than 80 characters.");
        $('.ts_message_popup').addClass('ts_popup_error');

        removeMessage();
        return false;
    }

    if(p_urlname.length > 80) {
        $('.ts_message_popup_text').text("URL Name should not be more than 80 characters.");
        $('.ts_message_popup').addClass('ts_popup_error');

        removeMessage();
        return false;
    }

    if( oldprod_id != '0' ) {
        $('#modify_products_form').submit();
    }
    else {
        $('.productfields').each(function(){
            if( $.trim($(this).val()) == '' || $.trim($(this).val()) == '0' ) {
                errCount++;
            }
        });
        if( errCount == 0 ) {
            $('#modify_products_form').submit();
        }
        else {
            $('.ts_message_popup_text').text("Fields can’t be empty or 0.");
            $('.ts_message_popup').addClass('ts_popup_error');

            removeMessage();
        }
    }
    return false;

}
/*********** Add / Update Products ENDS  *********************/


/*********** Update basic values of tables STARTS ******************/
function updatethevalue($this,type){
    var dataArr = {};
    var id = $($this).attr('id');

    // Check already featured
    if( id.search('featured') != '-1' ) {
        var checkCounter = 0;
        $('.featuredCls').each(function(){
            if( $(this).val() == '1' ) {
                checkCounter++;
            }
        });
        if( checkCounter > 1 ) {
            $($this).val('0');
            $('.ts_message_popup_text').text('Can only have one product as featured.');
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
            return false;
        }
    }
    if( type == 'categories' ) {
        var vlu = $($this).is(':checked') ? '1' : '0' ;
    }
    else {
        var vlu = $($this).val();
    }
    var basepath = $('#basepath').val();
    dataArr [ 'id' ] = id;
    dataArr [ 'type' ] = type;
    dataArr [ 'vlu' ] = vlu;
    console.log(dataArr);
    $.post(basepath+"settings/updatethevalue",dataArr,function(data, status) {
        if(data == '1'){
            $('.ts_message_popup_text').text('Data updated successfully.');
            $('.ts_message_popup').addClass('ts_popup_success');
        }
        else {
            $('.ts_message_popup_text').text('Data cannot be updated.');
            $('.ts_message_popup').addClass('ts_popup_error');
        }

        removeMessage();

    });
}
/*********** Update basic values of tables ENDS ******************/


/************* Email Integrations STARTS *******************/
function openEmailIntePopup(emAppId) {
    $('.common_form').each(function(){
        if(!$(this).is('.hideme')) {
            $(this).addClass('hideme');
        }
    });
    $('#'+emAppId+'_form').removeClass('hideme');
    $('#myModalLabel').text('Connect to '+ emAppId);
    $('.theme_btn').attr('onclick',"emailintegration_fun('"+emAppId+"')");
    $('#connectemails').modal('show');
}

function emailintegration_fun(emAppId) {
    var dataArr = {} ;
    var err = 0;
    $('.'+emAppId+'_cls').each(function(){
        if( $.trim ( $(this).val() ) != '' ) {
            err++;
            dataArr[ $(this).attr('id') ] = $.trim ( $(this).val() );
        }
        else {
            $('.ts_message_popup_text').text('Fields can not be empty.');
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
            return false;
        }
    });

     var basepath = $('#basepath').val();

    if( err != 0 ) {
        dataArr['emAppId'] = emAppId;

        $.post(basepath+"backend/email_integrations_ajx",dataArr,function(data, status) {

          if( data == '404') {
                $('.ts_message_popup_text').text('We can not connect to '+emAppId);
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
            }
            else if( data == 'ZERO' ) {
                $('.ts_message_popup_text').text('Cannot find any list on '+emAppId);
                $('.ts_message_popup').addClass('ts_popup_error');
                removeMessage();
            }
            else {
                window.location.reload(1);
            }

        });
    }

}

function saveListToConnect() {
    var dataArr = {} ;
    var str = '';
    $('.elistClasses').each(function(){
        if( $(this).is(':checked') ) {
            var idd = ($(this).attr('id')).split('_')[1];
            str += idd + '@#';
        }
    });

    dataArr[ 'newsletter_subs' ] = ( $('#newsletter').is(':checked') ? '1' : '0' );
    dataArr[ 'registeredemails_subs' ] = ( $('#registeredemails').is(':checked') ? '1' : '0' );
    dataArr[ 'contactemails_subs' ] = ( $('#contactemails').is(':checked') ? '1' : '0' );
    var jsonArr = {};
    jsonArr['jsondata'] = JSON.stringify(dataArr);
    jsonArr['elistStr'] = str;

    var basepath = $('#basepath').val();
    $.post(basepath+"backend/saveListToConnect",jsonArr,function(data, status) {

        if(data == '1'){
            $('.ts_message_popup_text').text('Data updated successfully.');
            $('.ts_message_popup').addClass('ts_popup_success');
        }
        else {
            $('.ts_message_popup_text').text('Data cannot be updated.');
            $('.ts_message_popup').addClass('ts_popup_error');
        }

        removeMessage();
    });
}
/************* Email Integrations ENDS *******************/

/************* Email Templates STARTS *******************/

function updateEmailtemplates(type) {
    var dataArr = {} ;
    if( $('#'+type+'_logoshow').length > 0 ) {
        dataArr[ 'logoshow' ] = $('#'+type+'_logoshow').is(':checked') ? '1' : '0' ;
    }

    if( $('#'+type+'_replytoshow').length > 0 ) {
        dataArr[ 'replytoshow' ] = $('#'+type+'_replytoshow').is(':checked') ? '1' : '0' ;
    }

    if( $('#'+type+'_text').length > 0 ) {
        dataArr[ 'emText' ] = $('#'+type+'_text').val();
    }

    if( $('#'+type+'_linktext').length > 0 ) {
        dataArr[ 'linktext' ] = $('#'+type+'_linktext').val();
    }

    if( $('#'+type+'_fromname').length > 0 ) {
        dataArr[ 'fromname' ] = $('#'+type+'_fromname').val();
    }

    if( $('#'+type+'_fromemail').length > 0 ) {
        dataArr[ 'fromemail' ] = $('#'+type+'_fromemail').val();
    }

    if( $('#'+type+'_replyemail').length > 0 ) {
        dataArr[ 'replyemail' ] = $('#'+type+'_replyemail').val();
    }

    if( $('#'+type+'_contactemail').length > 0 ) {
        dataArr[ 'contactemail' ] = $('#'+type+'_contactemail').val();
    }

    dataArr[ 'type' ] = type;
    var basepath = $('#basepath').val();
    $.post(basepath+"backend/email_templates",dataArr,function(data, status) {
        if(data == '1'){
            $('.ts_message_popup_text').text('Template updated successfully.');
            $('.ts_message_popup').addClass('ts_popup_success');
        }
        else {
            $('.ts_message_popup_text').text('Template cannot be updated.');
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        removeMessage();
    });
}

function sendTestEmails(type) {
    var dataArr = {} ;
    dataArr[ 'testemail' ] = $('#'+type+'_emailinput').val();
    dataArr[ 'type' ] = type;
    var basepath = $('#basepath').val();
    $.post(basepath+"backend/sendTestEmails",dataArr,function(data, status) {

        if(data == '1'){
            $('.ts_message_popup_text').text('Test email has been sent successfully.');
            $('.ts_message_popup').addClass('ts_popup_success');
        }
        else {
            $('.ts_message_popup_text').text('Email cannot be sent.');
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        removeMessage();
    });
}
/************* Email Templates ENDS *******************/

/************* Payment Settings STARTS *****************/

function updatePaymentSettings(commonclass){
    var dataArr = {};
    var allData = {};
    var err=0;
    $('.'+commonclass).each(function(){

        if( $(this).attr('id').search("_status") != '-1' ) {
            var chk = $('#'+$(this).attr('id')).is(':checked') ? '1' : '0' ;
            dataArr[ $(this).attr('id') ] = chk;
        }
        else {
            if($.trim($(this).val()) == '') {
                err++;
            }
            else {
                dataArr[ $(this).attr('id') ] = $.trim($(this).val()) ;
            }
        }
    });
    if( err != '0' ) {
        $('.ts_message_popup_text').text('Details can not be empty.');
        $('.ts_message_popup').addClass('ts_popup_error');
        removeMessage();
    }
    else {
        var basepath = $('#basepath').val();
        allData [ 'updateform' ] = 'yes';
        allData [ 'updatedata' ] = JSON.stringify(dataArr);
        $.post(basepath+"settings/update_settingsdetails",allData,function(data, status) {
            if(data == '1'){
                $('.ts_message_popup_text').text('Data updated successfully.');
                $('.ts_message_popup').addClass('ts_popup_success');
            }
            else {
                $('.ts_message_popup_text').text('Data cannot be updated.');
                $('.ts_message_popup').addClass('ts_popup_error');
            }
            removeMessage();
        });
    }
}
/************* Payment Settings ENDS *****************/

/************** Product plan change STARTS ***************/

    function checkplanprod($this) {
        var val = $($this).val();
        var idd = $($this).attr('id');
        var uniqId = idd.split('type#')[1];
        if( val == 'limited' ) {
            $('[data-type="planNum_'+uniqId+'"]').css('display','block');
        }
        else {
            $('[data-type="planNum_'+uniqId+'"]').css('display','none');
        }
    }


    var pCounter = 0;
    var vpCounter = 0;
    function addnewplan(type){
        if(type == 'products'){
            pCounter++;
            var newUniqID = parseInt(100)+pCounter;
            var lastCounter = ($('.pHeading:last').attr('id')).split('_')[1];
            var newCounter =  parseInt(lastCounter) + 1;
            var htmlContent = $('#plan_html_content').html();
            htmlContent = htmlContent.split("CNUM").join(newCounter);
            htmlContent = htmlContent.split("UNIQNUM").join('V'+newUniqID);
            htmlContent = htmlContent.split("th_subheading").join('th_subheading pHeading');

            $('.plan_section_div').append(htmlContent);
        }
        else {
            vpCounter++;
            var newUniqID = parseInt(200)+vpCounter;
            var lastCounter = ($('.vpHeading:last').attr('id')).split('_')[1];
            var newCounter =  parseInt(lastCounter) + 1;
            var htmlContent = $('#vplan_html_content').html();
            htmlContent = htmlContent.split("CNUM").join(newCounter);
            htmlContent = htmlContent.split("UNIQNUM").join('T'+newUniqID);
            htmlContent = htmlContent.split("th_subheading").join('th_subheading vpHeading');

            $('.vplan_section_div').append(htmlContent);

        }
    }
/************** Product plan change ENDS ***************/


/**************** Save ReOrder Testimonials STARTS *************/

function save_testimonial_order(){

    var str = "";
    $('.ui-sortable-handle').each(function(){
    str += $(this).attr('id');
    str += ",";
    });
    var strr = str.replace(/(^,)|(,$)/g, "");

    var basepath = $('#basepath').val();
    $.post(basepath+"backend/save_testimonial_order/",
    {
        'testi_id' 		: strr
    },
    function(data){
        if(data == '1'){
            $('.ts_message_popup_text').text('Order updated successfully.');
            $('.ts_message_popup').addClass('ts_popup_success');
        }
        else {
            $('.ts_message_popup_text').text('Order cannot be updated.');
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        removeMessage();
    });

}
/**************** Save ReOrder Testimonials ENDS *************/

/************* Compliance Pages STARTS ********************/
function updatePageContent($this) {
    if($this != undefined) {
        $($this).text('Wait');
        var type = $($this).attr('data-type');
        var counter = $($this).attr('data-counter');
        var dataArr = {};
        var allData = {};
        var basepath = $('#basepath').val();
        var pgHeading = $.trim($('#page_headingV7'+counter).val());
        var pgContent = editorArr[counter].getData();

        if( pgHeading != '' && pgContent != '') {
            dataArr [ 'page_headingV71' ] = pgHeading;
            dataArr [ 'page_contentV71' ] = pgContent;
            dataArr [ 'typee' ] = type;
            allData [ 'pageSection' ] = JSON.stringify(dataArr);
            $.post(basepath+"backend/compliance_pages",allData,function(data, status) {
                if(data == '1'){
                    $('.ts_message_popup_text').text('Data updated successfully.');
                    $('.ts_message_popup').addClass('ts_popup_success');
                }
                else {
                    $('.ts_message_popup_text').text('Data cannot be updated.');
                    $('.ts_message_popup').addClass('ts_popup_error');
                }
                removeMessage();
            });
        }
        else {
            $('.ts_message_popup_text').text('Fields can not be empty.');
            $('.ts_message_popup').addClass('ts_popup_error');
            removeMessage();
        }
        $($this).text('UPDATE');
    }
}
/************* Compliance Pages ENDS ********************/

/*************** Submit Sorting Form STARTS ***************/

    function submit_sort_form(){
        $('#sort_form').submit();
        return false;
    }

    function displayDate($this){
        var cval = $($this).val();
        if( cval == 'custom' ) {
            $('.th_datepicker').css('display','block');
        }
        else {
            $('.th_datepicker').css('display','none');
        }
    }
/*************** Submit Sorting Form ENDS ***************/

/**************** Change Password STARTS ******************/

    function admin_change_password(){
        var err_count = 0;
        var dataArr = {};
        $('.pwd_validate').each(function(){
            var pwd = $.trim($(this).val());
            if(pwd.length < 7) {
                err_count++;
            }
            else {
                dataArr [ $(this).attr('id') ] = pwd;
            }
        });
        if( err_count == '0' ) {
            if( dataArr['new_pwd'] == dataArr['confirm_new_pwd'] ) {
                var basepath = $('#basepath').val();
                $.post(basepath+"backend/admin_change_password",dataArr,function(data, status) {
                    if(data == '1'){
                        $('.ts_message_popup_text').text('Password updated successfully.');
                        $('.ts_message_popup').addClass('ts_popup_success');
                        $('.pwd_validate').val('');
                        $('.close').trigger('click');
                    }
                    else {
                        $('.ts_message_popup_text').text('Current password is incorrect.');
                        $('.ts_message_popup').addClass('ts_popup_error');
                    }
                    removeMessage();
                });
            }
            else {
                $('.ts_message_popup_text').text('New and confirm password should be same.');
                $('.ts_message_popup').addClass('ts_popup_error');
            }
        }
        else {
            $('.ts_message_popup_text').text('Passwords should be more than 7 characters.');
            $('.ts_message_popup').addClass('ts_popup_error');
        }
        $('.user_name').trigger('click');
        removeMessage();
    }
/**************** Change Password ENDS ******************/
/************* Withdrawal Settings STARTS *****************/

    function updateWithdrawalSettings(commonclass){
    var dataArr = {};
    var allData = {};
    var err=0;
    $('.'+commonclass).each(function(){

        if( $(this).attr('id').search("_status") != '-1' ) {
            var chk = $('#'+$(this).attr('id')).is(':checked') ? '1' : '0' ;
            dataArr[ $(this).attr('id') ] = chk;
        }
        else {
            if($.trim($(this).val()) == '') {
                err++;
            }
            else {
                dataArr[ $(this).attr('id') ] = $.trim($(this).val()) ;
            }
        }
    });
    if( err != '0' ) {
        $('.ts_message_popup_text').text('Details can not be empty.');
        $('.ts_message_popup').addClass('ts_popup_error');
        removeMessage();
    }
    else {
        var basepath = $('#basepath').val();
        allData [ 'updateform' ] = 'yes';
        allData [ 'updatedata' ] = JSON.stringify(dataArr);
        $.post(basepath+"vendorboard/update_withdrawaldetails",allData,function(data, status) {
        console.log(data);
            if(data == '1'){
                $('.ts_message_popup_text').text('Data updated successfully.');
                $('.ts_message_popup').addClass('ts_popup_success');
            }
            else {
                $('.ts_message_popup_text').text('Data cannot be updated.');
                $('.ts_message_popup').addClass('ts_popup_error');
            }
            removeMessage();
        });
    }
}

/************* Withdrawal Settings ENDS *****************/

/************** Update Withdrawal Details STARTS *****************/

    function updateWithdrawal(){
        var amounttobepaid = $('#amounttobepaid').val();
        if( !isNaN(amounttobepaid) ) {
            var allData = {};
            var basepath = $('#basepath').val();
            allData [ 'amounttobepaid' ] = $('#amounttobepaid').val();
            allData [ 'paymentnote' ] = $('#paymentnote').val();
            allData [ 'vendorId' ] = $('#vendorId').val();
            var sendnotification = $('#sendnotification:checked').length;
            allData [ 'sendnotification' ] = sendnotification;
            $.post(basepath+"backend/updateWithdrawal",allData,function(data, status) {
            console.log(data);
                if(data == '1'){
                    $('.ts_message_popup_text').text('Data updated successfully.');
                    $('.ts_message_popup').addClass('ts_popup_success');

                    setTimeout(function(){
                        window.location.reload(1);
                    }, 3000);
                }
                else {
                    $('.ts_message_popup_text').text('Data cannot be updated.');
                    $('.ts_message_popup').addClass('ts_popup_error');
                }
                removeMessage();
            });
        }
        else {
            $('.ts_message_popup_text').text('Amount should be numeric.');
            $('.ts_message_popup').addClass('ts_popup_error');
        }
    }

/************** Update Withdrawal Details ENDS *****************/
