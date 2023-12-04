<?php

require_once '../BackEnd/Common/Setup.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Users / Profile - NiceAdmin Bootstrap Template</title>
  <meta content="" name="description">
  <meta content="" name="keywords">



<!--navbar tools-->
<link href="../img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@400;700&family=Roboto:wght@400;700&display=swap" rel="stylesheet">  

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

<!----->

  <!-- Favicons -->
  
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  
 

  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../css/profile.css" rel="stylesheet">


  <link rel="stylesheet" href="../country/build/css/countrySelect.css">
  <link rel="stylesheet" href="../country/build/css/demo.css">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Aug 30 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  
     

<?php   



?>

          



     

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Profile</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Users</li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2> <?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];  ?></h2>
              <h3 id = 'startJob'>Web Designer</h3>
              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h5 class="card-title">About</h5>
                  <p class="small fst-italic About"  ></p>

                  <h5 class="card-title">Profile Details</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Full Name</div>
                    <div class="col-lg-9 col-md-8"> <?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];  ?></div>
                  </div>

                  <!--
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Company</div>
                    <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                  </div>
-->

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label"  >Job</div>
                    <div class="col-lg-9 col-md-8 Job"  >Web Designer</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Country</div>
                    <div class="col-lg-9 col-md-8 nationality  CountryCheck" ></div>
                  </div>

                  <div class="row" style="display:none">
                   
                    <div class="col-lg-9 col-md-8 idCode"  >Web Designer</div>
                  </div>

                  <!--
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Address</div>
                    <div class="col-lg-9 col-md-8">A108 Adam Street, New York, NY 535022</div>
                  </div>
                   -->
                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Phone</div>
                    <div class="col-lg-9 col-md-8 Phone" >(436) 486-3538 x29071</div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Email</div>
                    <div class="col-lg-9 col-md-8"><?php echo$_SESSION['email'];?> </div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
            <form class = 'editInfo' >


                <div class="row mb-3">
                        <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                         <img src="../assets/img/profile-img.jpg" alt="Profile">
                         <div class="pt-2">
                           <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                           <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                         </div>
                    </div>
                </div>



                <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">First Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control fullName  FrNameChange"  >
                      </div>
                </div>

                <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Last Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="LastName" type="text" class="form-control fullName  LstNameChange"  >
                      </div>
                </div>

               


                <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Price</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control fullName  PriceChange"  >
                      </div>
                </div>

<!---->
                <div class="row mb-3">
    <label for="country_selector_code" class="col-md-4 col-lg-3 col-form-label">Country</label>
    <div class="col-md-8 col-lg-9">
        <div class="input-group">
            <input id="country_selector" type="text" class="form-control ">
            <label for="country_selector" style="display:none;">Country</label> 
        </div>
    </div>

    <div class="form-item" style="display:none">
        <input type="text" id="country_selector_code" name="country_selector_code" data-countrycodeinput="1" readonly="readonly" placeholder="Selected country code will appear here" />
        <label for="country_selector_code">...and the selected country code will be updated here</label> 
    </div>

    <button type="submit" class="btn btn-primary" style="display:none;">Submit</button>
</div>
              

                    <div class="row mb-3">
                      <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                      <div class="col-md-8 col-lg-9">
                        <textarea name="about" class="form-control About AboutChange"  style="height: 100px"  ></textarea>
                      </div>
                    </div>

                  
                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control Job JobChange" id="Job" value="Web Designer">
                      </div>
                    </div>

                   

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control Phone PhoneChange"  value="(436) 486-3538 x29071">
                      </div>
                    </div>

                 
                    <div class="row mb-3">
                      <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="twitter" type="text" class="form-control" id="Twitter" value="https://twitter.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="facebook" type="text" class="form-control" id="Facebook" value="https://facebook.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="instagram" type="text" class="form-control" id="Instagram" value="https://instagram.com/#">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="linkedin" type="text" class="form-control" id="Linkedin" value="https://linkedin.com/#">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>

        </form>
        <!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">

                  <!-- Settings Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="changesMade" checked>
                          <label class="form-check-label" for="changesMade">
                            Changes made to your account
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Information on new products and services
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="proOffers">
                          <label class="form-check-label" for="proOffers">
                            Marketing and promo offers
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                          <label class="form-check-label" for="securityNotify">
                            Security alerts
                          </label>
                        </div>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form>

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


  
<?php
   footer($useRelativePath = true, $includeFrontEnd = true, $customLocation = '')
