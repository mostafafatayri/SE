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
  
    <style> 
    .verify-button {
    background-color: green;
    color: white;
}

.reject-button {
    background-color: red;
    color: white;
}

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
</head>

<body>
   
<?php    preloader();  headerTop($useRelativePath=true);   ?>
   
   

<table id="requestsTable">
    <thead>
        <tr>
            <th class='th'>Company ID:</th>
            <th class='th'>Email:</th>
            <th class='th'>Legal Name:</th>
            <th class='th'>Website link : </th>
            <th class='th'>Attachment: </th>
            <th class='th'>Response: </th>
            <th class='th'>Action: </th>

        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
    
    
    <br>
    <br>
    

<div id ='hiddenId' data-userid="<?php echo$_SESSION['user_id'];?>"></div>

<?php footer(true,true); ?>           
<?php JSfunctions(true); ?>    



</body>



<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your HTML and other code -->
<script>

// jQuery code here
$(document).ready(function () {
    // Make an AJAX request to fetch new companies
    $.ajax({
        url: '../BackEnd/Models/Department.php',
        type: 'POST',
        data: { action: 'newCompanies' },
        dataType: 'json',
        success: function (response) {
            // Process the response here
            console.log("New companies fetched successfully:", response);

            // Dynamically populate the table
            var tableBody = $('#requestsTable tbody');

            for (var i = 0; i < response.length; i++) {
                var company = response[i];

                var row = $('<tr></tr>');

                row.append('<td>' + company.COMPANY_ID + '</td>');
                row.append('<td>' + company.USERNAME + '</td>');
                row.append('<td>' + company.LEGAL_NAME + '</td>');
                row.append('<td>' + company.WEBSITE_LINK + '</td>');
                row.append('<td>' + (company.LEGAL_DOCS ? '<a href="' + company.LEGAL_DOCS + '" target="_blank">View Attachment</a>' : 'No Attachment') + '</td>');
                row.append('<td>' + (company.ISVERIFIED === "1" ? 'Verified' : 'Not Verified') + '</td>');

                var verifyButton = $('<button class="verify-button"></button>');
                verifyButton.text('Verify');
                verifyButton.click(function () {
                    // Make an AJAX request to handle verification
                    handleAction('VerifyIT', company.COMPANY_ID, 'Verification');
                });

                var rejectButton = $('<button class="reject-button"></button>');
                rejectButton.text('Reject');
                rejectButton.click(function () {
                    // Make an AJAX request to handle rejection
                    handleAction('RejectIT', company.COMPANY_ID, 'Rejection');
                });

                var actionCell = $('<td></td>');
                actionCell.append(verifyButton);
                actionCell.append(rejectButton);

                row.append(actionCell);

                tableBody.append(row);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.log('Error fetching new companies:', textStatus, errorThrown);
        }
    });

    function handleAction(actionType, companyId, actionName) {
        $.ajax({
            url: '../BackEnd/Models/Department.php',
            type: 'POST',
            data: { action: actionType, companyId: companyId },
            dataType: 'json',
            success: function (response) {
                alert(actionName + ' Successful');
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log('Error ' + actionType.toLowerCase() + 'ing company:', textStatus, errorThrown);
            }
        });
    }
});


</script>
</html>








