<?php   

require_once'../BackEnd/Common/Setup.php';
session_start();
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
    <style> 
    table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    text-align: left;
    padding: 8px;
    border-bottom: 1px solid #ddd;
}

.th {
    background-color: #f2f2f2;
}


.Delete {
  background-color: red; 
  font-size: 0.7em;  
  border-radius: 5px;"
}
</style>
    <?php  CommonFuncs(true);  ?>

  
</head>

<body>
   
<?php    preloader();  headerTop($useRelativePath=true);   ?>


<table id="requestsTable">
    <thead>
        <tr>
            <th class='th'>Request ID:</th>
            <th class='th'>Student email:</th>
            <th class='th'>Student Name:</th>
            <th class='th'>Request Type: </th>
            <th class='th'>Comment:</th>
            <th class='th'>Attachment: </th>
            <th class='th'>Response: </th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
    
   
    
    
    
    
    <div id ='hiddenId' data-userid="<?php echo$_SESSION['user_id'];?>"></div>

 
    <?php   footer(true,true); ?>
                
<?php JSfunctions(true); ?>    
</body>
<script>

function openResponsePage(url) {
    // Open a new page with the provided URL
    window.open(url, '_blank');
}

       function openAttachment(attachmentLocation) {
            // Open a new tab with the location of the file
            window.open(attachmentLocation, '_blank');
        }
    $(document).ready(function () {
        // Fetch data when the page is loaded
        fetchAllRequests();

        function fetchAllRequests() {
            // Use jQuery to send an AJAX request
            $.ajax({
                type: 'POST',
                url: '../BackEnd/Models/department.php', // Replace with the actual server script URL
                data: { action: 'fetchAllRequests' }, // Add any additional data if needed
                dataType: 'json',
                success: function (response) {
                    // Populate the table with the received data
                    populateTable(response);
                },
                error: function (error) {
                    console.error('Error fetching requests:', error);
                }
            });
        }
     

        function populateTable(requests) {
    // Clear existing rows
    $('#requestsTable tbody').empty();

    // Iterate through the requests and append rows to the table
    requests.forEach(function (request) {
        var row = '<tr>' +
            '<td>' + request.REQ_ID + '</td>' +
            '<td>' + request.EMAIL + '</td>' +
            '<td>' + request.FIRST_NAME+' '+request.LAST_NAME + '</td>' +
            '<td>' + request.REQUEST_NAME + '</td>' +
            '<td>' + request.COMMENTS + '</td>' +
            '<td><button onclick="openAttachment(\'' + request.ATTACHMENTS + '\')">Open</button></td>' +
            '<td><button onclick="openResponsePage(\'singleReq.php?req_id=' + request.REQ_ID + '\')">Open Response Page</button></td>' +


            '</tr>';

        $('#requestsTable tbody').append(row);

        console.log(request.ATTACHMENTS);
    });
}

     
    
    });
</script>
</html>


