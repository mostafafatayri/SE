<?php

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
require_once "../Common/Setup.php";
session_start();





class CompanyController
{
    private $conn;

    public function __construct()
    {
        $this->conn = dbConnect();
    

    }
  

  //
   public function UpdateProfile($userID, $web, $Interests, $Phone_Numb, $imagePath ) {
    $query = "UPDATE COMPANIES SET BIOGRAPHY='$Interests', WEBSITE_LINK='$web' , PHONE_NUMB ='$Phone_Numb' ";
    
    if ($imagePath !== null) {
        $query .= ", PROFILE_PIC='$imagePath'";
    }

    $query .= " WHERE COMPANY_ID='$userID'";

    $stmt = $this->conn->prepare($query);
    echo $query;
    $stmt->execute();


}

  //

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

        $sql = "SELECT * FROM `COMPANIES` WHERE USERNAME = '$email' AND $condition";
        echo $sql;
        $st = $this->conn->prepare($sql);
        $st->execute();
        $row_count = $st->rowCount();
      //  echo $row_count;


        if ($row_count > 0) {
        
        
            $getUser = "SELECT * FROM `COMPANIES` WHERE USERNAME='$email' ";
            $getUserST = $this->conn->prepare($getUser);
            $getUserST->execute();
            $userData = $getUserST->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['user_id'] = $userData['COMPANY_ID'];
            $_SESSION['first_name'] = $userData['LEGAL_NAME'];
            $_SESSION['websiteLink'] = $userData['WEBSITE_LINK'];
            $_SESSION['email'] = $userData['USERNAME'];
            //$_SESSION['PhoneNumber'] = $userData["PHONE_NUMB"];
            $_SESSION['ProfilePic'] = $userData["PROFILE_PIC"];
         
        
        
    
        
            $_SESSION['IS_LOGGED'] = TRUE;
            $_SESSION['IS_Company'] = TRUE;
         //   $_SESSION['email'] = $userData["USERNAME"];
            $_SESSION['LAST_ACTIVITY_Customer'] = time();
        
            $_SESSION['Role'] = 99;
        
            
        } else {
           // header('Location: ../index.php');
            return false;
        }
        
    }
   function SignUp($username, $legalName, $password, $link, $actual ){

             $query = "INSERT INTO `COMPANIES`
             (`LEGAL_NAME`, `LEGAL_DOCS`, `ISVERIFIED`, `CREATED_AT`, `WEBSITE_LINK`,`USERNAME`,`PASSWORD`) 
             VALUES ('$legalName','$actual',0,now(),' $link','$username',Password('$password'))
             
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

  
   public function getMyCompInfo($userID){

    $query = "SELECT `COMPANY_ID`, `LEGAL_NAME`, `PROFILE_PIC`, `BIOGRAPHY` AS INTERESTS, `LEGAL_DOCS`, `ISVERIFIED`, `CREATED_AT`, `WEBSITE_LINK`AS CV, `USERNAME`, `PHONE_NUMB`
    FROM `COMPANIES` WHERE COMPANY_ID='$userID'  ";

   
    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
    return $result;
}

function PostEvent($userID,$description,$type){
   

        $query = " INSERT INTO `JOBS`(`COMPANYID`, `DESCRIPTION`, `TYPE`, `POSTED_DATE`) 
        VALUES ('$userID','$description','$type',now());
        ";
     //   echo$query;
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($stmt->errorCode() != '00000') {
         echo "Error: " . $stmt->errorInfo()[2];
         return null;
        } else {
           return $requests;}


}
Function EditJob($JobId){

    $query="SELECT * FROM `JOBS` 
   
    
    WHERE JOB_ID='$JobId' ";


    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $requests = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($stmt->errorCode() != '00000') {
     echo "Error: " . $stmt->errorInfo()[2];
     return null;
    } else {
       return $requests;
    }


}

function updateJob($jobId,$description, $type)   {
    try {

        $sql = "UPDATE JOBS SET DESCRIPTION = :description, TYPE = :type WHERE JOB_ID = :jobId";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':jobId', $jobId);
        
      

        $stmt->execute();

        // Return some response or data
    } catch (PDOException $e) {
        echo'error';
    }



    

}


