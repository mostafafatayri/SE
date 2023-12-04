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

<?php      preloader();  headerTop($useRelativePath=true);   ?>




   
   
    
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
                                <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Update  Event</a>
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
                                                        <button type="button" id="postEventButton" class="main-btn">update  Event</button>

                                                           
                                                        </div>
                                                        <div class="form-singel">
                                                        <button type="button" id="DeleteEventButton" class="main-btn "style="background-color: red;">Delete  Event</button>

                                                           
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



   
  
    
    

    


  

<?php footer(true,true); ?>    
<?php JSfunctions(true); ?>  

</body>


<script>




  // Fetch data when the page is loaded
  $(document).ready(function() {

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

var eventID = getParameterByName('id');
console.log('event:', eventID);


$('#DeleteEventButton').click(function() {
      
       
        $.ajax({
            url: '../BackEnd/Models/Department.php',
            type: 'POST',
            data: {
                action: 'deleteEvent',
                eventID: eventID
            },
            success: function(response) {
               
                alert("Event deleted successfully");
                window.location.href = 'events.php';


               
            },
            error: function(xhr, status, error) {
                console.error('Error deleting the event:', status, error);
               
            }
        });
    });

$.ajax({
    url: '../BackEnd/Models/Users.php', // URL to your PHP script
    type: 'POST',
    data: { action: 'fetchEvent', eventID: eventID },
    success: function(eventData) {
        console.log("okay", eventData);
           // Populate the form fields with the event data
    $('#Eventtitle').val(eventData.EVENT_TITLE);
    $('#EventLocation').val(eventData.LOCATION);

    // Formatting datetime for datetime-local input type
    var eventDate = new Date(eventData.EVENT_DATE).toISOString().slice(0, 16);
    var closeRegAt = new Date(eventData.CLOSE_REG_AT).toISOString().slice(0, 16);
    $('#eventTime').val(eventDate);
    $('#eventTimeEnd').val(closeRegAt);

    // Set the end time (time input type)
    $('#eventTimeEndDate').val(eventData.END_TIME);

    // Set the size (number input type)
    $('#eventSize').val(eventData.SIZE);

    // Set the description (textarea)
    $('#profile-img-preview').attr('src', eventData.IMAGES);
    $('#description').val(eventData.EVENT_DESC);



    $('#postEventButton').click(function(e) {
        e.preventDefault();

        // Create FormData object to handle file upload along with other data
        var formData = new FormData();

        // Append data from text inputs and textarea to formData
        formData.append('action', 'updateEvent');
        formData.append('eventID', getParameterByName('id'));
        formData.append('eventTitle', $('#Eventtitle').val());
        formData.append('eventLocation', $('#EventLocation').val());
        formData.append('eventTime', $('#eventTime').val());
        formData.append('eventTimeEnd', $('#eventTimeEnd').val());
        formData.append('eventTimeEndDate', $('#eventTimeEndDate').val());
        formData.append('eventSize', $('#eventSize').val());
        formData.append('description', $('#description').val());

        // Check if file is selected and append to formData
        var fileInput = $('#upload-profile-img')[0];
        if (fileInput.files && fileInput.files[0]) {
            formData.append('eventImage', fileInput.files[0]);
        }

        // Send data to backend via AJAX
        $.ajax({
            url: '../BackEnd/Models/Department.php', // Update with the correct URL
            type: 'POST',
            data: formData,
            contentType: false, // Important for FormData
            processData: false, // Important for FormData
            success: function(response) {
                console.log("Event updated successfully", response);
                // Handle success - maybe redirect or show a success message
                alert("Updated Completed");
                window.location.href = 'events.php';

            },
            error: function(xhr, status, error) {
                console.error('Error updating the event:', status, error);
                // Handle errors - show error message to the user
            }
        });
    });
    },
    error: function(xhr, status, error) {
        console.error('Error registering for the event:', status, error);
    }
});
});







</script>
</html>
