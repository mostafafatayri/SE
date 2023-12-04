<?php   

require_once'../BackEnd/Common/Setup.php';

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
<style>
.job {
    display: flex;
    align-items: flex-start; /* Align items to the start of the container */
    justify-content: space-between; /* Distribute space between the items */
    border: 1px solid #e0e0e0;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    transition: all 0.3s ease;
}

.job:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    transform: translateY(-3px);
}

.job-image {
    flex: 0 0 120px; /* Do not grow or shrink, stay at 120px width */
    height: 60px; /* Fixed height */
    display: flex;
    align-items: center; /* Center the image vertically */
    justify-content: center; /* Center the image horizontally */
    overflow: hidden; /* Hide the overflowed part of the image */
    margin-right: 20px;
}

.job-image img {
    height: 100%; /* Make image fill the height */
    width: auto; /* Adjust width automatically */
    object-fit: cover; /* Cover the area without losing aspect ratio */
}


.job-details {
    flex-grow: 1;
}

.job-details h3 {
    margin-top: 0;
    color: #333333;
    font-size: 1.2em;
}

.job-details p {
    margin: 5px 0;
    color: #666666;
}

.job-details p strong {
    color: #333333;
}
.edit-button {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #007bff;
    color: white;
    padding: 5px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.edit-button {
    margin-left: 20px; /* Add margin to the left of the button */
}
.edit-button:hover {
    background-color:green; 
}

 </style>
</head>

<body>
   
 
    
  
    <?php      preloader();  headerTop($useRelativePath=true);   ?>
   



   <div id="jobs-list" class="jobs-container">
    <!-- Jobs will be dynamically inserted here -->
</div>

<div id ='hiddenId' data-userid="<?php echo$_SESSION['user_id'];?>"></div>

<?php footer(true,true); ?>        
<?php JSfunctions(true); ?>    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<div id ='hiddenId' data-userid="<?php echo$_SESSION['user_id'];?>"></div>
</body>
<script>
$(document).ready(function() {

    var userId = $("#hiddenId").data("userid");
    console.log(userId);
    $.ajax({
        url: '../BackEnd/Models/Users.php', // URL to your PHP script
        type: 'POST',
        data: { action: 'fetchJobs' },
        success: function(jobs) {
            var jobsHtml = '';
            $.each(jobs, function(index, job) {
                jobsHtml += '<div class="job">' +
    '<div class="edit-button">' +
        '<button class="apply-btn" data-jobid="' + job.JOB_ID + '">Apply</button>' +
    '</div>' +
    '<div class="job-image">' +
        '<img src="' + job.PROFILE_PIC + '" alt="Company Image">' +
    '</div>' +
    '<div class="job-details">' +
        '<h3>' + job.TYPE + '</h3>' +
        '<p><strong>Description:</strong> ' + job.DESCRIPTION + '</p>' +
        '<p><strong>Posted on:</strong> ' + job.POSTED_DATE + '</p>' +
        // Add more fields as necessary
    '</div>' +
'</div>';
;
            });
            $('#jobs-list').html(jobsHtml);
        },
        error: function() {
            console.log('Error fetching events');
        }
    });

    var userId = $("#hiddenId").data("userid");
    $(document).on('click', '.apply-btn', function() {
    var jobId = $(this).data('jobid');
    console.log('Applying for job ID: ' + jobId);

  // AJAX request to apply for the job
$.ajax({
    url: '../BackEnd/Models/Users.php', // URL to your apply script
    type: 'POST',
    data: { action: 'applyForJob', jobID: jobId, userId: userId },
    success: function(response) {
       
        alert(response); // Display the server's response message

        // Optionally, handle different responses differently
        if (response === "Application successful.") {
            // Handle application success
            console.log('Application successful');
        } else if (response === "You have already applied for this job.") {
            // Handle already applied case
            console.log('Already applied for this job');
        } else {
            // Handle other types of responses or errors
            console.log('Application process encountered an issue');
        }
    },
    error: function() {
        console.log('Error applying for job');
        alert('Error occurred while applying for the job');
        // Handle error
    }
});

});





});


</script>
</script>
</html>
