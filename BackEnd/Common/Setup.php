<?php



function CompanyUsers(){
    $conn =  dbConnect();
    $query = "SELECT `COMPANY_ID`, `LEGAL_NAME`, `PROFILE_PIC`, `BIOGRAPHY`, `LEGAL_DOCS`, `ISVERIFIED`, `CREATED_AT`, `WEBSITE_LINK`, `USERNAME`, `PASSWORD` FROM `COMPANIES` WHERE 1";
    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
 
    
 return $data;
 }


function AccessControll(){

    session_start();

    
    if ( $_SESSION[ 'Role' ] !=3) {
        header( 'Location: ../index.php' );
   
        
    }

  
}
function authenticationCustomers() {

    session_start();

    $timeout_duration = 3600;
    // 30 minutes in seconds
    if ( isset( $_SESSION[ 'LAST_ACTIVITY_Customer' ] ) && ( time() - $_SESSION[ 'LAST_ACTIVITY_Customer' ] ) > $timeout_duration ) {
        session_unset();
        session_destroy();
        header( 'Location: ../index.php' );
        // header( 'Location: LogIN.php?timeout=1' );
        // Redirect to login page with timeout message
    }

    if ( !isset( $_SESSION[ 'email' ] ) || !isset( $_SESSION[ 'first_name' ] ) || !isset( $_SESSION[ 'IS_LOGGED' ] ) ) {
        header( 'Location: login.php' );
        exit();
    }

}





function preloader(){
    ?>
     <div class="preloader">
        <div class="loader rubix-cube">
            <div class="layer layer-1"></div>
            <div class="layer layer-2"></div>
            <div class="layer layer-3 color-1"></div>
            <div class="layer layer-4"></div>
            <div class="layer layer-5"></div>
            <div class="layer layer-6"></div>
            <div class="layer layer-7"></div>
            <div class="layer layer-8"></div>
        </div>
    </div>
    <?php

}





function CommonFuncs($useRelativePath = true){
    $basePath = $useRelativePath ? "../" : "";

echo'


<!--====== Title ======-->
<title>LAU - CS Departmnt</title>

<!--====== Favicon Icon ======-->
<link rel="shortcut icon" href="'.$basePath.'images/logo.png" type="image/png">

<!--====== Slick css ======-->
<link rel="stylesheet" href="'.$basePath.'css/slick.css">

<!--====== Animate css ======-->
<link rel="stylesheet" href="'.$basePath.'css/animate.css">

<!--====== Nice Select css ======-->
<link rel="stylesheet" href="'.$basePath.'css/nice-select.css">

<!--====== Nice Number css ======-->
<link rel="stylesheet" href="'.$basePath.'css/jquery.nice-number.min.css">

<!--====== Magnific Popup css ======-->
<link rel="stylesheet" href="'.$basePath.'css/magnific-popup.css">

<!--====== Bootstrap css ======-->
<link rel="stylesheet" href="'.$basePath.'css/bootstrap.min.css">

<!--====== Fontawesome css ======-->
<link rel="stylesheet" href="'.$basePath.'css/font-awesome.min.css">

<!--====== Default css ======-->
<link rel="stylesheet" href="'.$basePath.'css/default.css">

<!--====== Style css ======-->
<link rel="stylesheet" href="'.$basePath.'css/style.css">

<!--====== Responsive css ======-->
<link rel="stylesheet" href="'.$basePath.'css/responsive.css">



';





}


