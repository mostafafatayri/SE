<?php   

require_once'../BackEnd/Common/Setup.php';
session_start();
?>



<!doctype html>
<html lang="en">

<head>
   
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php  CommonFuncs(true);  ?>

  
</head>

<body>
   
<?php    preloader();  headerTop($useRelativePath=true);   ?>
<div id ='hiddenId' data-userid="<?php echo$_SESSION['user_id'];?>"></div>





<section id="teachers-singel" class="pt-70 pb-120 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-lg-4 col-md-8">
    <div class="teachers-left mt-50">
        <div class="hero">
            <img src="" alt="Profile Picture">
        </div>
        <div class="name">
            <h6></h6>
        </div>
        <div class="social">
            <ul>
                <li><a href="#"><i class="fa fa-facebook-square"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter-square"></i></a></li>
                <li><a href="#"><i class="fa fa-google-plus-square"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
            </ul>
        </div>
        <div class="description">
            <p></p>
        </div>
    </div> <!-- teachers left -->
</div>

                <div class="col-lg-8">
                    <div class="teachers-right mt-50">
                        <ul class="nav nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="active" id="dashboard-tab" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a id="courses-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">Make Responses</a>
                            </li>
                            <li class="nav-item">
                                <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">History</a>
                            </li>
                        </ul> <!-- nav -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <div class="dashboard-cont">
                                <div id="userInfoContainer">
            
                             
            </div>
                             
                                </div> <!-- dashboard cont -->
                            </div>

                            <!--Course -->

                            <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                            
                                <div class="reviews-cont">
                                    <div class="title">
                                        <h6>Request</h6>
                                    </div>
                                    
                         <div class="reviews-form">
                              <form action="#">
                                 <div class="row">
                                       <div class="col-md-6">
                                            <div class="form-singel">
                                                <select id="mySelect">
                                                <option value="-1">Requests</option>
                                                <option value="0">Rejected</option>
                                                <option value="1">Accepted</option>
                                                
                                                </select>
                                             </div>
                                        </div>
                                            <div class="col-md-6"> <!-- Empty column for spacing -->  </div>
                                            
                                           
                                            <div class="col-md-6">  <!-- Empty column for spacing --> </div>
                                               <div class="col-lg-12">
                                                   <div class="form-singel">
                                                      <textarea id="description" placeholder="Description"></textarea>
                                                   </div>
                                                </div>
                                                 <div class="col-lg-12">
                                                   <div class="form-singel">
                                                      <button type="button" id="postEventButton" class="main-btn">Post Response</button>
                                                   </div>
                                                </div>
                                </div>
                            </form>
                 
                    

</div>
</div>          

                            </div>                        
                           
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="reviews-cont">
                                    <div class="title">
                                        <h6>Department Responses: </h6>
                                    </div>
                                   <div class='OldRequest'>

                                
                                   
                                   
                                </div> <!-- reviews cont -->
                            </div>
                        </div> <!-- tab content -->
                    </div> <!-- teachers right -->
            
    </section>







    





