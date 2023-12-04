<?php   

require_once'../BackEnd/Common/Setup.php';

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
                        <h2>Events</h2>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Events</li>
                            </ol>
                        </nav>
                    </div>  <!-- page banner cont -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
    
    <!--====== PAGE BANNER PART ENDS ======-->
   
    <!--====== EVENTS PART START ======-->
    
    <section id="event-page" class="pt-90 pb-120 gray-bg">
        <div class="container">
           <div class="row">
           
            <div class="row">
                <div class="col-lg-12">
                    <nav class="courses-pagination mt-50">
                        <ul class="pagination justify-content-center">
                            <li class="page-item">
                                <a href="#" aria-label="Previous">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            </li>
                            <li class="page-item"><a class="active" href="#">1</a></li>
                            <li class="page-item"><a href="#">2</a></li>
                            <li class="page-item"><a href="#">3</a></li>
                            <li class="page-item">
                                <a href="#" aria-label="Next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </nav>  <!-- courses pagination -->
                </div>
            </div>  <!-- row -->
        </div> <!-- container -->
    </section>
    
    
<?php footer(true,true); ?>    
<?php JSfunctions(true); ?>    


<script>
$(document).ready(function() {
    $.ajax({
        url: '../BackEnd/Models/Department.php', // URL to your PHP script
        type: 'POST',
        data: { action: 'fetchAllEvents' },
        success: function(events) {
            var eventHtml = '';
            $.each(events, function(index, event) {
                var datetimeStr = event.EVENT_DATE;
                var parts = datetimeStr.split(' ');
                var date = parts[0]; // Gets the date part
                var time = parts[1]; // Gets the time part

                console.log("id is : ", event.EVENT_ID);

                eventHtml += '<div class="col-lg-6">' +
                    '<div class="singel-event-list mt-30">' +
                    '<div class="event-thum">' +
                    '<img src="' + event.IMAGES + '" alt="Event">' +
                    '</div>' +
                    '<div class="event-cont">' +
                    '<span><i class="fa fa-calendar"></i> ' + date + '</span>' +
                    '<a href="events-singel.php?id=' + event.EVENT_ID + '"><h4>' + event.EVENT_TITLE + '</h4></a>' +
                    '<span><i class="fa fa-clock-o"></i> ' + time + "  " + event.END_TIME + '</span>' +
                    '<span><i class="fa fa-map-marker"></i> ' + event.LOCATION + '</span>' +
                    // Add other event details here
                    '<p>' + event.EVENT_DESC + '</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>';
            });
            $('#event-page .container .row').first().html(eventHtml); // Replace the content
            console.log("okay sent");
        },
        error: function() {
            console.log('Error fetching events');
        }
    });
});

</script>

</body>
</html>
