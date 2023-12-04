<?php   

require_once'../BackEnd/Common/Setup.php';
authenticationCustomers();

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
   
   
   
    <!--====== PAGE BANNER PART START ======-->
    
    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url(../images/page-banner-3.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Requests</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Requests</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== PAGE BANNER PART ENDS ======-->
   
 <!---start-->


 <section id="teachers-singel" class="pt-70 pb-120 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="teachers-left mt-50">
                        <div class="hero">
                            <img src="../images/cs.jpeg" alt="Teachers">
                        </div>
                        <div class="name">
                            <h6>Computer Science Department</h6>
                           
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
                                <a id="courses-tab" data-toggle="tab" href="#courses" role="tab" aria-controls="courses" aria-selected="false">Make New Request</a>
                            </li>
                            <li class="nav-item">
                                <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">History</a>
                            </li>
                        </ul> <!-- nav -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <div class="dashboard-cont">
                                    <!--
                                    <div class="singel-dashboard pt-40">
                                        <h5>About</h5>
                                        <p>Lorem ipsum gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus .</p>
                                    </div> 
                                    <div class="singel-dashboard pt-40">
                                        <h5>Acchivments</h5>
                                        <p>Lorem ipsum gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus .</p>
                                    </div> 
                                   
                                   
                                   
                                    <div class="singel-dashboard pt-40">
                                        <h5>My Objective</h5>
                                        <p>Lorem ipsum gravida nibh vel velit auctor aliquetn sollicitudirem quibibendum auci elit cons equat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus .</p>
                                    </div> -->
                             
                             
                             
                             
                             
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
                                                </select>



                                             </div>
                                        </div>
                                            <div class="col-md-6"> <!-- Empty column for spacing -->  </div>
                                            
                                            <div class="col-md-6">

                                                <div class="form-singel">
                                                   <input type="file" id="fileInput" name="attachments[]" multiple>
                                                 </div>
                                           
                                            </div>
                                            <div class="col-md-6">  <!-- Empty column for spacing --> </div>
                                               <div class="col-lg-12">
                                                   <div class="form-singel">
                                                      <textarea id="description" placeholder="Description"></textarea>
                                                   </div>
                                                </div>
                                                 <div class="col-lg-12">
                                                   <div class="form-singel">
                                                      <button type="button" id="postEventButton" class="main-btn">Post Request</button>
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

                                   <!-- <ul>
                                    
                                       
                                       <li>

                                           <div class="singel-reviews">
                                                <div class="reviews-author">
                                                    <div class="author-thum">
                                                        <img src="../images/review/r-3.jpg" alt="Reviews">
                                                    </div>
                                                    <div class="author-name">
                                                        <h6>Tania Aktar</h6>
                                                        <span>April 20, 2019</span>
                                                    </div>
                                                </div>
                                                <div class="reviews-description pt-20">
                                                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                                             
                                                </div>
                                            </div> 
                                       </li>



                                    </ul>-->
                                   
                                   
                                </div> <!-- reviews cont -->
                            </div>
                        </div> <!-- tab content -->
                    </div> <!-- teachers right -->
            
    </section>


 <!--end-->
  
    


 <div id ='hiddenId' data-userid="<?php echo$_SESSION['user_id'];?>"></div>




    <?php  footer(true,true); ?>
                
<?php JSfunctions(true); ?>    
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

var userID = $("#hiddenId").data("userid");

$(document).ready(function() {
    $.ajax({
        url: '../BackEnd/Models/Department.php', // Adjust the URL to the path of your PHP script
        type: 'POST',
        data: { action: 'fetchAllTypes' },    
       // dataType: 'json', // Expecting JSON response
        success: function(response) {
            console.log("Requests fetched successfully: 44 ", response);

            var select = $("#mySelect");
             

            $.each(response  , function(index, option) {
                console.log("Adding option:", option.REQUEST_NAME); // Log each option
                select.append($('<option>', {
                    value: option.TYPE_ID,
                    text: option.REQUEST_NAME
                }));
            });
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error fetching requests:', textStatus, errorThrown);
        }
    });
});



$(document).ready(function() {
    // Attach a click event handler to the submit button
    $("#postEventButton").on("click", function() {
        // Get the values of the description and selected option
        var description = $("#description").val();
        var selectedOption = $("#mySelect").val();


var selectElement = document.getElementById('mySelect');


var selectedValue = selectElement.value;

console.log("the id of it :"+selectedValue); 

//console.log(selectedOption.value);
        


        var userId = $("#hiddenId").data("userid");

      


    
      
        var formData = new FormData();

        // Append the values to the FormData object
        formData.append("action", "submitRequest");
        formData.append("description", description);
        formData.append("userID", userId);
        formData.append("selectedOption", selectedOption);

        // Append the file input data to the FormData object
        var fileInput = $("#fileInput")[0];
        var files = fileInput.files;
        for (var i = 0; i < files.length; i++) {
            formData.append("attachments[]", files[i]);
        }

       // console.log(formData);

        // Perform the AJAX request to submit the form and attachments
        $.ajax({
            url: '../BackEnd/Models/Department.php', // Adjust the URL to the path of your PHP script
            type: 'POST',
            data: formData,
            contentType: false, // Important: Don't set contentType
            processData: false, // Important: Don't process data
            success: function(response) {
                console.log("Form submitted successfully:", response);
                alert("Request Submitted Successfully");
               // location.href = location.href;
                // Handle the response from the server here
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log('Error submitting form:', textStatus, errorThrown);
            }
        });
    });
});
function formatDate(dateString) {
                var options = { year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', timeZoneName: 'short' };
                return new Date(dateString).toLocaleDateString('en-US', options);
            }


$(document).ready(function() {
    // Replace 'YOUR_BACKEND_URL' with the actual URL of your backend script
    var backendUrl = '../BackEnd/Models/Users.php';

    // Replace 'YOUR_USER_ID' with the actual user ID you want to fetch history requests for
   

    // Make an AJAX request to fetch all history requests
    $.ajax({
        url: backendUrl, // Adjust the URL to the path of your PHP script
        type: 'POST',
        data: { action: 'fetchAllHistoryRequests', UserID: userID },
        dataType: 'json',
        success: function(response) {
            // Process the response here
            console.log("History requests fetched successfully:", response);

        

            // Function to generate HTML for a single review
            function generateReviewHtml(data) {
    var profile = '<?php session_start(); echo $_SESSION['first_name'].' '.$_SESSION['last_name'];?>';
    var html = '<li>';
    html += '<div class="singel-reviews">';
    html += '<div class="reviews-author">';
    html += '<div class="author-thum" style="background-image: url(' + profile + '); background-size: cover; background-position: center;"></div>';
    html += '<div class="author-name">';
    html += '<h6>' + profile + '</h6>';
    html += '<span>' + formatDate(data.CREATED_ID) + '</span>';
    html += '</div>';
    html += '</div>';
    html += '<div class="reviews-description pt-20">';
    html += '<p>' + data.COMMENTS + '</p>';
    if (data.REQUEST === "0") {
        html += '<p style="color: red;">Rejected</p>';
        if (data.RESPONSE) {
            html += '<p>Response: ' + data.RESPONSE + '</p>';
        }
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
}


            // Append the generated HTML for each review to the reviews-form ul
            var reviewsList = $('<ul></ul>'); // Create a new ul element
            for (var i = 0; i < response.length; i++) {
                var reviewHtml = generateReviewHtml(response[i]);
                reviewsList.append(reviewHtml);
            }

            // Append the ul to the reviews-form div
            $('.OldRequest').append(reviewsList);
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log('Error fetching history requests:', textStatus, errorThrown);
        }
    });
});

// Function to generate HTML for a single request (without response, accept, or reject details)
function generateRequestHtml2(data) {
    var profile = '<?php session_start(); echo $_SESSION['first_name'].' '.$_SESSION['last_name'];?>';
    var html = '<li>';
    html += '<div class="singel-reviews">';
    html += '<div class="reviews-author">';
    html += '<div class="author-thum" style="background-image: url(' + profile + '); background-size: cover; background-position: center;"></div>';
    html += '<div class="author-name">';
    html += '<h6>' + profile + '</h6>';
    html += '<span>' + formatDate(data.CREATED_ID) + '</span>';
    html += '</div>';
    html += '</div>';
    html += '<div class="reviews-description pt-20">';
    html += '<p>' + data.COMMENTS + '</p>';
    html += '</div>';
    html += '</div>';
    html += '</li>';
    return html;
}

// Make an AJAX request to fetch all current requests
$.ajax({
    url: '../BackEnd/Models/Users.php',
    type: 'POST',
    data: { action: 'fetchAllCurrentRequests', UserID: userID },
    dataType: 'json',
    success: function(response) {
        // Process the response here
        console.log("Current requests fetched successfully:", response);

        // Append the generated HTML for each request to the OldRequest container
        for (var i = 0; i < response.length; i++) {
            var requestHtml = generateRequestHtml2(response[i]);
            console.log("okay");
            $('.dashboard-cont').append(requestHtml);
        }
    },
    error: function(jqXHR, textStatus, errorThrown) {
        console.log('Error fetching current requests:', textStatus, errorThrown);
        console.log("just an eror ");
    }
});



</script>

</html>
