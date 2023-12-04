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
<style>
.job {
    display: flex;
    border: 1px solid #e0e0e0;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    background-color: #ffffff;
    align-items: center;
    transition: all 0.3s ease;
}

.job:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
    transform: translateY(-3px);
}

.job-image img {
    width: 120px; /* Adjust as needed */
    height: auto;
    border-radius: 4px;
    margin-right: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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

.edit-button a {
    color: white;
    text-decoration: none;
}

.edit-button:hover {
    background-color: #0056b3;
}

 </style>
</head>

<body>
   
 
    
  
    <?php      preloader();  headerTop($useRelativePath=true);   ?>
   



   <div id="jobs-list" class="jobs-container">
    <!-- Jobs will be dynamically inserted here -->
</div>



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
        url: '../BackEnd/Models/Company.php', // URL to your PHP script
        type: 'POST',
        data: { action: 'fetchJobsForCompany',id:userId },
        success: function(jobs) {
            var jobsHtml = '';
            $.each(jobs, function(index, job) {
                jobsHtml += '<div class="job">' +
                                '<div class="edit-button">' +
                                    '<a href="editjob.php?jobId=' +job.JOB_ID  + '">Edit</a>' +
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
            });
            $('#jobs-list').html(jobsHtml);
        },
        error: function() {
            console.log('Error fetching events');
        }
    });
});


</script>
</script>
</html>