function headerTop($useRelativePath = false) {
    // Determine the base path for images
    $imagesBasePath = $useRelativePath ? "../" : "";
    $useFrontEnd =  $useRelativePath ? "":"FrontEnd/" ;
    $useDefaultPath = $useRelativePath ?"../":"";

    session_start();
    $check=  isset($_SESSION['Role'])?$_SESSION['Role'] : '';

   $isCompany = isset($_SESSION['IS_Company'])? $_SESSION['IS_Company']:false;


    $value = false;
    if ($check==3){
        $value=true;
    }
    $add = ' 
    <ul class="sub-menu">
    <li><a  href="'.$useFrontEnd.'createEvent.php">Create Event</a></li>
    <li><a href="'.$useFrontEnd.'index-3.html">View Participants</a></li>
    </ul>
    ';

    $VerifyCompanies = ' 
    <li class="nav-item">
      <a  href="'.$useFrontEnd.'ViewComp.php">View Companies</a>
        <ul class="sub-menu">
           <li><a class="active" href="'.$useFrontEnd.'verify.php">Verify</a></li>
          
         </ul>

    </li>
   
    ';

    $Requests = ' 
    
        <ul class="sub-menu">
           <li><a class="active" href="'.$useFrontEnd.'createRequest.php">Add new request</a></li>
           <li><a href="'.$useFrontEnd.'ViewAllRequest.php">View Requests</a></li>
         </ul>

    
    ';
    $event = $value?$add:" ";

    $company = $value? $VerifyCompanies:"";



    $RequestsValue = $value? $Requests:"";
   


    $uni = '
    <div class="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="active" href="'.$useDefaultPath.'index.php">Home</a>
                               
                            </li>
                            <li class="nav-item">
                                <a href="'.$useFrontEnd .'about.php">About us</a>
                            </li>
                          
                            <li class="nav-item">
                            <a href="'.$useFrontEnd .'events.php">Events</a>'.$event.'

                           </li>
                            <li class="nav-item">
                                <a href="'.$useFrontEnd .'requests.php">Requests</a>'.$RequestsValue.'
                               
                            </li>
                            <li class="nav-item">
                                <a href="'.$useFrontEnd .'blog.html">Blog</a>
                                
                            </li>
                           
                            <li class="nav-item">
                                <a href="'.$useFrontEnd .'ViewAllJobs.php">Job Market</a>
                                
                            </li>'. $company .'

                       

                        <li class="nav-item">
                        <a href="'.$useFrontEnd .'account.php">Profile</a>
                        
                        </li>


                        </ul>
                    </div>
                </nav> <!-- nav -->
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                <div class="right-icon text-right">
                    <ul>
                        <li><a href="#" id="search"><i class="fa fa-search"></i></a></li>
                       <!-- <li><a href="#"><i class="fa fa-shopping-bag"></i><span>0</span></a></li>-->
                    </ul>
                </div> <!-- right icon -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>
    
    
    
    ';



    $Company = '
    <div class="navigation">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-9 col-8">
                <nav class="navbar navbar-expand-lg">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="active" href="'.$useDefaultPath.'index.php">Home</a>
                               
                            </li>
                            <li class="nav-item">
                                <a href="'.$useFrontEnd .'about.php">About us</a>
                            </li>
                          
                           
                           
                          
                           
                            <li class="nav-item">
                                <a href="'.$useFrontEnd .'JobMarket.php">Job Market</a>

                                <ul class="sub-menu">
                                <li><a class="active" href="'.$useFrontEnd.'ViewJobs.php">View Jobs</a></li>
                               
                              </ul>
                                
                            </li>

                       

                        <li class="nav-item">
                        <a href="'.$useFrontEnd .'account.php">Profile</a>
                        
                        </li>


                        </ul>
                    </div>
                </nav> <!-- nav -->
            </div>
            <div class="col-lg-2 col-md-2 col-sm-3 col-4">
                <div class="right-icon text-right">
                    <ul>
                        <li><a href="#" id="search"><i class="fa fa-search"></i></a></li>
                       <!-- <li><a href="#"><i class="fa fa-shopping-bag"></i><span>0</span></a></li>-->
                    </ul>
                </div> <!-- right icon -->
            </div>
        </div> <!-- row -->
    </div> <!-- container -->
</div>
    
    
    
    ';





if ( $isCompany ==true){
    $checkComp =$Company;
   
}
else {
    $checkComp =$uni;
   
}



 
// Output the HTML content, using the base paths for images
    echo '
      
   
        <div class="header-top d-none d-lg-block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-contact text-lg-left text-center">
                            <ul>
                                <li><img src="' . $imagesBasePath . 'images/all-icon/map.png" alt="icon"><span> korayteem Street, Lebanon</span></li>
                                <li><img src="' . $imagesBasePath . 'images/all-icon/email.png" alt="icon"><span>support.Web@equalizers.com</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="header-opening-time text-lg-right text-center">
                            <p>Opening Hours : Monday to Friday - 8 Am to 5 Pm</p>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- header top -->

          <!---->
          <div class="header-logo-support pt-30 pb-30">
          <div class="container">
              <div class="row">
                  <div class="col-lg-4 col-md-4">
                      <div class="logo">
                          <a href="'. $useDefaultPath.'index.php">
                              <img src="'.$imagesBasePath.'images/logo.png" alt="Logo">
                          </a>
                      </div>
                  </div>
                  <div class="col-lg-8 col-md-8">
                      <div class="support-button float-right d-none d-md-block">
                          <div class="support float-left">
                              <div class="icon">
                                  <img src="'.$imagesBasePath.'images/all-icon/support.png" alt="icon">
                              </div>
                              <div class="cont">
                                  <p>Need Help? call us free</p>
                                  <span>01 786 456</span>
                              </div>
                          </div>
                       
                      </div>
                  </div>
              </div> <!-- row -->
          </div> <!-- container -->
      </div>'.$checkComp .'

      

       
    
  <div class="search-box">
  <div class="serach-form">
      <div class="closebtn">
          <span></span>
          <span></span>
      </div>
      <form action="#">
          <input type="text" placeholder="Search by keyword">
          <button><i class="fa fa-search"></i></button>
      </form>
  </div> 
</div>

</header>


        
    ';
}

