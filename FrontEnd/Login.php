<!DOCTYPE html>
<html lang="en">
<head>
    <title>Glassmorphism login Form Tutorial in html css</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    
    <!--Stylesheet-->
    <style media="screen">
        *, *:before, *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #c9c9ca;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .background {
            width: 300px;
            height: 420px;
            position: absolute;
        }

        .background img {
            width: 100%;
            height: auto;
        }

        .content {
            position: absolute;
            top: 10px;
            left: 10px;
            color: rgb(27, 3, 3);
            z-index: 1;
        }

        form {
            height: 520px;
            width: 400px;
            background-color: rgba(4, 0, 0, 0.13);
            position: absolute;
            transform: translate(-50%,-50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255,255,255,0.1);
            box-shadow: 0 0 40px rgba(8,7,16,0.6);
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(11, 11, 11, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .social {
            margin-top: 30px;
            display: flex;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255,255,255,0.27);
            color: #eaf0fb;
            text-align: center;
        }

        .social div:hover {
            background-color: rgba(255,255,255,0.47);
        }

        .social .fb {
            margin-left: 25px;
        }

        .social i {
            margin-right: 4px;
        }

        @media screen and (max-width: 768px) {
            .background {
                width: 100%;
                height: 250px;
                position: relative;
                top: 0;
                left: 0;
            }

            .content {
                position: relative;
                top: 0;
                left: 0;
                padding: 10px;
            }

            form {
                width: 90%;
                position: relative;
                transform: none;
                top: 10px;
                left: 0;
                margin: 0 auto;
                padding: 25px 20px;
            }
        }
    </style>
</head>

<body>



    <div>
        <form>
            <h3>Login Here</h3>

            <label for="username">Username</label>
            <input type="text" placeholder="Email or Phone" id="username">

            <label for="password">Password</label>
            <input type="password" placeholder="Password" id="password">
            <a href='#'>forgot password?</a>
            <button>Log In</button>
            <div class="social">
               <a href='CompanyLog.php'>Company login?</a>
            </div>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('form').on('submit', function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Retrieve the username and password from the form
                var username = $('#username').val();
                var password = $('#password').val();

                console.log(username);
                console.log(password);
                // Use jQuery's `$.ajax` to send the request to your server endpoint
                 $.ajax({
                    url: '../BackEnd/Models/Users.php', // Your endpoint here
                    type: 'POST',

                   
                    data: 
                        { username: username, password: password , action: 'Man-LogIN' },
                       
                    success: function(response) {
                        console.log('Success:', response);

                        window.location.href = "account.php";
                    
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:');

                        window.location.href = "../index.php";
                        // Handle errors - like showing error messages to the user
                    }
                });
            });



        });
    </script>


</body>
</html>