function DeleteJob($jobId) {
    try {
        $sql = "DELETE FROM `JOBS` WHERE JOB_ID = :jobId";
        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(':jobId', $jobId, PDO::PARAM_INT);

        $stmt->execute();

        // You might want to return true to indicate success
        return true;
    } catch (PDOException $e) {
        // It's better to log the error for debugging purposes
        // and return false or throw an exception
        error_log($e->getMessage());
        return false;
    }
}

Function getAllJobforOneCompany($id){

    $query="SELECT JOB_ID,COMPANYID,DESCRIPTION,TYPE,POSTED_DATE,LEGAL_NAME, PROFILE_PIC,USERNAME FROM `JOBS` 
    JOIN COMPANIES on JOBS.COMPANYID=COMPANIES.COMPANY_ID
    
    WHERE COMPANYID='$id' ";
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




}

$controller = new CompanyController();

$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {


   
    case 'fetchJobsForCompany':
        
        $id = $_POST['id'];
        
        $requests = $controller-> getAllJobforOneCompany($id);
        header('Content-Type: application/json');
        echo json_encode($requests);
        break;

    case 'DeleteJob':
        
        // $JobID = isset( $_POST[ 'JobID' ] ) ? $_POST[ 'JobID' ] : '';
 
 
        $jobId = $_POST['jobID'];
      

        $requests = $controller-> DeleteJob($jobId) ;
        
        break;
 
    

    case 'UpdateJob':
        
       // $JobID = isset( $_POST[ 'JobID' ] ) ? $_POST[ 'JobID' ] : '';


       $jobId = $_POST['jobID'];
       $type = $_POST['jobType'];
       $description = $_POST['description'];

       $requests = $controller-> updateJob($jobId   ,$description, $type) ;
       
       break;



    case 'fetchOneJob':
        
        $JobID = isset( $_POST[ 'JobID' ] ) ? $_POST[ 'JobID' ] : '';
        $requests = $controller->  EditJob($JobID);
        header('Content-Type: application/json');
        echo json_encode($requests);
        break;



    case 'PostJob':


        $userID = isset( $_POST[ 'userID' ] ) ? $_POST[ 'userID' ] : '';
        $type = isset( $_POST[ 'type' ] ) ? $_POST[ 'type' ] : '';
        $JobDesciption = isset( $_POST[ 'JobDesciption' ] ) ? $_POST[ 'JobDesciption' ] : '';   
       

        $test = $controller->PostEvent($userID,$JobDesciption,$type);
        break ;

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
  
    case 'SignUp':
     

                session_start(); 
                // Collect other form data
                $username = $_POST['username'];
                $legalName = $_POST['legalName'];
                $password = $_POST['password'];
                $link = $_POST['link'];
                $fileContent = isset($_POST['fileContent']) ? $_POST['fileContent'] : null;
                $filePath = ''; 
                if ($fileContent) {
                $fileContent = base64_decode($fileContent);
                $fileName = uniqid() . '.docx';
                $uploadDir = '../CompanyDocs/';
                file_put_contents($uploadDir . $fileName, $fileContent);
                $filePath = $uploadDir . $fileName;
                $actual='../BackEnd/CompanyDocs/'.$fileName;
             //   echo  $actual;
            }
                $test = $controller->SignUp($username, $legalName, $password, $link, $actual ?? null);

                $response = ['status' => 'success', 'message' => 'User signed up successfully'];
                echo json_encode($response);
            
    

        break ;

   
    case 'UsersInfo':
       
        $userID = isset( $_POST[ 'id' ] ) ? $_POST[ 'id' ] : '';
       $test= $controller-> getMyCompInfo($userID);
        echo json_encode($test); 

      
      
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