// Call the function with true to use the relative path



function headerIndex(){
    ?>
     <!--====== HEADER PART START ======-->
    
     <header id="header-part">

     <?php headerTop($useRelativePath = false) ?>
      
       
     
      




         <!--====== SLIDER PART START ======-->
    
         <section id="slider-part" class="slider-active">
        <div class="single-slider bg_cover pt-150" style="background-image: url(images/slider/s-1.jpg)" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-9">
                        <div class="slider-cont">
                            <h1 data-animation="bounceInLeft" data-delay="1s">Welcome to Computer Science Department </h1>
                            <p data-animation="fadeInUp" data-delay="1.3s"> Computer Science: Untangling problems one line of code at a time." 💻🔗 #CSMemes</p>
                            <ul>
                                <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="#">Read More</a></li>
                                <li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2"  href="FrontEnd/Login.php">Log In</a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- single slider -->
        
        <div class="single-slider bg_cover pt-150" style="background-image: url(images/slider/s-2.jpg)" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-9">
                        <div class="slider-cont">
                            <h1 data-animation="bounceInLeft" data-delay="1s">Choose the right theme for education</h1>
                            <p data-animation="fadeInUp" data-delay="1.3s"></p>
                            <ul>
                                <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="#">Read More</a></li>
                                <li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2" href="FrontEnd/Login.php">Log In </a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- single slider -->




        
        <div class="single-slider bg_cover pt-150" style="background-image: url(images/slider/s-3.jpg)" data-overlay="4">
            <div class="container">
                <div class="row">
                    <div class="col-xl-7 col-lg-9">
                        <div class="slider-cont">
                            <h1 data-animation="bounceInLeft" data-delay="1s">Choose the right theme for education</h1>
                            <p data-animation="fadeInUp" data-delay="1.3s"> When you code so fast, your keyboard becomes a rocket booster." 🚀💻 #CodingSpeedDial</p>
                            <ul>
                                <li><a data-animation="fadeInUp" data-delay="1.6s" class="main-btn" href="#">Read More</a></li>
                                <li><a data-animation="fadeInUp" data-delay="1.9s" class="main-btn main-btn-2"  href="FrontEnd/Login.php">Log In</a></li>
                            </ul>
                        </div>
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- single slider -->
    </section>
    
    <!--====== SLIDER PART ENDS ======-->
   <?php



}







 function JSfunctions($useRelativePath = true) {
        $basePath = $useRelativePath ? "../js/" : "js/";
    
        echo '
            <!--====== jquery js ======-->
            <script src="' . $basePath . 'vendor/modernizr-3.6.0.min.js"></script>
            <script src="' . $basePath . 'vendor/jquery-1.12.4.min.js"></script>
    
            <!--====== Bootstrap js ======-->
            <script src="' . $basePath . 'bootstrap.min.js"></script>
            
            <!--====== Slick js ======-->
            <script src="' . $basePath . 'slick.min.js"></script>
            
            <!--====== Magnific Popup js ======-->
            <script src="' . $basePath . 'jquery.magnific-popup.min.js"></script>
            
            <!--====== Counter Up js ======-->
            <script src="' . $basePath . 'waypoints.min.js"></script>
            <script src="' . $basePath . 'jquery.counterup.min.js"></script>
            
            <!--====== Nice Select js ======-->
            <script src="' . $basePath . 'jquery.nice-select.min.js"></script>
            
            <!--====== Nice Number js ======-->
            <script src="' . $basePath . 'jquery.nice-number.min.js"></script>
            
            <!--====== Count Down js ======-->
            <script src="' . $basePath . 'jquery.countdown.min.js"></script>
            
            <!--====== Validator js ======-->
            <script src="' . $basePath . 'validator.min.js"></script>
            
            <!--====== Ajax Contact js ======-->
            <script src="' . $basePath . 'ajax-contact.js"></script>
            
            <!--====== Main js ======-->
            <script src="' . $basePath . 'main.js"></script>
            

            <!--====== Map js ======-->
         <!--   <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY"></script>
            <script src="' . $basePath . 'map-script.js"></script>-->
        ';
    }
    


