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
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        padding: 20px;
    }

    #job-edit-form {
        background: #ffffff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        margin: 0 auto;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        display: block;
        margin-bottom: 5px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    textarea.form-control {
        height: 100px;
    }
    .btn-danger {
    background-color: #dc3545;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    margin-left: 10px;
}

.btn-danger:hover {
    background-color: #c82333;
}

</style>

</head>

<body>
   
 
    
  
    <?php      preloader();  headerTop($useRelativePath=true);   ?>
   

    <form id="job-edit-form">
    <input type="hidden" id="jobId" name="jobId">
    
    <div class="form-group">
        <label for="jobType">Job Type</label>
        <input type="text" id="jobType" name="jobType" class="form-control">
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea id="description" name="description" class="form-control"></textarea>
    </div>

   

    <button type="submit" class="btn btn-primary">Update Job</button>
    <button type="button" class="btn btn-danger" id="delete-job">Delete Job</button>

</form>



<?php footer(true,true); ?>        
<?php JSfunctions(true); ?>    

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>



</body>
<script>

function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, '\\$&');
    var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, ' '));
}

var jobId = getParameterByName('jobId');
console.log(jobId);

$(document).ready(function() {
    // Fetch job data
    $.ajax({
        url: '../BackEnd/Models/Company.php',
        type: 'POST',
        data: { action: 'fetchOneJob', JobID: jobId },
        success: function(jobData) { 
            console.log(jobData);
            $('#jobId').val(jobData.JOB_ID);
            $('#jobType').val(jobData.TYPE);
            $('#description').val(jobData.DESCRIPTION);
        },
        error: function() {
            console.log('Error fetching job data');
        }
    });

    // Handle form submission for job update
    $('#job-edit-form').on('submit', function(e) {
        e.preventDefault();
        var updatedJobData = $(this).serialize();
        updatedJobData += '&action=UpdateJob';
        updatedJobData += '&jobID=' + jobId;

        $.ajax({
            url: '../BackEnd/Models/Company.php',
            type: 'POST',
            data: updatedJobData,
            success: function(response) {
                console.log('Job updated successfully');
                alert("Job Updated Successfully");
                window.location.href = 'ViewJobs.php'; // Redirect after update
            },
            error: function() {
                console.log('Error updating job');
            }
        });
    });

    // Handle job deletion
    $('#delete-job').on('click', function() {
        var confirmation = confirm("Are you sure you want to delete this job?");
        console.log(jobId+' it is i=this:');
        if (confirmation) {
            $.ajax({
                url: '../BackEnd/Models/Company.php',
                type: 'POST',
                data: { action: 'DeleteJob', jobID: jobId },
                success: function(response) {
                    console.log('Job deleted successfully '+jobId);
                    alert("Job Deleted Successfully");
                    window.location.href = 'ViewJobs.php'; // Redirect after delete
                },
                error: function() {
                    console.log('Error deleting job');
                }
            });
        }
    });
});


</script>
</script>
</html>
