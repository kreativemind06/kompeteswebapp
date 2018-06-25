<style type="text/css">
    .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
        color: #fff !important;
        background-color: #000;
    }

    .nav > li > a:focus{

        color: #000 !important;
    }

    .nav > li > a:hover, .nav > li > a:focus {
        text-decoration: none;
        background-color: #000 !important !important;
        background: #000 !important !important;
        border-bottom: 3px solid #f00;
    }



</style>

<section class="content p-t-40" style="margin-top: 40px;padding: 0;">
    <div class="container-fluid">
        <?php echo $success ?>
        <?php echo validation_errors() ?>
        <div class="col-sm-3">
            <div class="" style="min-height: 150px;background:#fff">


                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#profile" data-toggle="tab">Profile</a></li>
                    <li class="text-black"><a href="#password" data-toggle="tab">Password</a></li>
                    <!--<li><a href="#social_connect" data-toggle="tab">Social Connect</a></li>-->
                </ul>
            </div>
        </div>

        <div class="col-sm-9">
            <div class="p-20" style="min-height: 400px;background:#fff">

                <div class="tab-content">
                    <div id="profile" class="tab-pane fade in active">
                        <div class="row">
                    <div class="col-sm-4">

                        <div class="">
                            <div class="panel panel-danger">
                                <div class="panel-heading"> Change Profile Photo</div>
                                <div class="panel-body">

                                    <div class="text-center">
                                        <img src="<?php if(!empty($userPhoto)){echo base_url('users_photo/'.$userPhoto);}else{ echo base_url('users_photo/avatar.png');}?>" width="150" class="img-circle">
                                        <?php echo form_open_multipart('profile/update_dp')?>
                                                <div class="form-group m-t-20">

                                                    <input id="Upload" type="file" name="photo" required class="form-control no-border-radius" accept="image/*" style="visibility: ">
                                                </div>

                                                <div class="form-group">
                                                    <input type="submit" value="Upload" style="width:100%" class="btn btn-danger btn-sm no-border-radius">
                                                </div>
                                        <?php echo form_close()?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-8">
                        <div class="panel panel-default">
                            <div class="panel-heading bg-black text-white"> Profile Information</div>
                            <div class="panel-body">
                                <?php echo form_open(base_url('profile/update'))?>
                                    <div class="form-group col-sm-6">
                                        <?php echo form_error('firsname')?>
                                        <label>First Name</label>
                                        <input class="form-control no-border-radius" type="text" name="firstname" value="<?php echo set_value('firstname',$userFirstName) ?>" required>
                                    </div>


                                    <div class="form-group col-sm-6">
                                        <?php echo form_error('lastname')?>
                                        <label>Last Name</label>
                                        <input class="form-control no-border-radius" type="text" name="lastname" value="<?php echo set_value('lastname',$userLastname) ?>"  required>
                                    </div>


                                    <div class="form-group col-sm-6">
                                        <?php echo form_error('email')?>
                                        <label>Email</label>
                                        <input class="form-control no-border-radius" type="text" name="email" value="<?php echo set_value('email', $userEmail) ?>" readonly>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <?php echo form_error('gender')?>
                                        <label>Gender</label>
                                        <select name="gender" class="form-control no-border-radius">
                                            <option value="<?php echo set_select('gender', $userGender)?>">Select Gender</option>
                                            <option value="Male <?php echo set_select('gender',$userGender)?>">Male</option>
                                            <option value="Female  <?php echo set_select('gender',$userGender)?>">Female</option>
                                        </select>
                                    </div>


                                <div class="form-group col-sm-12">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <?php echo form_error('birthday')?>
                                                <label>Birthday</label>
                                                <select class="form-control no-border-radius" name="birthday" required>
                                                    <option value="">Select Day</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <?php echo form_error('birthmonth')?>
                                                <label>Birth-month</label>
                                                <select class="form-control no-border-radius" name="birthmonth" required>
                                                    <option value="">Select Month</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                            </div>

                                            <div class="col-sm-4">
                                                <?php echo form_error('birthyear')?>
                                                <label>Birth-year</label>

                                                <select class="form-control no-border-radius" name="birthyear" required>
                                                    <option value="">Select Year</option>
                                                    <?php for($i=1921; $i<2018; $i++):?>
                                                        <option value="<?php echo $i?>"><?php echo $i; ?></option>
                                                    <?php endfor?>
                                                </select>
                                            </div>
                                        </div>



                                    </div>

                                    <div class="clearfix"></div>


                                    <div class="form-group col-sm-6">
                                        <?php echo form_error('website')?>
                                        <label>Website</label>
                                        <input class="form-control no-border-radius" name="website" type="text" value="<?php echo set_value('website', $userWebsite)?>">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <?php echo form_error('facebook')?>
                                        <label>Facebook</label>
                                        <input class="form-control no-border-radius" name="facebook" type="text" placeholder="@facebook_username" value="<?php echo set_value('facebook', $userFacebook)?>">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <?php echo form_error('twitter')?>
                                        <label>Twitter</label>
                                        <input class="form-control no-border-radius" placeholder="@twitter_username" name="twitter" type="text" value="<?php echo set_value('twitter', $userTwitter)?>">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <?php echo form_error('instagram')?>
                                        <label>Instagram</label>
                                        <input class="form-control no-border-radius" name="instagram" type="text" value="<?php echo set_value('instagram', $userInstagram)?>" placeholder="@username">
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <?php echo form_error('country')?>
                                        <label>Country</label>
                                        <select id="edit-country" name="country" class="form-control no-border-radius" required><option value="">Select a country</option><option value="US">United States</option><option value="AF">Afghanistan</option><option value="AX">Aland Islands</option><option value="AL">Albania</option><option value="DZ">Algeria</option><option value="AS">American Samoa</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antarctica</option><option value="AG">Antigua And Barbuda</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaijan</option><option value="BS">Bahamas</option><option value="BH">Bahrain</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BY">Belarus</option><option value="BE">Belgium</option><option value="BZ">Belize</option><option value="BJ">Benin</option><option value="BM">Bermuda</option><option value="BT">Bhutan</option><option value="BO">Bolivia</option><option value="BA">Bosnia And Herzegovina</option><option value="BW">Botswana</option><option value="BV">Bouvet Island</option><option value="BR">Brazil</option><option value="IO">British Indian Ocean Territory</option><option value="BN">Brunei Darussalam</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="KH">Cambodia</option><option value="CM">Cameroon</option><option value="CA">Canada</option><option value="CV">Cape Verde</option><option value="KY">Cayman Islands</option><option value="CF">Central African Republic</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CX">Christmas Island</option><option value="CC">Cocos (keeling) Islands</option><option value="CO">Colombia</option><option value="KM">Comoros</option><option value="CG">Congo</option><option value="CD">Congo, The Democratic Republicof</option><option value="CK">Cook Islands</option><option value="CR">Costa Rica</option><option value="CI">Cote D'ivoire</option><option value="HR">Croatia</option><option value="CU">Cuba</option><option value="CY">Cyprus</option><option value="CZ">Czech Republic</option><option value="DK">Denmark</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="DO">Dominican Republic</option><option value="EC">Ecuador</option><option value="EG">Egypt</option><option value="SV">El Salvador</option><option value="GQ">Equatorial Guinea</option><option value="ER">Eritrea</option><option value="EE">Estonia</option><option value="ET">Ethiopia</option><option value="FK">Falkland Islands (malvinas)</option><option value="FO">Faroe Islands</option><option value="FJ">Fiji</option><option value="FI">Finland</option><option value="FR">France</option><option value="GF">French Guiana</option><option value="PF">French Polynesia</option><option value="TF">French Southern Territories</option><option value="GA">Gabon</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="DE">Germany</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GR">Greece</option><option value="GL">Greenland</option><option value="GD">Grenada</option><option value="GP">Guadeloupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GG">Guernsey</option><option value="GN">Guinea</option><option value="GW">Guinea-bissau</option><option value="GY">Guyana</option><option value="HT">Haiti</option><option value="HM">Heard Island And Mcdonald Islands</option><option value="VA">Holy See (vatican City State)</option><option value="HN">Honduras</option><option value="HK">Hong Kong</option><option value="HU">Hungary</option><option value="IS">Iceland</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IR">Iran, Islamic Republic Of</option><option value="IQ">Iraq</option><option value="IE">Ireland</option><option value="IM">Isle Of Man</option><option value="IL">Israel</option><option value="IT">Italy</option><option value="JM">Jamaica</option><option value="JP">Japan</option><option value="JE">Jersey</option><option value="JO">Jordan</option><option value="KZ">Kazakhstan</option><option value="KE">Kenya</option><option value="KI">Kiribati</option><option value="KP">Korea, Democratic People's Republic Of</option><option value="KR">Korea, Republic Of</option><option value="KW">Kuwait</option><option value="KG">Kyrgyzstan</option><option value="LA">Lao People's Democratic Republic</option><option value="LV">Latvia</option><option value="LB">Lebanon</option><option value="LS">Lesotho</option><option value="LR">Liberia</option><option value="LY">Libyan Arab Jamahiriya</option><option value="LI">Liechtenstein</option><option value="LT">Lithuania</option><option value="LU">Luxembourg</option><option value="MO">Macao</option><option value="MK">Macedonia, The Former Yugoslav, Republic Of</option><option value="MG">Madagascar</option><option value="MW">Malawi</option><option value="MY">Malaysia</option><option value="MV">Maldives</option><option value="ML">Mali</option><option value="MT">Malta</option><option value="MH">Marshall Islands</option><option value="MQ">Martinique</option><option value="MR">Mauritania</option><option value="MU">Mauritius</option><option value="YT">Mayotte</option><option value="MX">Mexico</option><option value="FM">Micronesia, Federated Statesof</option><option value="MD">Moldova, Republic Of</option><option value="MC">Monaco</option><option value="MN">Mongolia</option><option value="MS">Montserrat</option><option value="MA">Morocco</option><option value="MZ">Mozambique</option><option value="MM">Myanmar</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NL">Netherlands</option><option value="AN">Netherlands Antilles</option><option value="NC">New Caledonia</option><option value="NZ">New Zealand</option><option value="NI">Nicaragua</option><option value="NE">Niger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk Island</option><option value="MP">Northern Mariana Islands</option><option value="NO">Norway</option><option value="OM">Oman</option><option value="PK">Pakistan</option><option value="PW">Palau</option><option value="PS">Palestinian Territory, Occupied</option><option value="PA">Panama</option><option value="PG">Papua New Guinea</option><option value="PY">Paraguay</option><option value="PE">Peru</option><option value="PH">Philippines</option><option value="PN">Pitcairn</option><option value="PL">Poland</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="RE">Reunion</option><option value="RO">Romania</option><option value="RU">Russian Federation</option><option value="RW">Rwanda</option><option value="SH">Saint Helena</option><option value="KN">Saint Kitts And Nevis</option><option value="LC">Saint Lucia</option><option value="PM">Saint Pierre And Miquelon</option><option value="VC">Saint Vincent And The Grenadines</option><option value="WS">Samoa</option><option value="SM">San Marino</option><option value="ST">Sao Tome And Principe</option><option value="SA">Saudi Arabia</option><option value="SN">Senegal</option><option value="CS">Serbia And Montenegro</option><option value="SC">Seychelles</option><option value="SL">Sierra Leone</option><option value="SG">Singapore</option><option value="SK">Slovakia</option><option value="SI">Slovenia</option><option value="SB">Solomon Islands</option><option value="SO">Somalia</option><option value="ZA">South Africa</option><option value="GS">South Georgia And The Southsandwich Islands</option><option value="ES">Spain</option><option value="LK">Sri Lanka</option><option value="SD">Sudan</option><option value="SR">Suriname</option><option value="SJ">Svalbard And Jan Mayen</option><option value="SZ">Swaziland</option><option value="SE">Sweden</option><option value="CH">Switzerland</option><option value="SY">Syrian Arab Republic</option><option value="TW">Taiwan, Province Of China</option><option value="TJ">Tajikistan</option><option value="TZ">Tanzania, United Republic Of</option><option value="TH">Thailand</option><option value="TL">Timor-leste</option><option value="TG">Togo</option><option value="TK">Tokelau</option><option value="TO">Tonga</option><option value="TT">Trinidad And Tobago</option><option value="TN">Tunisia</option><option value="TR">Turkey</option><option value="TM">Turkmenistan</option><option value="TC">Turks And Caicos Islands</option><option value="TV">Tuvalu</option><option value="UG">Uganda</option><option value="UA">Ukraine</option><option value="AE">United Arab Emirates</option><option value="GB">United Kingdom</option><option value="UM">United States Minor Outlyingislands</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistan</option><option value="VU">Vanuatu</option><option value="VE">Venezuela</option><option value="VN">Viet Nam</option><option value="VG">Virgin Islands, British</option><option value="VI">Virgin Islands, U.s.</option><option value="WF">Wallis And Futuna</option><option value="EH">Western Sahara</option><option value="YE">Yemen</option><option value="ZM">Zambia</option><option value="ZW">Zimbabwe</option></select>
                                    </div>

                                    <div class="form-group col-sm-6">
                                        <label>State</label>
                                        <input class="form-control no-border-radius" name="state" value="<?php echo set_value('state', $userState)?>" type="text">
                                    </div>


                                <div class="clearfix"></div>
                                    <div class="form-group col-sm-6">
                                        <?php echo form_error('city')?>
                                        <label>City</label>
                                        <input type="text" name="city" value="<?php echo set_value('city',$userCity)?>" class="form-control no-border-radius">
                                    </div>


                                    <div class="form-group col-sm-12">
                                        <?php echo form_error('about')?>
                                        <label>About</label>
                                        <textarea name="about" class="form-control no-border-radius"><?php echo set_value('about', $userAbout)?></textarea>
                                    </div>

                                    <div class="form-group col-sm-12">
                                        <input type="submit" class="btn btn-dark bg-black-gradient no-border-radius" value="Update Profile">
                                    </div>
                                <?php echo form_close()?>
                            </div>
                        </div>
                    </div>



                    <div class="clearfix"></div>

                </div>
                    </div>

                    <div id="password" class="tab-pane fadeInUp">

                        <div class="col-sm-6">
                            <div class="panel panel-danger">
                                <div class="panel-heading">
                                    Change Password
                                </div>

                                <div class="panel-body">
                                    <?php echo form_open('profile/change_password')?>
                                        <div class="form-group">
                                            <?php echo form_error('old_password')?>
                                            <label>Old Password</label>
                                            <input class="form-control no-border-radius" required name="old_password" type="text">
                                        </div>

                                        <div class="form-group">
                                            <?php echo form_error('password')?>
                                            <label>New Password</label>
                                            <input class="form-control no-border-radius" required name="password" type="password">
                                        </div>

                                        <div class="form-group">
                                            <?php echo form_error('cpassword')?>
                                            <label>Confirm New Password</label>
                                            <input class="form-control no-border-radius" required name="cpassword" type="password">
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" class="btn- bg-red text-white btn no-border-radius" value="Change Password">
                                        </div>
                                    <?php echo form_close()?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="membership">


                    </div>

                </div>

            </div>

        </div>

    </div>
</section>



<!-- mobile search modal begins here -->

<div id="mobileSearch" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 200px">

        <!-- Modal content-->
        <div class="modal-content no-border-radius">

            <div class="modal-body">
                <div class="searchZippr">
                    <h4>Type your search and hit enter</h4>
                    <div class="form-group no-margin-xs">
                        <input class="width-100 search-control" placeholder="Username, Competition, Photo title here" type="search">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script>
<script src="<?php echo base_url()?>js/jquery.masonry.js"></script>
<script>
    $(function(){

        var $container = $('#photo_wrapper');

        $container.imagesLoaded( function(){
            $container.masonry({
                itemSelector : '.photo_row'
            });
        });

    });
</script>
</body>
</html>

