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
   
   

                <div class="col-lg-8">
                    <div class="teachers-right mt-50">
                        <ul class="nav nav-justified" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a id="reviews-tab" data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Add Request</a>
                            </li>
                        </ul> 
                         <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                                <div class="reviews-cont">
                                    <div class="title">
                                        <h6>Request : </h6>
                                    </div>
                                
                                    <div class="reviews-form">
                                       <!-- ... other HTML ... -->

<div class="reviews-form">
    <form id="requestForm"> <!-- Added an ID for the form -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-singel">
                    <label for='requestName'> Request Name : </label>
                    <input type="text" id="requestName" placeholder="Title">
                </div>
            </div>

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
        </div> <!-- row -->
    </form>
</div>

<!-- ... other HTML ... -->

                                    </div>
                                </div> <!-- reviews cont -->
                            </div>
                        </div> <!-- tab content -->
                    </div> <!-- teachers right -->
                </div>
     
    
    
    

    





















<div id ='hiddenId' data-userid="<?php echo$_SESSION['user_id'];?>"></div>

<?php footer(true,true); ?>           
<?php JSfunctions(true); ?>    



</body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#postEventButton').click(function() {
        var userID = $('#hiddenId').data('userid');
        var requestName = $('#requestName').val();
        var description = $('#description').val();

        if (!requestName || !description) {
            alert('Please fill all fields.');
            return;
        }
        console.log(requestName);
        console.log(description);

        $.ajax({
            url: '../BackEnd/Models/Department.php', // URL to your PHP script
            type: 'POST',
            data: {
                action: 'PostRequest',
                userID: userID,
                requestName: requestName,
                RequesttDesciption: description,
                // Add other data parameters as needed
            },
            success: function(response) {
                alert('Request posted successfully.');
                console.log(response);
                // Optionally, refresh page or update UI
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error posting request.');
                console.log(textStatus, errorThrown);
            }
        });
    });
});
</script>


 



</html>








