<?php
// Uncomment these lines for debugging during development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "../Common/Setup.php";
session_start();

class UserControllerDepartment {
    private $conn;

    public function __construct() {
        $this->conn = dbConnect();
    }
//secure
    function PostEvent($userID, $eventTitle, $eventDes, $eventTime, $eventTimeEndDate, $imagePath, $eventSize, $eventTimeEnd,  $eventLocation ) {
        $query = "INSERT INTO `EVENTS` (`EVENT_TITLE`, `EVENT_DESC`, `EVENT_DATE`, `END_TIME`, `IMAGES`, `CREATED_AT`, `SIZE`,`LOCATION` ,`CLOSE_REG_AT`, `CREATED_BY`) VALUES (?, ?, ?, ?, ?, NOW(), ?,?, ?, ?)";
    
        $stmt = $this->conn->prepare($query);
    
        // With PDO, you can pass parameters directly to execute
        $stmt->execute([$eventTitle, $eventDes, $eventTime, $eventTimeEndDate, $imagePath, $eventSize, $eventLocation  ,$eventTimeEnd, $userID]);
    
        // Check for errors
        if ($stmt->errorCode() != '00000') {
            echo "Error: " . $stmt->errorInfo()[2];
        } else {
            echo "Event posted successfully.";
        }
    }
    //secure
    function FetchUpcomingEvents() {
        $query = "SELECT * FROM `EVENTS` WHERE `EVENT_DATE` >= CURDATE()";
    
        $stmt = $this->conn->prepare($query);
    
        // Execute the query
        $stmt->execute();
    
        // Fetch the results
        $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        if ($stmt->errorCode() != '00000') {
            echo "Error: " . $stmt->errorInfo()[2];
            return null;
        } else {
            return $events;
        }
    }
    //secure
   function  PostRequestType($requestName,$RequesttDesciption  ){

    $query = "INSERT INTO `REQUEST_TYPE` (REQUEST_NAME,DESCRIPTION) VALUES (?, ? )";
    
    $stmt = $this->conn->prepare($query);

    // With PDO, you can pass parameters directly to execute
    $stmt->execute([$requestName,$RequesttDesciption  ]);

    // Check for errors
    if ($stmt->errorCode() != '00000') {
        echo "Error: " . $stmt->errorInfo()[2];
    } else {
        echo "Request posted successfully.";
    }



    }