<?php   footer(true,true); ?>            
<?php JSfunctions(true); ?>    
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>

    
   $(document).ready(function () {
    // Fetch data when the page is loaded
    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    var reqId = getParameterByName('req_id');


    //here #
    $('#postEventButton').on('click', function () {
        // Capture values from the form
      //  var reqId = getParameterByName('req_id');
        var response = $('#mySelect').val();
       // var fileInput = $('#fileInput')[0].files;
        var description = $('#description').val();

        // Create FormData object to handle file upload
        var formData = new FormData();
        formData.append('action', 'PostResponse');
        formData.append('ReqID', reqId);
        formData.append('Response', response);
        formData.append('Description', description);

        console.log(response);
        console.log(description);
       // console.log(response);

        // Append each file to the FormData object
      
        // Use jQuery to send an AJAX request
       $.ajax({
            type: 'POST',
            url: '../BackEnd/Models/Department.php',
            data: formData,
            dataType: 'json',
            contentType: false, // Required for file upload
            processData: false, // Required for file upload
            success: function (response) {
                console.log("Response posted successfully:", response);
                alert("Response Send successfully");
                // Add any additional code to handle success here
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('Error posting response:', textStatus, errorThrown);
            }
        });
    });
    //endd

    // Use jQuery to send an AJAX request
    // Use jQuery to send an AJAX request
// Use jQuery to send an AJAX request
// Use jQuery to send an AJAX request
// Use jQuery to send an AJAX request
$.ajax({
    type: 'POST',
    url: '../BackEnd/Models/Department.php',
    data: { action: 'UserReq', ReqID: reqId },
    dataType: 'json',
    success: function (user) {
        console.log("User Object:", user);

        // Test if individual properties are accessible
        console.log("Profile Pic:", user.PROFILE_PIC);
        console.log("Full Name:", user.FIRST_NAME + ' ' + user.LAST_NAME);
        console.log("Interests:", user.INTERESTS);
        console.log("USERID:", user.USERID);

        // Use .data() to set data-userid attribute for the hiddenId div
        $('#hiddenId').data('userid', user.USERID);
    
        var initialUserId = $('#hiddenId').data('userid');
    fetchHistoryRequests(initialUserId);
   /// fetchHistoryRequests(newUserId);
        // Update HTML elements with user data
        $('.hero img').attr('src', user.PROFILE_PIC);
        $('.name h6').text(user.FIRST_NAME + ' ' + user.LAST_NAME);
        $('.description p').text(user.INTERESTS);

        var container = $('#userInfoContainer');
        console.log("data phome : "+user.PHONE_NUMB );
//here
var div = $('<div class="user-info"></div>');

// Add the key as a heading and the value as a paragraph
div.append('<h3>Email: </h3><br>');
div.append('<p>' + user.EMAIL + '</p><br>');

div.append('<h3>Phone Number: </h3><br>');
div.append('<p>' + user.PHONE_NUMB + '</p><br>');

div.append('<h3>CV: </h3><br>');
var cvLink = $('<a>').attr('href', user.CV).text('View CV');
div.append(cvLink);

// Append the div to the container
container.append(div);

//end





        var userIdFromHiddenId = $('#hiddenId').data('userid');
console.log("User ID from hiddenId:", userIdFromHiddenId);
    // Make an AJAX request to fetch all history requests
    }



});





    function fetchHistoryRequests(userId) {
        var backendUrl = '../BackEnd/Models/Users.php';

        // Make an AJAX request to fetch all history requests
        $.ajax({
            url: backendUrl,
            type: 'POST',
            data: { action: 'fetchAllHistoryRequests', UserID: userId },
            dataType: 'json',
            success: function (response) {
                console.log("History requests fetched successfully:", response);
                generateReviewHtml(response);
                // Function to generate HTML for a single review
                function generateReviewHtml(data) {
                    
                  //  var profile = '<?php session_start(); echo $_SESSION['first_name'].' '.$_SESSION['last_name'];?>';
                    var html = '<li>';
                    html += '<div class="singel-reviews">';
                    html += '<div class="reviews-author">';
                    html += '<div class="author-thum" style="background-image: url(' + + '); background-size: cover; background-position: center;"></div>';
                    html += '<div class="author-name">';
                 //   html += '<h6>' + profile + '</h6>';
                    html += '<span>' + data.CREATED_ID + '</span>';
                    html += '</div>';
                    html += '</div>';
                    html += '<div class="reviews-description pt-20">';
                    html += '<p>' + data.COMMENTS + '</p>';
                    if (data.REQUEST === "0") {
                        html += '<p style="color: red;">Rejected</p>';
                    } else {
                        html += '<p style="color: green;">Accepted</p>';
                        if (data.RESPONSE) {
                            html += '<p>Response: ' + data.RESPONSE + '</p>';
                        }
                    }
                    html += '</div>';
                    html += '</div>';
                    html += '</li>';
                 
                    return html;

                    console.log("check in");
                
           

// Add the key as a heading and the value as a paragraph
             
              
            
            }

                // Append the generated HTML for each review to the reviews-form ul
                var reviewsList = $('<ul></ul>'); // Create a new ul element
                for (var i = 0; i < response.length; i++) {
                    var reviewHtml = generateReviewHtml(response[i]);
                    reviewsList.append(reviewHtml);
                }

                // Append the ul to the reviews-form div
                $('.OldRequest').append(reviewsList);

                
             //r  div.append('<p>' + value + '</p>');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('Error fetching history requests:', textStatus, errorThrown);
            }
        });
    }

    // Initial fetch when the page is loaded
 


    
});


</script>

</html>


