<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once "../Common/Setup.php";
session_start();





class UserController
{
    private $conn;

    public function __construct()
    {
        $this->conn = dbConnect();
    

    }
  

    public function getMyInfo($userID){
        $query = "SELECT First_Name,Last_Name,Email,DATE_OF_BIRTH,PHONE_NUMB,INTERESTS , CV,PROFILE_PIC FROM  USER  Where USERID='$userID' ";
    
       
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
      
        return $result;
    }

    //secure
    public function UpdateProfile($userID, $cv, $Interests, $Phone_Numb, $imagePath) {
        try {
            $query = "UPDATE User SET INTERESTS = :Interests, CV = :cv, PHONE_NUMB = :Phone_Numb";
            $params = [
                ':Interests' => $Interests, 
                ':cv' => $cv, 
                ':Phone_Numb' => $Phone_Numb, 
                ':userID' => $userID
            ];
    
            if ($imagePath !== null) {
                $query .= ", PROFILE_PIC = :imagePath";
                $params[':imagePath'] = $imagePath;
            }
    
            $query .= " WHERE UserID = :userID";
            $stmt = $this->conn->prepare($query);
    
            foreach ($params as $key => &$val) {
                $stmt->bindParam($key, $val);
            }
    
            $stmt->execute();
            echo "Query executed successfully."; // For debugging
        } catch (PDOException $e) {
            error_log("PDOException in UpdateProfile: " . $e->getMessage());
            echo "An error occurred: " . $e->getMessage(); // For debugging
        }
    }
    

//secure 
    public function logout(){
        session_start();
        $sess = filter_input(INPUT_POST, 'sessionId', FILTER_SANITIZE_STRING);
        $_SESSION = array();
        session_destroy();
        echo"destroyed";
        ob_start();
      //  header('Location: ../index.php');
        ob_end_flush();
    }
    //is responsible for loggin in for the account 
    public function Loggin($email,$condition){

        $sql = "SELECT * FROM USER WHERE email = '$email' AND $condition";
       // echo $sql;
        $st = $this->conn->prepare($sql);
        $st->execute();
        $row_count = $st->rowCount();
      //  echo $row_count;


        if ($row_count > 0) {
        
        
            $getUser = "SELECT * FROM USER WHERE EMAIL='$email' ";
            $getUserST = $this->conn->prepare($getUser);
            $getUserST->execute();
            $userData = $getUserST->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['user_id'] = $userData['USERID'];
            $_SESSION['email'] = $userData['EMAIL'];
            $_SESSION['first_name'] = $userData['FIRST_NAME'];
            $_SESSION['last_name'] = $userData['LAST_NAME'];
            $_SESSION['Birthdate'] = $userData['DATE_OF_BIRTH'];
            $_SESSION['PhoneNumber'] = $userData["PHONE_NUMB"];
            $_SESSION['ProfilePic'] = $userData["PROFILE_PIC"];
         
        
        
    
        
            $_SESSION['IS_LOGGED'] = TRUE;
            $_SESSION['Role'] = $userData["ROLE"];
            $_SESSION['LAST_ACTIVITY_Customer'] = time();
        
           
        
            
        } else {
           header('Location: ../index.php');
            return false;
        }
        
    }
   

// secure 
    function FetchAllHistoryRequests($userID) {
        $query = "SELECT * FROM `REQUESTS` WHERE SOURCE_ID = '$userID' and REQUEST>-1;";
    
        $stmt = $this->conn->prepare($query);
    
        // Execute the query
        $stmt->execute();
    //echo$query;
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
//  secure 
    function FetchAllCurrentRequests($userID) {

        try {
            // Prepare the query with a placeholder for the user ID
            $query = "SELECT * FROM `REQUESTS` WHERE SOURCE_ID = :userID AND REQUEST = -1";
            $stmt = $this->conn->prepare($query);
    
            // Bind the user ID parameter
            $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch the results
            $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $requests;
        } catch (PDOException $e) {
            // Handle exceptions such as database connection errors
            // Log error and return a generic error message
            error_log($e->getMessage());
            return null;
        }




    }
    
   
    //secure
    function FetchEventInfo($eventID) {
        try {
            // Prepare the query with a placeholder for the event ID
            $query = "SELECT * FROM `EVENTS` WHERE EVENT_ID = :eventID";
            $stmt = $this->conn->prepare($query);
    
            // Bind the event ID parameter
            $stmt->bindParam(':eventID', $eventID, PDO::PARAM_INT);
    
            // Execute the query
            $stmt->execute();
    
            // Fetch the results
            $eventInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $eventInfo;
        } catch (PDOException $e) {
            // Handle exceptions such as database connection errors
            // Log error and return a generic error message
            error_log($e->getMessage());
            return null;
        }
    }
    


    //secure 
    function Register($eventID, $userID) {
        // Check if the registration date has not passed
        $dateCheckQuery = "SELECT `CLOSE_REG_AT`, `SIZE` FROM `Events` WHERE `EVENT_ID` = ?";
        $dateCheckStmt = $this->conn->prepare($dateCheckQuery);
        $dateCheckStmt->execute([$eventID]);
        $eventData = $dateCheckStmt->fetch(PDO::FETCH_ASSOC);
    
        if (!$eventData || new DateTime() > new DateTime($eventData['CLOSE_REG_AT'])) {
            // Registration date has passed or event not found
            return json_encode(['status' => 'error', 'message' => 'Registration is closed for this event']);
        }
    
        if ($eventData['SIZE'] <= 0) {
            // Event is full
            return json_encode(['status' => 'error', 'message' => 'Event is full']);
        }
    
        // Check if the user is already registered for the event
        $checkQuery = "SELECT * FROM `EVENT_PARTICIPATES` WHERE `USER_ID` = ? AND `EVENT_ID` = ?";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->execute([$userID, $eventID]);
    
        if ($checkStmt->rowCount() > 0) {
            // User is already registered
            return json_encode(['status' => 'error', 'message' => 'User is already registered for this event']);
        }
    
        // If not registered, proceed with the insertion
        $query = "INSERT INTO `EVENT_PARTICIPATES`(`USER_ID`, `EVENT_ID`) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
    
        // Begin transaction
        $this->conn->beginTransaction();
    
        try {
            // Bind parameters and execute the query
            $stmt->execute([$userID, $eventID]);
    
            // Decrement the SIZE
            $decrementQuery = "UPDATE `Events` SET `SIZE` = `SIZE` - 1 WHERE `EVENT_ID` = ?";
            $decrementStmt = $this->conn->prepare($decrementQuery);
            $decrementStmt->execute([$eventID]);
    
            // Commit the transaction
            $this->conn->commit();
    
            return json_encode(['status' => 'success']);
        } catch (Exception $e) {
            // Rollback the transaction in case of error
            $this->conn->rollback();
            return json_encode(['status' => 'error', 'message' => 'Error during registration: ' . $e->getMessage()]);
        }
    }

    // secure
    Function getAllJob(){

        $query='SELECT JOB_ID,COMPANYID,DESCRIPTION,TYPE,POSTED_DATE,LEGAL_NAME, PROFILE_PIC,USERNAME FROM `JOBS` 
        JOIN COMPANIES on JOBS.COMPANYID=COMPANIES.COMPANY_ID
        
        WHERE 1;';
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($stmt->errorCode() != '00000') {
         echo "Error: " . $stmt->errorInfo()[2];
         return null;
        } else {
           return $requests;
        }


    }

    //secure 
    function ApplyJob($userid, $JobID) {
        try {
            // First, check if the user has already applied for the job
            $checkQuery = "SELECT COUNT(*) FROM `APPLY` WHERE `USERID` = :userid AND `JOB_ID` = :jobId";
            $checkStmt = $this->conn->prepare($checkQuery);
            $checkStmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            $checkStmt->bindParam(':jobId', $JobID, PDO::PARAM_INT);
            $checkStmt->execute();
    
            if ($checkStmt->fetchColumn() > 0) {
                // User has already applied
                return "You have already applied for this job.";
            }
    
            // Insert new application
            $insertQuery = "INSERT INTO `APPLY` (`USERID`, `JOB_ID`, `SEEN`) VALUES (:userid, :jobId, 0)";
            $insertStmt = $this->conn->prepare($insertQuery);
            $insertStmt->bindParam(':userid', $userid, PDO::PARAM_INT);
            $insertStmt->bindParam(':jobId', $JobID, PDO::PARAM_INT);
            $insertStmt->execute();
    
            return "Application successful.";
        } catch (PDOException $e) {
            // Log error and return a generic error message
            error_log($e->getMessage());
            return "An error occurred during the application process.";
        }
    }
    
    
    
    

}

$controller = new UserController();

$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {

   

    case 'applyForJob':

         $userid = isset( $_POST[ 'userId' ] ) ? $_POST[ 'userId' ] : '';
         $JobID = isset( $_POST[ 'jobID' ] ) ? $_POST[ 'jobID' ] : '';
         $requests = $controller->  ApplyJob( $userid ,  $JobID );
         header('Content-Type: application/json');
         echo json_encode($requests);
        break;


    case 'fetchJobs':
        
        $requests = $controller-> getAllJob();
        header('Content-Type: application/json');
        echo json_encode($requests);
        break;

    case'registerForEvent':

        $eventID = isset( $_POST[ 'eventID' ] ) ? $_POST[ 'eventID' ] : '';
        $userID = isset( $_POST[ 'userID' ] ) ? $_POST[ 'userID' ] : '';

        $requests = $controller->  Register($eventID,$userID);
        header('Content-Type: application/json');
        echo $requests;
        

        break;

     case 'fetchEvent':
        $eventID = isset( $_POST[ 'eventID' ] ) ? $_POST[ 'eventID' ] : '';

        $requests = $controller-> FetchEventInfo($eventID);
        header('Content-Type: application/json');
        echo json_encode($requests);
        break;

    case 'fetchEvent':
        $eventID = isset( $_POST[ 'eventID' ] ) ? $_POST[ 'eventID' ] : '';

        $requests = $controller-> FetchEventInfo($eventID);
        header('Content-Type: application/json');
        echo json_encode($requests);
        break;

    case 'fetchAllCurrentRequests':
        $userID = isset( $_POST[ 'UserID' ] ) ? $_POST[ 'UserID' ] : '';

        $requests = $controller-> FetchAllCurrentRequests($userID);
        header('Content-Type: application/json');
        echo json_encode($requests);
        break;


    case 'fetchAllHistoryRequests':
        $userID = isset( $_POST[ 'UserID' ] ) ? $_POST[ 'UserID' ] : '';

        $requests = $controller-> FetchAllHistoryRequests($userID);
        header('Content-Type: application/json');
        echo json_encode($requests);
        break;


    case 'UpdateData':

        $userID = isset( $_POST[ 'UserID' ] ) ? $_POST[ 'UserID' ] : '';
        $cv = isset( $_POST[ 'cv' ] ) ? $_POST[ 'cv' ] : '';
        $interset = isset( $_POST[ 'interset' ] ) ? $_POST[ 'interset' ] : '';   
        $number = isset( $_POST[ 'number' ] ) ? $_POST[ 'number' ] : '';
       

        if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
            // Handle file upload
            $fileTmpPath = $_FILES['profileImage']['tmp_name'];
            $fileName = $_FILES['profileImage']['name'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            echo'image is found';
            // Directory where you want to save the uploaded file
            $uploadFileDir = '../uploaded_images/';
            $dest_path = $uploadFileDir . $newFileName;

            $dest_pathFronOut = '../BackEnd/uploaded_images/' . $newFileName;
    
            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $imagePath =  $dest_pathFronOut; // This is the path you can store in DB
           echo"inside the if ";
           
           
            } else {
                // Handle error
            }
        }
    
        // Call your function with the additional image path parameter
        $test = $controller->UpdateProfile($userID, $cv, $interset, $number, $imagePath ?? null);
    



        break;

    case 'UsersInfo':
       
        $userID = isset( $_POST[ 'id' ] ) ? $_POST[ 'id' ] : '';
       $test= $controller->getMyInfo($userID);
        echo json_encode($test); 
 //echo'testtsts';
      
      
         break;
    
     case "Man-LogIN";

      $email = $_POST['username'];
      $pass = $_POST['password'];
      $condition = "password = Password('$pass')";
      $controller->Loggin($email,$condition);


        break;
     case "logout":
        $controller->logout();
        break;
     default:
        echo "Invalid action";
        break;
}





?>




