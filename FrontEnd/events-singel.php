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




    <!--====== PAGE BANNER PART START ======-->

    <section id="page-banner" class="pt-105 pb-110 bg_cover" data-overlay="8" style="background-image: url(../images/page-banner-3.jpg)">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="page-banner-cont">
                        <h2>Campus clean workshop</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item"><a href="#">Events</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Campus clean workshop</li>
                            </ol>
                        </nav>
                    </div> <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== PAGE BANNER PART ENDS ======-->
<div id='your-container-id'>

</div>

<div id="hiddenRole" data-role="<?php echo $_SESSION['Role']; ?>"></div>

<div id ='hiddenId' data-userid="<?php echo$_SESSION['user_id'];?>"></div>
    <?php footer(true,true); ?>
    
    
    
    
    
    
        
<?php JSfunctions(true); ?>  

</body>


<script>

var Role = $("#hiddenRole").data("role");
    console.log("role: "+ Role);
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
    console.log('event :', eventID);

  

    $.ajax({
        url: '../BackEnd/Models/Users.php', // URL to your PHP script
        type: 'POST',
        data: { action: 'fetchEvent', eventID: eventID },
        success: function(events) {
            console.log("okay",events);
           
var eventHtml = '<section id="event-singel" class="pt-120 pb-120 gray-bg">' +
                    '<div class="container">' +
                        '<div class="events-area">' +
                            '<div class="row">' +
                                '<div class="col-lg-8">' +
                                    '<div class="events-left">' +
                                        '<h3>' + events.EVENT_TITLE + '</h3>' +
                                        '<a href="#"><span><i class="fa fa-calendar"></i> ' + events.EVENT_DATE + '</span></a>' +
                                        '<a href="#"><span><i class="fa fa-clock-o"></i> ' + events.EVENT_DATE + ' ' + events.END_TIME + '</span></a>' +
                                        '<a href="#"><span><i class="fa fa-map-marker"></i> ' + events.LOCATION + '</span></a>' +
                                        '<img src="' + events.IMAGES + '" alt="Event">' +
                                        '<p>' + events.EVENT_DESC + '</p>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="col-lg-4">' +
                                    '<div class="events-right">' +
                                        '<div class="events-coundwon bg_cover" data-overlay="8" style="background-image: url(../images/event/singel-event/coundown.jpg)">' +
                                            '<div data-countdown="2024/03/12"></div>' +
                                            '<div class="events-coundwon-btn pt-30">' +
                                               '<button class="main-btn testButton" id="registrationButton">Register Now</button> ' +
                                               '</div>' +
                                        '</div>' +
                                        '<div class="events-address mt-30">' +
                                            '<ul>' +
                                                '<li>' +
                                                    '<div class="singel-address">' +
                                                        '<div class="icon">' +
                                                            '<i class="fa fa-clock-o"></i>' +
                                                        '</div>' +
                                                        '<div class="cont">' +
                                                            '<h6>Start Time</h6>' +
                                                            '<span>' + events.EVENT_DATE + '</span>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</li>' +
                                                '<li>' +
                                                    '<div class="singel-address">' +
                                                        '<div class="icon">' +
                                                            '<i class="fa fa-bell-slash"></i>' +
                                                        '</div>' +
                                                        '<div class="cont">' +
                                                            '<h6>Finish Time</h6>' +
                                                            '<span>' + events.END_TIME + '</span>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</li>' +
                                                '<li>' +
                                                    '<div class="singel-address">' +
                                                        '<div class="icon">' +
                                                            '<i class="fa fa-map"></i>' +
                                                        '</div>' +
                                                        '<div class="cont">' +
                                                            '<h6>Address</h6>' +
                                                            '<span>' + events.LOCATION + '</span>' +
                                                        '</div>' +
                                                    '</div>' +
                                                '</li>' +
                                            '</ul>' +
                                            '<div id="contact-map" class="mt-25"></div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>' +
                '</section>';

// Assuming you have a container element where you want to append the HTML
$('#your-container-id').html(eventHtml);
// added this only 
if (Role === 3) {
    $('#registrationButton').text('Edit');
}



$('.testButton').click(function () {
    // Show the registration form

var userRole = $('#hiddenRole').data('role');
console.log("role : "+userRole);

    
var userId = $("#hiddenId").data("userid");
console.log(userId);
if (userRole == 3) {
    // Your existing code
    var editData = {
        action: 'editEvent',
        eventID: events.EVENT_ID, // Assuming you have the event ID
        userID: userRole // Replace with the actual user ID or other data
    };


            // Add the redirection here after the editing is successful
            window.location.href = 'editEventForm.php?id=' +eventID; // Replace with the URL where you want to redirect
    
}






else {
    var registrationData = {
        action: 'registerForEvent',
        eventID: events.EVENT_ID, // Assuming you have the event ID
        userID: userId // Replace with the actual user ID
        // Add other registration data if needed
    };

    $.ajax({
    url: '../BackEnd/Models/Users.php',
    type: 'POST',
    data: registrationData,
    dataType: 'json',
    success: function (registrationResponse) {
        // Handle the registration response
        console.log(registrationResponse);
        if (registrationResponse.status === 'success') {
            alert('Successfully registered for the event');
        } else {
            // Use the message from the server, if available
            let message = registrationResponse.message || 'Registration failed';
            alert('Registration failed: ' + message);
        }
    },
    error: function (xhr, status, error) {
        console.error('Error registering for the event:', status, error);
    }
})};

 
});
        


        },
        error: function() {
            console.log('Error fetching events');
        }
    });



 
});



</script>
</html>