?>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>   
<script src="../country/build/js/countrySelect.js"></script>
<div id = 'hiddenId' data-userid = "<?php echo $_SESSION['user_id']; ?>"></div>

<script>



$(document).ready(function () {

var userId = $("#hiddenId").data("userid");
console.log(userId);

$.ajax({
  type: "POST", // Use "POST" instead of "Post"
  url: "../BackEnd/Models/DoctorsAction.php",
  data: {
    action: "DoctorInfo",
    id: userId
  },
  success: function (response) {


    var info = JSON.parse(response); 
    console.log(info)
    var JOB = info.Department;
    var Phone = info.Phone_Number;
    var nationality = info.Nationality;
    var about = info.Description ;

    var Price = info.Price ;

    var frName = info.First_Name ; 
    var lstName =  info.Last_Name ;

    var country = info.Country;  


    let inputString = country;
    // Find the index of '(' and ')'
    let startIndex = inputString.indexOf('(');
    let endIndex = inputString.indexOf(')');
    // Extract substrings
    let CountryPart = inputString.substring(0, startIndex).trim(); // "Canada"
    let code = inputString.substring(startIndex + 1, endIndex).trim(); // "ca"
   


console.log(country);
 
    $('#startJob').text(JOB)
    $('.Phone').text(Phone);
    $('.Job').text(JOB);
    $('.nationality').text(nationality);
    $('.About').text(about);
    $(".CountryCheck").text(CountryPart);
    $(".idCode").text(code);

    var Code4 = $('.idCode').text();
    console.log("the code is  from the outtter shell:"+Code4);
	$("#country_selector").countrySelect({
					// defaultCountry: "jp",
					// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
					// responsiveDropdown: true,

               

                   
					preferredCountries: [Code4]
	});



    /////// edit part
    /* */  
   
    $('.FrNameChange').val(frName);
    $('.LstNameChange').val(lstName);
    $('.Phone').val(Phone);
    $('.Job').val(JOB);
    $('.nationality').val(nationality);
    $('.About').val(about);
    $('.PriceChange').val(Price);

    let selectedCountry;

$("#country_selector").on('change', function() {
    // Update the selected country variable
    selectedCountrydraft  = $(this).val();
    var code =  $('#country_selector_code').val();

    selectedCountry = selectedCountrydraft+"("+code+")"
    // Print the selected country value
    console.log("Selected Country: " + selectedCountry);

   
  


    
});

// Now you can use the selectedCountry variable elsewhere in your code
// For example, you can use it in an AJAX request or perform any other action.





console.log(selectedCountry);


    
    $('.editInfo').submit(function(event){
        event.preventDefault();

         

        var FirstName =  $('.FrNameChange').val();
        var LastName =    $('.LstNameChange').val();
        var PhoneNumber =    $('.PriceChange').val();
       // console.log(FirstName);
        //console.log(LastName);
          
        $.ajax({
            type: "POST",
            url: "../BackEnd/Models/DoctorsAction.php",
            data: {
                action: "UpdateData",
                UserID:userId,
                firstName:FirstName,
                lastName:LastName,
                number:PhoneNumber,
                Country:selectedCountry
               
            },
            success: function (response) {

             alert("Profile updated Successfully");

            },
            error: function () {
                alert("Error while trying to log out");
            }
        });









        /*
        console.log($('.NameChange').val());
        console.log($('.JobChange').val());
        console.log($('.AboutChange').val());
        console.log($('.nationalityChange').val());
        console.log($('.PhoneChange').val());
        console.log('testinfg isnde');*/


    });
    
  },
  error: function (xhr, status, error) {
    console.error(error); // Handle any errors here
  }
});
});


$(document).ready(function() {
                  /*  var Code = $('.idCode').text();
                    console.log("the code is  from the outtter shell:"+Code);
				$("#country_selector").countrySelect({
					// defaultCountry: "jp",
					// onlyCountries: ['us', 'gb', 'ch', 'ca', 'do'],
					// responsiveDropdown: true,

               

                   
					preferredCountries: [Code,'ca', 'gb', 'us']
				});*/

				// Listen for changes in the country selector
			/*$("#country_selector").on('change', function() {
					


                    

                   var code =  $('#country_selector_code').val();
                   console.log('the code is :'+code);



					var selectedCountry = $(this).val();
                    $('#country_selector').val(selectedCountry);
					console.log("Selected Country: " + selectedCountry);
				});*/
	});


            
    </script>


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  
  
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
 
 <!-- <script src="../js/profile.js"></script>-->

</body>

</html>