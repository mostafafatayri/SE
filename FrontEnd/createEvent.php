<?php   

require_once'../BackEnd/Common/Setup.php';
AccessControll();
authenticationCustomers();
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
   
   
    
<section id="teachers-singel" class="pt-70 pb-120 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-8">
                    <div class="teachers-left mt-50">
                       
                    
                       <div class="hero">
                    
        
                            <img src="../images/event.svg" alt="Teachers" id="profile-img-preview">
                        </div>
                      
                        <!---->
                        <div class="pt-2">
            <!-- Upload button triggers file input -->
            <div>
            <label for="upload-profile-img" class="btn btn-primary btn-sm" title="Upload new profile image">
                <i class="bi bi-upload">Upload</i>
                <input type="file" id="upload-profile-img" style="display:none" onchange="previewProfileImage(event)">
            </label>
            </div>
          
            <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image" onclick="revertToDefaultImage()">
    <i class="bi bi-trash">Discard</i>
</a>


        </div>
                        






                    </div> <!-- teachers left -->
                </div>
                <div class="col-lg-8">
                    <div class="teachers-right mt-50">
                        <ul class="nav nav-justified" id="myTab" role="tablist">
                           
                            <li class="nav-item">
                                <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Add Event</a>
                            </li>
                        </ul> <!-- nav -->
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <div class="dashboard-cont">
                                    
                                </div> <!-- dashboard cont -->
                            </div>
                            <div class="tab-pane fade" id="courses" role="tabpanel" aria-labelledby="courses-tab">
                                <div class="courses-cont pt-20">
                                    <div class="row">
                                        
                                        
                                    </div> <!-- row -->
                                </div> <!-- courses cont -->
                            </div>
                            <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="reviews-cont">
                                    <div class="title">
                                        <h6>Event</h6>
                                    </div>
                                    <ul>
                                      
                                       
                                    </ul>
                                    <!--
                                    <div class="title pt-15">
                                        <h6>Leave A Comment</h6>
                                    </div>-->
                                    <div class="reviews-form">
                                        <form action="#">
                                                <div class="row">


                                                    <div class="col-md-6">
                                                        <div class="form-singel">
                                                            <label for='Eventtitle' > Event Title: </label>
                                                            <input type="text"  id="Eventtitle" placeholder="Title">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-singel">
                                                            <label for="EventLocation"> Event Location: </label>
                                                            <input type="text" id='EventLocation' placeholder="Location">
                                                        </div>
                                                    </div>



                                                    <div class="col-md-6">
                                                        <div class="form-singel">
                                                           <label for="eventTime">Event Time:</label>
                                                           <input type="datetime-local" id="eventTime" name="eventTime" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-singel">
                                                           <label for="eventTimeEnd">End Event Registration :</label>
                                                           <input type="datetime-local" id="eventTimeEnd" name="eventTimeEnd" required>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-singel">
                                                           <label for="eventTimeEndDate">End time :</label>
                                                           <input type="time" id="eventTimeEndDate" name="eventTimeEnd" required>
                                                        </div>
                                                    </div>
                                                    


                                                    <div class="col-md-6">
                                                        <div class="form-singel">
                                                           <label for="eventSize">Size :</label>
                                                           <br>
                                                           <input type="number" id='eventSize' placeholder="Size">
                                                        </div>
                                                    </div>

                                             

                                                

                                                    <div class="col-lg-12">
                                                        <div class="form-singel">
                                                            <textarea id="description" placeholder="Description"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-singel">
                                                        <button type="button" id="postEventButton" class="main-btn">Post Event</button>

                                                           
                                                        </div>
                                                    </div>
                                                </div> <!-- row -->
                                            </form>
                                    </div>
                                </div> <!-- reviews cont -->
                            </div>
                        </div> <!-- tab content -->
                    </div> <!-- teachers right -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>



   
  
    
    

    
























<div id ='hiddenId' data-userid="<?php echo$_SESSION['user_id'];?>"></div>

<?php footer(true,true); ?>           
<?php JSfunctions(true); ?>    
</body>
<script>
 function previewProfileImage(event) {
        var reader = new FileReader();
        reader.onload = function(){
            var output = document.getElementById('profile-img-preview');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }

    function revertToDefaultImage() {
        document.getElementById('profile-img-preview').src = '../images/event.svg'; // Path to your default image
    }

    $(document).ready(function() {
    $('#postEventButton').click(function() {

        
     var userId = $("#hiddenId").data("userid");
     console.log(userId);
        // Check if all required fields are filled
        if ($('#Eventtitle').val() === '' || $('#EventLocation').val() === '' || 
            $('#eventTime').val() === '' || $('#eventTimeEnd').val() === '' || 
            $('#eventTimeEndDate').val() === '' || $('#eventSize').val() === '') {
            alert('Please fill all required fields.');
            return;
        }

        // Create FormData object for the file upload
        var formData = new FormData();
        var fileData = $('#upload-profile-img')[0].files[0];
        formData.append('file', fileData);
        
       
        // Append other form data
        formData.append('action', 'PostEvent');
        formData.append('UserID', userId);
        formData.append('eventDesciption',$('#description').val());
        formData.append('eventTitle', $('#Eventtitle').val());
        formData.append('eventLocation', $('#EventLocation').val());
        formData.append('eventTime', $('#eventTime').val());
        formData.append('eventTimeEnd', $('#eventTimeEnd').val());
        formData.append('eventTimeEndDate', $('#eventTimeEndDate').val());
        formData.append('eventSize', $('#eventSize').val());
        // Add other fields as needed

        // AJAX request
        $.ajax({
            url: '../BackEnd/Models/Department.php', // Replace with your server URL
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                // Handle success
                alert('Event posted successfully.');
                window.location.href = 'events.php';

            },
            error: function() {
                // Handle error
                alert('Error posting event.');
            }
        });
    });
});


</script>
</html>








<!--
                                                    <div class="col-lg-12">
                                                        <div class="form-singel">
                                                            <div class="rate-wrapper">
                                                                <div class="rate-label">Your Rating:</div>
                                                                <div class="rate">
                                                                    <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                    <div class="rate-item"><i class="fa fa-star" aria-hidden="true"></i></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->