    //secure
    function MakeRequest($description, $selectedOption, $uniqueFilename, $userID) {
       try {
          
          //  echo$description.'  ',   $selectedOption.' '.$uniqueFilename.' '. $userID;
            
            $query = "INSERT INTO `requests` (`source_id`, `type_id`, `comments`, `attachments`) 
                      VALUES (?,?,?,?)";
    
            $stmt = $this->conn->prepare($query);
    
            if (!$stmt->execute([$userID, $selectedOption, $description, $uniqueFilename])) {
                error_log("Database error: " . implode(", ", $stmt->errorInfo()));
                echo'errorr ma fee';
                return "An error occurred while processing your request. Please try again later.";
            }
    
            return "Request posted successfully.";
        } catch (PDOException $e) {
            error_log("PDOException: " . $e->getMessage());
            return "An error occurred while processing your request. Please try again later.";
        }
    }
    
    
//secure
    function FetchForAllCurrentRequests() {
        $query = "SELECT  REQ_ID,REQUEST,CREATED_ID,
        STATE,COMMENTS,ATTACHMENTS,USER.FIRST_NAME
        ,USER.LAST_NAME,USER.EMAIL,REQUEST_TYPE.REQUEST_NAME 
        FROM `REQUESTS` 
        JOIN USER on USER.USERID=REQUESTS.SOURCE_ID
        JOIN REQUEST_TYPE on REQUEST_TYPE.TYPE_ID=REQUESTS.TYPE_ID
        WHERE REQUEST=-1;
        ";
    
        $stmt = $this->conn->prepare($query);
    
        // Execute the query
        $stmt->execute();
    
        // Fetch the results
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Check for errors
        if ($stmt->errorCode() != '00000') {
            echo "Error: " . $stmt->errorInfo()[2];
            return null;
        } else {
            return $requests;
        }
    }
//secure
    function FetchCompanyForVerify() {
        $query = "
        SELECT * FROM `COMPANIES` WHERE ISVERIFIED=0;
        ";
    
        $stmt = $this->conn->prepare($query);
    
        // Execute the query
        $stmt->execute();
    
        // Fetch the results
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Check for errors
        if ($stmt->errorCode() != '00000') {
            echo "Error: " . $stmt->errorInfo()[2];
            return null;
        } else {
            return $requests;
        }
    }


function FetchUserReq($reqID) {

    $query = "SELECT * FROM `REQUESTS` 
    JOIN USER on USER.USERID = REQUESTS.SOURCE_ID
    WHERE REQUESTS.REQ_ID='$reqID';
    ";


    $stmt = $this->conn->prepare($query);

    // Execute the query
    $stmt->execute();

    // Fetch the results
    $requests = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check for errors
    if ($stmt->errorCode() != '00000') {
        echo "Error: " . $stmt->errorInfo()[2];
        return null;
    } else {
     

        return $requests;
    }
}

function postResponse($reqID,$description,$Response){

    try {
       

        $query = "  UPDATE `REQUESTS` SET `REQUEST`='$Response',`STATE`='1',`RESPONSE`='$description'
        
         WHERE REQ_ID='$reqID';
        
        ";

        $stmt = $this->conn->prepare($query);

        // With PDO, you can pass parameters directly to execute
        $stmt->execute();

        // Check for errors
        if ($stmt->errorCode() != '00000') {
            // Log the error (you can implement your own logging mechanism)
            error_log("Database error: " . $stmt->errorInfo()[2]);

            // Provide a user-friendly error message
            echo "An error occurred while processing your request. Please try again later.";
        } else {
            echo "Request posted successfully.";
        }
    } catch (PDOException $e) {
        // Handle exceptions (e.g., database connection issues)
        // Log the exception (you can implement your own logging mechanism)
        error_log("PDOException: " . $e->getMessage());

        // Provide a user-friendly error message
        echo "An error occurred while processing your request. Please try again later.";
    }


}

function VerifyACompany($CompID) {
    $query = "UPDATE `COMPANIES` SET `ISVERIFIED`=1 WHERE `COMPANY_ID`='$CompID';";

    $stmt = $this->conn->prepare($query);

    // Execute the query
    $stmt->execute();

    // Check for errors
    if ($stmt->errorCode() != '00000') {
       
        echo "Error: " . $stmt->errorInfo()[2];
        return null;
    } else {
       
        return true; // Assuming you want to return a boolean indicating success
    }
}


function sendMail($CompID,$state){
    $query = "SELECT * FROM `COMPANIES` WHERE COMPANY_ID='$CompID' ";
    
    $stmt = $this->conn->prepare($query);

    // Execute the query
    $stmt->execute();

    $requests = $stmt->fetch(PDO::FETCH_ASSOC);

    // For debugging, you can use var_dump or print_r
   // print_r(  $requests);

    // Access individual elements of the array
 //   echo 'Legal Name: ' . $requests['LEGAL_NAME'];

    $legalName=$requests['LEGAL_NAME'];
    $email=$requests['USERNAME'];

    if($state=='Yes')
    {
    $to = $email;
    $subject = "Verification Completed ";
    $message = "Hello " .   $legalName . ",\n\n" .
        "Thank you for signing up for our website. This is to inform you that you have been accepted and granted the access to our system to post jobs for out student. " .
        "Please enter you account and prepare you profile to be visible for the users and to start posting jobs . \n\n" .
        "Call us at 79126133 if any help needed.\n\n" .
        "Best regards,\n" .
        "Mostafa fatayri \n\nCTO of Equalizers\n\nCEO and Founder of Fatayri Group";

    $headers = "From: equalizers@support.com";

  //  echo" accepted going";
    }
    else {
        $to = $email;
        $subject = "Verification Rejected ";
        $message = "Hello " .   $legalName . ",\n\n" .
            "Thank you for signing up for our website. This is to inform you that you have been Rejected  and you will not be granted the access to our system to post jobs for out student. " .
            "But dont worry , you can still apply to our system and modify so that u can be verified later on . \n\n" .
            "Call us at 79126133 if any help needed.\n\n" .
            "Best regards,\n" .
            "Mostafa fatayri \n\nCTO of Equalizers\n\nCEO and Founder of Fatayri Group";
    
        $headers = "From: equalizers@support.com";
    
      // echo"rejection going";

    }




  if(mail($to, $subject, $message, $headers)){

  //  echo"\nrecieved";
  }
   else {
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
   }

   }

