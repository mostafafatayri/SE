<?php
require_once'../BackEnd/Common/Setup.php';

authenticationCustomers();
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
  <?php  CommonFuncs(true);  ?>
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

<div id ='hiddenId' data-userid="<?php echo$_SESSION['user_id'];?>"></div>

<header id="header-part">
       
<?php headerTop($useRelativePath = true) ?>
       
    
       
       
   </header>

    

     

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

        <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle" id="profileImage">



          <h2> <?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];  ?></h2>
          
          <div class="social-links mt-2">
            <a href="#" class="X"><i class="bi bi-twitter"></i></a>
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

   


          
              <div class="row">
                <div class="col-lg-3 col-md-4 label">Phone</div>
                <div class="col-lg-9 col-md-8 Phone" >(436) 486-3538 x29071</div>
              </div>

              <div class="row">
                <div class="col-lg-3 col-md-4 label">Email</div>
                <div class="col-lg-9 col-md-8"><?php echo$_SESSION['email'];?> </div>
              </div>



              <div class="row">
                <div class="col-lg-3 col-md-4 label infoUp">CV</div>
                <div class="col-lg-9 col-md-8  CVout"> here</div>
              </div>

              <div class="text-center">
                  <button type="submit" class="btn btn-primary logout">Log out</button>
                </div>
            </div>

            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

              <!-- Profile Edit Form -->
        <form class = 'editInfo' >

        <!--hereeee --> 
        <div class="row mb-3">
    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
    <div class="col-md-8 col-lg-9">
        <!-- Image preview -->
        <img id="profile-img-preview" src="assets/img/profile-img.jpg" alt="Profile">
        
        <!-- Image Upload and Remove Buttons -->
        <div class="pt-2">
            <!-- Upload button triggers file input -->
            <label for="upload-profile-img" class="btn btn-primary btn-sm" title="Upload new profile image">
                <i class="bi bi-upload"></i>
                <input type="file" id="upload-profile-img" style="display:none" onchange="previewProfileImage(event)">
            </label>
            <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
        </div>
    </div>
</div>

  
<!--
            <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                <div class="col-md-8 col-lg-9">
                     <img src="assets/img/profile-img.jpg" alt="Profile">
                     <div class="pt-2">
                       <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                       <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                     </div>
                </div>
            </div>

-->
<!--
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
-->
           



<!---->
            <div class="row mb-3">



<button type="submit" class="btn btn-primary" style="display:none;">Submit</button>
</div>
          

                <div class="row mb-3">
                  <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                  <div class="col-md-8 col-lg-9">
                    <textarea name="about" class="form-control About AboutChange"  style="height: 100px"  ></textarea>
                  </div>
                </div>

   

                <div class="row mb-3">
                  <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                  <div class="col-md-8 col-lg-9">
                    <input name="phone" type="text" class="form-control Phone PhoneChange"  value="(436) 486-3538 x29071">
                  </div>
                </div>

             
                <div class="row mb-3">
                  <label for="CV?Link" class="col-md-4 col-lg-3 col-form-label">CV link </label>
                  <div class="col-md-8 col-lg-9">
                    <input name="twitter" type="text" class="form-control  CVChange" id="CV?Link" value="Word Document link for your CV">
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
  

  if ( $_SESSION[ 'IS_Company' ]  ){
    $isCompany = $_SESSION[ 'IS_Company' ];

 echo $isCompany ;


  }
  else {
    $isCompany = false;
    

 
  }

  
  //echo$_SESSION['user_id'];
  footer(true,false);
  
  ?>  

<div id ='hiddenId3' data-istrue="<?php echo$isCompany;?>"></div>

 
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>   
<script>
  //done
 
var use= $("#hiddenId3").data("istrue");
console.log('true or false : '+use);

   function previewProfileImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('profile-img-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

$(document).ready(function () {
//done 
  $('.logout').click(function(){

   $.ajax({
     type: "POST",
     url:"../BackEnd/Models/Users.php",
     data: {
      action: "logout"
     
  
     
    },
     success: function (response) {

      alert("Logged out");
      location.href = '../index.php';


   },
  error: function () {
      alert("Error while trying to log out");
  }




})



});



var userId = $("#hiddenId").data("userid");
//console.log(userId);


var backend ='';
if (use==1){
  backend="../BackEnd/Models/Company.php";
  console.log("the backend is corect");

  var label = document.querySelector('label[for="CV?Link"]');
    label.textContent = 'Website link';
  

    var label = document.querySelector('.infoUp');

    label.textContent = 'Website';
  

    
}
else {
  console.log("the backend is up:");
backend="../BackEnd/Models/Users.php";

}




$.ajax({
  type: "POST", // Use "POST" instead of "Post"
  url: backend,
  data: {
    action: "UsersInfo",
    id: userId
  },
  success: function (response) {

    var info = JSON.parse(response); 
    console.log(info)    

    var Phone = info.PHONE_NUMB;

    var about = info.INTERESTS ;


    var frName = info.First_Name ; 


    var lstName =  info.Last_Name ;


    var ProfilePic = info.PROFILE_PIC; // Your dynamic profile picture URL
$('#profileImage').attr('src', ProfilePic); // Set the new source for the image

$('#profile-img-preview').attr('src', ProfilePic);


    console.log(ProfilePic);

    var link = info.CV;
    console.log(Phone);
    console.log(about);
    console.log(frName);
    console.log(lstName);

    $('.Phone').text(Phone);
    $('.About').text(about);
   $('.CVChange').val(link);





    $('.FrNameChange').val(frName);
    $('.LstNameChange').val(lstName);
    $('.Phone').val(Phone);
    $('.About').val(about);

    var link = $("<a>").attr("href", link).attr("target", "_blank").text("View here");
           
           $('.CVout').html(link);
           








     

    $('.editInfo').submit(function(event) {
    event.preventDefault();
    




    var formData = new FormData(this); // 'this' refers to the form
    var number = $('.PhoneChange').val();
    var changeBio = $('.AboutChange').val();
    var CVChange = $('.CVChange').val();
    var fileInput = document.getElementById('upload-profile-img');
    $('.Phone').text(number);
    $('.About').text(changeBio);

    // Append additional form data
    formData.append('action', 'UpdateData');
    formData.append('UserID', userId);
    formData.append('interset', changeBio);
    formData.append('cv', CVChange);
    formData.append('number', number);

    // Append file data if a file is selected
    if (fileInput.files[0]) {
        formData.append('profileImage', fileInput.files[0]);
    }
// her change :








    $.ajax({
        type: "POST",
        url: backend,
        data: formData,
        contentType: false, // Must be false to correctly send FormData
        processData: false, // Must be false to prevent jQuery from converting the FormData into a string
        success: function(response) {
            alert("Profile updated Successfully");
        },
        error: function() {
            alert("Error while trying to update");
        }
    });
});

    
  },
  error: function (xhr, status, error) {
    console.error(error); 
  }
});




});


            

</script>

</html>