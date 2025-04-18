<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seller</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css"> 
     <!-- jQuery (Required for Select2) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0
           font-family: sans-serif;
        }

        html {
            height: 100%
        }

        p {
            color: grey
        }

        #heading {
            text-transform: uppercase;
            color: #efc475;
            font-weight: normal
        }

        #msform {
            text-align: center;
            position: relative;
            margin-top: 20px
        }

        #msform fieldset {
            background: white;
            border: 0 none;
            border-radius: 0.5rem;
            box-sizing: border-box;
            width: 100%;
            margin: 0;
            padding-bottom: 20px;
            position: relative
        }

        .form-card {
            text-align: left
        }

        #msform fieldset:not(:first-of-type) {
            display: none
        }

        #msform input,
        #msform textarea,
        #msform select {
            padding: 8px 15px 8px 15px;
            border: 1px solid #ccc;
            border-radius: 0px;
            margin-bottom: 25px;
            margin-top: 2px;
            width: 100%;
            box-sizing: border-box;
            font-family: montserrat;
            color: #2C3E50;
            background-color: #ECEFF1;
            font-size: 16px;
            letter-spacing: 1px
        }

        #msform input:focus,
        #msform textarea:focus {
            -moz-box-shadow: none !important;
            -webkit-box-shadow: none !important;
            box-shadow: none !important;
            border: 1px solid #efc475;
            outline-width: 0
        }

        #msform .action-button {
            width: 100px;
            background: #efc475;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 0px 10px 5px;
            float: right
        }

        #msform .action-button:hover,
        #msform .action-button:focus {
            background-color: #08ADC5;
        }

        #msform .action-button-previous {
            width: 100px;
            background: #616161;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 0px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px 5px 10px 0px;
            float: right
        }

        #msform .action-button-previous:hover,
        #msform .action-button-previous:focus {
            background-color: #000000
        }

        .card {
            z-index: 0;
            border: none;
            position: relative
        }

        .fs-title {
            font-size: 25px;
            color: #efc475;
            margin-bottom: 15px;
            font-weight: normal;
            text-align: left
        }

        .purple-text {
            color: #efc475;
            font-weight: normal
        }

        .steps {
            font-size: 25px;
            color: gray;
            margin-bottom: 10px;
            font-weight: normal;
            text-align: right
        }

        .fieldlabels {
            color: gray;
            text-align: left
        }

        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            color: lightgrey
        }

        #progressbar .active {
            color: #efc475
        }

        #progressbar li {
            list-style-type: none;
            font-size: 15px;
            width: 25%;
            float: left;
            position: relative;
            font-weight: 400
        }

        #progressbar #account:before {
            font-family: FontAwesome;
            content: "\f13e"
        }

        #progressbar #personal:before {
            font-family: FontAwesome;
            content: "\f007"
        }

        #progressbar #payment:before {
            font-family: FontAwesome;
            content: "\f030"
        }

        #progressbar #confirm:before {
            font-family: FontAwesome;
            content: "\f00c"
        }

        #progressbar li:before {
            width: 50px;
            height: 50px;
            line-height: 45px;
            display: block;
            font-size: 20px;
            color: #ffffff;
            background: lightgray;
            border-radius: 50%;
            margin: 0 auto 10px auto;
            padding: 2px
        }

        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: lightgray;
            position: absolute;
            left: 0;
            top: 25px;
            z-index: -1
        }

        #progressbar li.active:before,
        #progressbar li.active:after {
            background: #efc475
        }

        .progress {
            height: 20px
        }

        .progress-bar {
            background-color: #efc475
        }

        .fit-image {
            width: 100%;
            object-fit: cover
        }

        /* New styles for desktop two-column layout */
        @media (min-width: 992px) {
            .col-lg-6 {
                max-width: 100% !important;
            }

            .form-card {
                display: flex;
                flex-wrap: wrap;
                gap: 0 20px;
            }

            .form-card>div:not(.row) {
                width: calc(50% - 10px);
            }

            .form-card .row {
                width: 100%;
            }

            .form-card label {
                display: block;
                width: 100%;
            }

            #msform input,
            #msform textarea,
            #msform select {
                width: 100%;
            }

            /* Full width for specific elements */
            .form-card>div.row,
            .form-card>h2,
            .form-card>.col-7,
            .form-card>.col-5 {
                width: 100% !important;
            }
        }
    </style>
    <style>
        .mobile-input-wrapper {
            display: flex;
            align-items: center;
            
            border-radius: 4px;
            background-color: #ECEFF1
        }

        .country-code {
            display: flex;
            align-items: center;
            padding: 5px;
            /*background-color: #f5f5f5;*/
            /* border-right: 1px solid #ccc; */
        }

        .flag-icon {
            width: 20px;
            height: 14px;
            margin-right: 5px;
        }

        .mobile-input-wrapper input[type="text"] {
            flex: 1;
            border: none;
            padding: 5px;
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11 col-sm-10 col-md-10 col-lg-8 text-center p-0 mt-3 mb-2">
                <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                    <h2 id="heading"><strong>Register A New Seller</strong></h2>
                    <p>Fill all form field to go to next step</p>
                    <form id="msform" action="/submitform" enctype="multipart/form-data" method="POST">
                        @csrf
                        
                        
                        <!-- progressbar -->
                        <ul id="progressbar" style="padding:0px;">
                            <li class="active" id="account"><strong>Basic Information</strong></li>
                            <li id="personal"><strong>Warehouse Details</strong></li>
                            <li id="payment"><strong>Bank Details</strong></li>
                            <li id="confirm"><strong>Brand Details (Optional)</strong></li>
                        </ul>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div> <br>
                        <!-- fieldsets -->
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Basic Information:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 1 - 4</h2>
                                    </div>
                                </div>
                                <div hidden>
                                    <label>Added By:</label>
                                    <input type="hidden" name="added_by" value="ADMIN" disabled />
                                </div>
                                <div>
                                    <label>Business Owner Name:</label>
                                    <input type="text" name="owner_name" placeholder="Business Owner Name" />
                                </div>
                                <div>
                                    <label>Company Name:</label>
                                    <input type="text" name="company_name" placeholder="Company Name" />
                                </div>
                                <div>
                                    <label>GST Details:</label>
                                    <!--<input type="text" name="gst_number" placeholder="Enter your GST Number" />-->
                                    <input type="text" id="gst_number" name="gst_number"  placeholder="Enter your GST Number"  minlength="15" maxlength="15"/>
                                    <p id="gst_error" style="color: red;"></p>

                                </div>
                                <div>
                                    <label>Owner's Contact Number:</label>
                                    <div class="mobile-input-wrapper" style="width:100%">
                                        <span class="country-code text-dark">
                                            <img src="https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg"
                                                alt="India Flag" class="flag-icon">
                                            +91
                                        </span>
                                        <input type="text" id="mobile_code" placeholder="Enter Your Mobile Number"  name="registered_phone_number"  style="color:black; margin-left: 6px; margin-bottom: 0px;" required>
                                    </div>
                                    <span id="error-message" style="color: red; display: none;">Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.</span>
                                </div>
                                
                                
                                <div>
                                    <label>Owner's Email Address:</label>
                                    <input type="email" name="registered_email_id" placeholder="Owner's Email Address" />
                                </div>
      
                                
                                <div>
                                    <label>Address1:</label>
                                    <input type="text" name="registered_address1" placeholder="Address1" />
                                </div>
                                <div>
                                    <label>Address2:</label>
                                    <input type="text" name="registered_address2" placeholder="Address2" />
                                </div>

                                
                                <div>
                                    <label>Registered State:</label>
                                    
                                     <select name="registered_state" id="registered_state" class="form-control select2">
                                        <option selected>--Select State--</option>
                                        @foreach($state as $sta)
                                            <option value="{{ $sta->id }}">{{ $sta->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                              
                                
                                <div>
                                    <label>Registered City:</label>

                                    <select name="registered_city" id="registered_city" class="form-control select2">
                                        <option selected>--Select City--</option>
                                    </select>

                                </div>
                                
                       
                                <div>
                                    <label>Pin Code:</label>
                                    <input type="text" name="registered_pincode"  maxlength="6" minlength="6"  placeholder="Post Code" />
                                </div>
                                <div>
                                    <label>GST Certificate:</label>
                                    <input type="file" name="gst_certificate"  />
                                </div>
                                <div>
                                    <label>Government ID Proof:</label>
                                    <input type="file" name="govt_id_proof" />
                                </div>
                        
                                    <div>
                                        <label>Password :</label>
                                        <input type="password" id="password" name="password" placeholder="Enter Password" />
                                    </div>
                                    
                                    <div>
                                        <label>Confirm Password:</label>
                                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" onkeyup="validatePassword()" />
                                        <span id="error-password" style="color: red; display: none;">Passwords do not match!</span>
                                    </div>
                             
                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Warehouse Details:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 2 - 4</h2>
                                    </div>
                                </div>
                                <div>
                                    <label class="fieldlabels">Address1</label>
                                    <input type="text" name="warehouse_address1" placeholder="Address1" />
                                </div>
                                <div>
                                    <label class="fieldlabels">Address2</label>
                                    <input type="text" name="warehouse_address2" placeholder="Address2" />
                                </div>
                                
                                <div>
                                    <label>Registered State:</label>
                                    
                                     <select name="registered_state" id="registered_state2" class="form-control select2">
                                        <option selected>--Select State--</option>
                                        @foreach($state as $sta)
                                            <option value="{{ $sta->id }}">{{ $sta->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div>
                                    <label>Registered City:</label>

                                    <select name="registered_city" id="registered_city2" class="form-control select2">
                                        <option selected>--Select City--</option>
                                    </select>

                                </div>
                                
                                <div>
                                    <label class="fieldlabels">Pin Code</label>
                                    <input type="text" name="warehouse_pincode"  maxlength="6" minlength="6" placeholder="Post Code" />
                                </div>
                                <div>
                                    <label class="fieldlabels">Warehouse contact number</label>
                                    <div class="mobile-input-wrapper" style="width:100%">
                                        <span class="country-code text-dark">
                                            <img src="https://upload.wikimedia.org/wikipedia/en/4/41/Flag_of_India.svg"
                                                alt="India Flag" class="flag-icon">
                                            +91
                                        </span>
                                        <input type="text" id="mobile" placeholder="Enter Your Mobile Number"  name="warehouse_phone_number" style="color:black; margin-left: 6px; margin-bottom: 0px;" required>
                                    </div>
                                    <span id="error" style="color: red; display: none;">Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.</span>
                                </div>
                                <div>
                                    <label class="fieldlabels">Warehouse contact email</label>
                                    <input type="email" name="warehouse_email_id" placeholder="Warehouse contact email" />
                                </div>
                                
                                <div>
                                    <label>Shipping Mode</label>

                                    <select name="shipping_mode" class="form-control select2">
                                        <option  selected>--Shipping Mode--</option>
                                        
                                        <option value="In-Store">In-Store</option>
                                        <option value="Warehouse">Warehouse</option>
                                        
                                    </select>


                                </div>

                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Bank Details:</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 3 - 4</h2>
                                    </div>
                                </div>


                                <div>
                                    <label class="fieldlabels">Account Holder Name</label>
                                    <input type="text" placeholder="Account Holder Name" name="bank_account_holder" >
                                </div>
                                <div>
                                    <label class="fieldlabels">Account Number</label>
                                    <input type="text" placeholder="Account Number" name="bank_account_number" >
                                </div>



                                <div>
                                    <label class="fieldlabels">IFSC Code</label>
                                    <input type="text" placeholder="IFSC Code" name="bank_account_ifsc">
                                </div>
                                <div>
                                    <label class="fieldlabels">Bank Name</label>
                                    <input type="text" placeholder="Bank Name" name="bank_name" >
                                </div>


                                <div>
                                    <label class="fieldlabels">Account Type</label>
                                    <select name="bank_account_type">
                                        <option selected>--Select Account Type--</option>
                                        <option value="saving">Saving</option>
                                        <option value="current">Current</option>
                                        <option value="CashCredit">Cash Credit</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="fieldlabels">Upload Cancelled Cheque</label>
                                    <input type="file" accept="image/*" name="cancelled_cheque" >
                                </div>




                            </div>
                            <input type="button" name="next" class="next action-button" value="Next" />
                            <input type="button" name="previous" class="previous action-button-previous"
                                value="Previous" />
                        </fieldset>
                        <fieldset>
                            <div class="form-card">
                                
                                <div class="row">
                                    <div class="col-7">
                                        <h2 class="fs-title">Brand Details (Optional) :</h2>
                                    </div>
                                    <div class="col-5">
                                        <h2 class="steps">Step 4 - 4</h2>
                                    </div>
                                </div>


                                
                                    <div>
                                        <label class="fieldlabels">Brand Name</label>
                                        <input type="text" placeholder="Brand Name" name="brand_name" >
                                    </div>
                                    
                                    <div>
                                        <label for="fieldlabels">Nature of Brand</label>
                                        <select id="nature_of_brand" name="nature_of_brand">
                                            <option value="">Select Nature of Brand</option>
                                            <option value="Electronics">Electronics</option>
                                            <option value="Fashion">Fashion</option>
                                            <option value="Home & Kitchen">Home & Kitchen</option>
                                            <option value="Beauty & Personal Care">Beauty & Personal Care</option>
                                            <option value="Food & Beverage">Food & Beverage</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    
                                    <div >
                                        <label class="fieldlabels">Nature Of Business</label>
                                        <select name="nature_of_business">
                                            <option value="">Brand Owner + Manufacturer</option>
                                                                                        
                                            <option value="Distributor/Reseller">Distributor/Reseller</option>
                                            <option value="Brand Owner">Brand Owner</option>
                                            <option value="Exported/Importer">Exported/ Importer</option>
                                            <option value="Manufacturer">Manufacturer</option>
                                        </select>
                                    </div>
                                    <div >
                                        <label class="fieldlabels">Document for Proof</label>
                                        <select name="document_for_proof">
                                            <option value="">Trademark</option>
                                        </select>
                                    </div>
                               
                    
                                
                                    <div >
                                        <label class="fieldlabels">Authorized Document</label>
                                        <input type="file" accept="image/*" name="trademark_certificate">
                                        
                                    </div>
                                    <div >
                                        <label class="fieldlabels">Brand Logo</label>
                                        <input type="file" accept="image/*" name="brand_logo">
                                    </div>
                                




                            </div>


                            <input type="submit" value="Submit" style="background-color:#EFC475; width:120px; margin-top:10px; height:44px" class="pull-right"/>
                            <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                        </fieldset>

                        <!--<fieldset>-->
                        <!--    <div class="form-card">-->
                                
                        <!--        <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>-->
                        <!--        <div class="row justify-content-center">-->
                        <!--            <div class="col-6"> <img src="{{ asset('public/assets/images/logo/tickmark.gif') }}" class="fit-image"> </div>-->
                        <!--        </div>-->
                        <!--        <div class="row justify-content-center">-->
                        <!--        <div class="col-7 text-center">-->
                        <!--            <h5 class="purple-text text-center">You Have Successfully Signed Up</h5>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    </div>-->
                        <!--</fieldset>-->
                    </form>
                </div>
            </div>
        </div>
    </div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs; // fieldsets
        var opacity;
        var current = 1;
        var steps = $("fieldset").length;

        setProgressBar(current);

        $(".next").click(function() {
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            // Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            // Show the next fieldset
            next_fs.show();
            // Hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(++current);
        });

        $(".previous").click(function() {
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            // Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            // Show the previous fieldset
            previous_fs.show();

            // Hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    opacity = 1 - now;
                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 500
            });
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar").css("width", percent + "%");
        }
    });
</script>

<script>
    document.getElementById('mobile_code').addEventListener('input', function() {
        var mobile = this.value;
        var errorMessage = document.getElementById('error-message');

        // Check if the first digit is one of 0, 1, 2, 3, 4, 5, and prevent input
        if (/^[0-5]/.test(mobile)) {
            this.value = mobile.slice(0, -1); // Remove the last character entered
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
        }

        // Allow only 10 digits
        if (mobile.length > 10) {
            this.value = mobile.slice(0, 10); // Limit to 10 digits
        }
    });
</script>

<script>
function validatePassword() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("confirm_password").value;
    var errorMessage = document.getElementById("error-password");

    if (password !== confirmPassword && confirmPassword !== "") {
        errorMessage.style.display = "inline";
    } else {
        errorMessage.style.display = "none";
    }
}
</script>
<script>
    document.getElementById('mobile').addEventListener('input', function() {
        var mobile = this.value;
        var errorMessage = document.getElementById('error');

        // Check if the first digit is one of 0, 1, 2, 3, 4, 5, and prevent input
        if (/^[0-5]/.test(mobile)) {
            this.value = mobile.slice(0, -1); // Remove the last character entered
            errorMessage.style.display = 'block';
        } else {
            errorMessage.style.display = 'none';
        }

        // Allow only 10 digits
        if (mobile.length > 10) {
            this.value = mobile.slice(0, 10); // Limit to 10 digits
        }
    });
</script>

<script>
    document.getElementById("gst_number").addEventListener("input", function () {
        var gstNumber = this.value;
        var gstPattern = /^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}[Z]{1}[0-9A-Z]{1}$/;
        var errorMsg = document.getElementById("gst_error");

        if (gstNumber.length === 15) {
            if (!gstPattern.test(gstNumber)) {
                errorMsg.innerText = "Invalid GST Number";
                errorMsg.style.color = "red";
            } else {
                errorMsg.innerText = "✅ Valid GST Number";
                errorMsg.style.color = "green";
            }
        } else {
            errorMsg.innerText = "GST Number must be 15 characters long";
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>


<!-- Add jQuery to handle AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#registered_state').on('change', function() {
            var state_id = $(this).val();

            if (state_id) {
                $.ajax({
                    url: "{{ route('getCities') }}",
                    type: "GET",
                    data: { state_id: state_id },
                    success: function(data) {
                        $('#registered_city').empty();
                        $('#registered_city').append('<option selected>--Select City--</option>');
                        $.each(data, function(key, city) {
                            $('#registered_city').append('<option value="'+ city.id +'">'+ city.name +'</option>');
                        });
                    }
                });
            } else {
                $('#registered_city').empty();
                $('#registered_city').append('<option selected>--Select City--</option>');
            }
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('#registered_state2').on('change', function() {
            var state_id = $(this).val();

            if (state_id) {
                $.ajax({
                    url: "{{ route('getCities') }}",
                    type: "GET",
                    data: { state_id: state_id },
                    success: function(data) {
                        $('#registered_city2').empty();
                        $('#registered_city2').append('<option selected>--Select City--</option>');
                        $.each(data, function(key, city) {
                            $('#registered_city2').append('<option value="'+ city.id +'">'+ city.name +'</option>');
                        });
                    }
                });
            } else {
                $('#registered_city2').empty();
                $('#registered_city2').append('<option selected>--Select City--</option>');
            }
        });
    });
</script>
</body>

</html>