   function RejectACompany($CompID) {
    $query = "UPDATE `COMPANIES` SET `ISVERIFIED`=-1 WHERE `COMPANY_ID`='$CompID';";

    $stmt = $this->conn->prepare($query);

    // Execute the query
    $stmt->execute();

    // Check for errors
    if ($stmt->errorCode() != '00000') {
       
        echo "Error: " . $stmt->errorInfo()[2];
        return null;
    } else {
       
        return true; // Assuming you want to return a boolean indicating success
    }
}
/// activity check 
function Activity_Check($user_id, $activity) {
    // Assuming $this->conn is your database connection
    $query = "UPDATE COMPANIES SET ISVERIFIED = '$activity' WHERE COMPANY_ID = '$user_id'  ";
    
    // Prepare the statement
    $stmt = $this->conn->prepare($query);
echo  $query;
    // Check if the statement preparation was successful
    if (!$stmt) {
        echo "Error in preparing the statement: " . $this->conn->error;
        return false;
    }

  
    // Execute the query
    $stmt->execute();

    // Check for errors
    if ($stmt->errno) {
        echo "Error executing the query: " . $stmt->error;
        return false;
    } else {
        // Assuming you want to return a boolean indicating success
        return true;
    }
}

//secure 
function FetchAllRequestsType() {
    $query = "SELECT * FROM `REQUEST_TYPE`";

    $stmt = $this->conn->prepare($query);

    // Execute the query
    $stmt->execute();

    // Fetch the results
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check for errors
    if ($stmt->errorCode() != '00000') {
        echo "Error: " . $stmt->errorInfo()[2];
        return null;
    } else {
        return $requests;
    }

    
}

function UpdateEvent( $eventID, $eventTitle, $eventDesc, $eventDate, $eventTimeEndDate, $imagePath, $eventSize, $eventTimeEnd, $eventLocation, $closeRegAt) {
    // SQL query to update the event
    $sql = "UPDATE EVENTS SET EVENT_TITLE = ?, EVENT_DESC = ?, EVENT_DATE = ?, END_TIME = ?, SIZE = ?, LOCATION = ?, CLOSE_REG_AT = ?" 
        . (is_null($imagePath) ? "" : ", IMAGES = ?")
        . " WHERE EVENT_ID = ?";

    // Prepare the statement
    $stmt = $this->conn->prepare($sql);

    // Bind parameters
    $params = [$eventTitle, $eventDesc, $eventDate, $eventTimeEndDate, $eventSize, $eventLocation, $closeRegAt];
    if (!is_null($imagePath)) {
        $params[] = $imagePath;
    }
    $params[] = $eventID;

    // Execute the statement with the parameters
    if ($stmt->execute($params)) {
        echo "Event updated successfully";
    } else {
        echo "Error: " . $stmt->errorInfo()[2]; // Get error info from PDO
    }

    // No need to close the statement in PDO
}

function DeleteEvent($eventID){
    $sql="DELETE FROM `EVENTS` WHERE EVENT_ID='$eventID'  ";

    $stmt = $this->conn->prepare($sql);

    // Execute the query
    $stmt->execute();

    // Fetch the results
    $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Check for errors
    if ($stmt->errorCode() != '00000') {
        echo "Error: " . $stmt->errorInfo()[2];
        return null;
    } else {
        return $requests;
    }

}






}

$controller = new UserControllerDepartment();
$action = isset($_POST['action']) ? $_POST['action'] : '';
//echo$action ;