function dbConnect(){
    $host = 'localhost';
    $username = 'root';
    $password = 'root';
    $database = 'Department';
    try {
        $conn = new PDO("mysql:host=$host;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     //  echo'connected';
       return $conn;
    } catch(PDOException $e) {
  // echo'not connected';
   return null;
    }
}






function footer($useRelativePath = true, $includeFrontEnd = true, $customLocation = '') {
    $basePath = $useRelativePath ? "../" : "";
    $location = $includeFrontEnd ? 'FrontEnd/' : '';

    if (!empty($customLocation)) {
        $location .= $customLocation;
    }

    echo'
        <!--====== FOOTER PART STARTS ======-->
        <footer id="footer-part">
            <div class="footer-top pt-40 pb-70">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-about mt-40">
                                <div class="logo">
                                    <a href="#"><img src="'.$basePath.'images/logo.png" alt="Logo"></a>
                                </div>
                                <p>Lebanese American University is committed to academic excellence, student centeredness, civic engagement, the advancement of scholarship, the education of the whole person, and the formation of leaders in a diverse world.</p>
                                <ul class="mt-20">
                                    <li><a href="#"><i class="fa fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div> <!-- footer about -->
                        </div>

                    
                    <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer-link mt-40">
                        <div class="footer-title pb-25">
                            <h6>Sitemap</h6>
                        </div>
                        <ul>
                            <li><a href="FrontEnd/index-2.php"><i class="fa fa-angle-right"></i>Home</a></li>
                            <li><a href="FrontEnd/about.html"><i class="fa fa-angle-right"></i>About us</a></li>
                            <li><a href="FrontEnd/courses.html"><i class="fa fa-angle-right"></i>Courses</a></li>
                            <li><a href="FrontEnd/blog.html"><i class="fa fa-angle-right"></i>News</a></li>
                            <li><a href="FrontEnd/events.html"><i class="fa fa-angle-right"></i>Event</a></li>
                        </ul>
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Gallery</a></li>
                            <li><a href="FrontEnd/shop.html"><i class="fa fa-angle-right"></i>Shop</a></li>
                            <li><a href="FrontEnd/teachers.html"><i class="fa fa-angle-right"></i>Teachers</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Support</a></li>
                            <li><a href="FrontEnd/contact.html"><i class="fa fa-angle-right"></i>Contact</a></li>
                        </ul>
                    </div> <!-- footer link -->
                </div>
                <div class="col-lg-2 col-md-6 col-sm-6">
                    <div class="footer-link support mt-40">
                        <div class="footer-title pb-25">
                            <h6>Support</h6>
                        </div>
                        <ul>
                            <li><a href="#"><i class="fa fa-angle-right"></i>FAQS</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Privacy</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Policy</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Support</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i>Documentation</a></li>
                        </ul>
                    </div> <!-- support -->
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-address mt-40">
                        <div class="footer-title pb-25">
                            <h6>Contact Us</h6>
                        </div>
                        <ul>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-home"></i>
                                </div>
                                <div class="cont">
                                    <p>Beirut, korayteem Street, Near Hariri Mansion        </p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="cont">
                                    <p>01 786 456</p>
                                </div>
                            </li>
                            <li>
                                <div class="icon">
                                    <i class="fa fa-envelope-o"></i>
                                </div>
                                <div class="cont">
                                    <p>support.Web@equalizers.com</p>
                                </div>
                            </li>
                        </ul>
                    </div> <!-- footer address -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- footer top -->
    

</footer>

<a href="#" class="back-to-top"><i class="fa fa-angle-up"></i></a>









       
    ';

    
}









?>


    