switch ($action) {

    case 'deleteEvent':
        $eventID = isset($_POST['eventID']) ? $_POST['eventID'] : '';

        $requests = $controller-> DeleteEvent($eventID);
        header('Content-Type: application/json');
        echo json_encode($requests);
        break;
        break;

    case 'updateEvent':
        // Echo for testing purposes
        echo 'Received request for updating event.';
    
        // Retrieving text data sent via AJAX
        $eventID = isset($_POST['eventID']) ? $_POST['eventID'] : '';
        $eventTitle = isset($_POST['eventTitle']) ? $_POST['eventTitle'] : '';
        $eventLocation = isset($_POST['eventLocation']) ? $_POST['eventLocation'] : '';
        $eventTime = isset($_POST['eventTime']) ? $_POST['eventTime'] : '';
        $eventTimeEnd = isset($_POST['eventTimeEnd']) ? $_POST['eventTimeEnd'] : '';
        $eventTimeEndDate = isset($_POST['eventTimeEndDate']) ? $_POST['eventTimeEndDate'] : '';
        $eventSize = isset($_POST['eventSize']) ? $_POST['eventSize'] : '';
        $description = isset($_POST['description']) ? $_POST['description'] : '';
        $image =  null;
        // Handling file upload (if present)
        if (isset($_FILES['eventImage']) && $_FILES['eventImage']['error'] == 0) {
            // File upload logic goes here
            $fileTmpPath = $_FILES['eventImage']['tmp_name'];
            $fileName = $_FILES['eventImage']['name'];
            // Perform file validation and move the file to the desired directory
            // You may also want to rename the file or handle overwriting
    
            // Example: moving the file to a directory
            $uploadFileDir = '../eventImages/'; // Set your upload directory
            $destFilePath = $uploadFileDir . $fileName;
            $dest_pathFronOut = '../BackEnd/eventImages/' . $fileName;

    
            if(move_uploaded_file($fileTmpPath, $destFilePath)) {
                $image =  $dest_pathFronOut ;
                echo 'File is successfully uploaded.';
            } else {
                echo 'There was some error moving the file to upload directory.';
            }
        }
    

        if ($eventID && $eventTitle && $eventTime && $eventTimeEnd && $eventSize) {
            $eventTimeEndDate = $_POST['eventTimeEndDate'] ?? ''; // Assuming this is optional
            $controller->  UpdateEvent($eventID, $eventTitle, $description, $eventTime, $eventTimeEndDate, $image, $eventSize, $eventTimeEnd, $eventLocation,  $eventTimeEnd) ;
        } else {
            echo "Missing required fields";
        }
    
        break;
    

    /// here 
    case 'fetchAllTypes':
       // echo'heelllo';
        
        $requests = $controller->FetchAllRequestsType();
        header('Content-Type: application/json');
        echo json_encode($requests);
        break;

    case 'User_activity':
        $CompID = isset( $_POST[ 'user_id' ] ) ? $_POST[ 'user_id' ] : ''; 
        $activity = isset( $_POST[ 'activity' ] ) ? $_POST[ 'activity' ] : ''; 
        $requests = $controller->Activity_Check($CompID,$activity);
  
        header('Content-Type: application/json');
        echo json_encode($requests);
        //echo'check in';
        break;

    case 'RejectIT':
        $CompID = isset( $_POST[ 'companyId' ] ) ? $_POST[ 'companyId' ] : '';
        $requests = $controller-> RejectACompany($CompID) ;
        $mail = $controller->  sendMail($CompID,'no');
       header('Content-Type: application/json');
        echo json_encode($requests);
        //echo'check in';
        break;


    case 'VerifyIT':
         $CompID = isset( $_POST[ 'companyId' ] ) ? $_POST[ 'companyId' ] : '';
         $requests = $controller-> VerifyACompany($CompID) ;
         $mail = $controller->  sendMail($CompID,'yes');
         header('Content-Type: application/json');
         echo json_encode($requests);
         //echo'check in';
         break;

    case 'newCompanies':
        /// $userID = isset( $_POST[ 'UserID' ] ) ? $_POST[ 'UserID' ] : '';
         $requests = $controller-> FetchCompanyForVerify() ;
         header('Content-Type: application/json');
         echo json_encode($requests);
         break;
 

         
         
    case 'PostResponse':
    $ReqID = isset( $_POST[ 'ReqID' ] ) ? $_POST[ 'ReqID' ] : '';
    $Response = isset( $_POST[ 'Response' ] ) ? $_POST[ 'Response' ] : '';
    $Description = isset( $_POST[ 'Description' ] ) ? $_POST[ 'Description' ] : '';

    $requests = $controller-> postResponse($ReqID,$Description,$Response);
        break ;
    case 'UserReq':

         $ReqID = isset( $_POST[ 'ReqID' ] ) ? $_POST[ 'ReqID' ] : '';
         $requests = $controller-> FetchUserReq($ReqID);
         header('Content-Type: application/json');
         echo json_encode($requests);
         
        // echo'test from be';
         break;
 
 
 

    case 'fetchAllRequests':
       /// $userID = isset( $_POST[ 'UserID' ] ) ? $_POST[ 'UserID' ] : '';
        $requests = $controller-> FetchForAllCurrentRequests() ;
        header('Content-Type: application/json');
        echo json_encode($requests);
        break;




/// here 
case 'submitRequest':
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'submitRequest') {
        // Validate and sanitize input data
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING);
        $selectedOption = filter_input(INPUT_POST, 'selectedOption', FILTER_SANITIZE_STRING);
        $userID = filter_input(INPUT_POST, 'userID', FILTER_VALIDATE_INT);

        // Create attachments directory if it doesn't exist
        $attachmentsDirectory = '../attachments';
        if (!file_exists($attachmentsDirectory)) {
            mkdir($attachmentsDirectory, 0777, true);
        }

        $uniqueFilename = null;
        if (!empty($_FILES['attachments'])) {
            foreach ($_FILES['attachments']['name'] as $index => $filename) {
                // File type and size validation (pseudo-code)
                // if (invalid file type or size) {
                //     echo json_encode(['error' => 'Invalid file type or size']);
                //     exit;
                // }

                $tempFile = $_FILES['attachments']['tmp_name'][$index];
                $timestamp = time();
                $uniqueFilename = $timestamp . '_' . basename($filename);
                $targetFile = $attachmentsDirectory . '/' . $uniqueFilename;

                if (!move_uploaded_file($tempFile, $targetFile)) {
                    echo json_encode(['error' => 'Error uploading file']);
                    exit;
                }
            }
        }

        // Call the MakeRequest function and handle the response
        $response = $controller->MakeRequest($description, $selectedOption, $uniqueFilename, $userID);
        echo json_encode(['message' => $response]);
    } else {
        echo json_encode(['error' => 'Invalid request']);
    }
    break;




    
    case 'PostRequest':
        
        $userID = $_POST['UserID'] ?? '';
        $requestName = $_POST['requestName'] ?? '';
        $RequesttDesciption = $_POST['RequesttDesciption'] ?? '';
      

     
      
        $controller->PostRequestType($requestName,$RequesttDesciption  );
     
       

        break;
    case 'fetchAllEvents':
        $events = $controller->FetchUpcomingEvents();
        header('Content-Type: application/json');
        echo json_encode($events);
     
        break;
    case 'PostEvent':
        
        $userID = $_POST['UserID'] ?? '';
        $eventTitle = $_POST['eventTitle'] ?? '';
        $eventDes = $_POST['eventDesciption'] ?? '';
        $eventTime = $_POST['eventTime'] ?? '';
        $eventTimeEnd = $_POST['eventTimeEnd'] ?? '';

        $eventLocation = $_POST['eventLocation'] ?? '';
        $eventSize = $_POST['eventSize'] ?? '';
        $imagePath = null;

        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = '../eventImages/';
            $dest_path = $uploadFileDir . $newFileName;
            $dest_pathFronOut = '../BackEnd/eventImages/' . $newFileName;

            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $imagePath = $dest_pathFronOut;
            } else {
                echo "Error in file upload";
            }
        }

        if ($userID && $eventTitle && $eventTime && $eventTimeEnd && $eventSize) {
            $eventTimeEndDate = $_POST['eventTimeEndDate'] ?? ''; // Assuming this is optional
            $controller->PostEvent($userID, $eventTitle, $eventDes, $eventTime, $eventTimeEndDate, $imagePath, $eventSize, $eventTimeEnd,  $eventLocation );
        } else {
            echo "Missing required fields";
        }

        break;

    default:
        echo "Invalid action";
        break;
}
?>
