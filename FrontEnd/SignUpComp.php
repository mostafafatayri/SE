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
                height: 500px;
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
                width: 100%;
                position: relative;
                transform: none;
                top: 10px;
                left: 0;
                margin: 0 auto;
                padding: 25px 20px;
            }
        }
    </style>
    </style>
</head>

<body>
    <div>
        <form id="signupForm">
            <h3>Login Here</h3>

            <label for="username">Username</label>
            <input type="text" placeholder="Email or Phone" id="username">

            <label for="legalName">Legal Name</label>
            <input type="text" placeholder="Legal Name" id="legalName">

            <label for="password">Password</label>
            <input type="password" placeholder="Password" id="password">

            <label for="confirmPassword">Confirm Password</label>
            <input type="password" placeholder="Confirm Password" id="confirmPassword">

            <label for="link">Company's Website</label>
            <input type="text" placeholder="Link" id="link">

            <input class='type' type="file" id="fileInput" name="attachments[]" multiple>

            <a href='#'>forgot password?</a>
            <button type="button" id="signupButton">Sign UP</button>
            <div class="social">
                <a href='CompanyLog.php'>Company login?</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
 $(document).ready(function () {
    $("#signupButton").click(function () {
        var username = $("#username").val();
        var legalName = $("#legalName").val();
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();
        var link = $("#link").val();
        var fileInput = $("#fileInput")[0].files[0];

        if (password !== confirmPassword) {
            alert("Passwords do not match. Please try again.");
            return;
        }

        var formData = new FormData();
        formData.append('action', 'SignUp');
        formData.append('username', username);
        formData.append('legalName', legalName);
        formData.append('password', password);
        formData.append('link', link);

        if (fileInput) {
            var reader = new FileReader();
            reader.onload = function (e) {
                // Convert ArrayBuffer to base64
                var base64Content = arrayBufferToBase64(e.target.result);
                formData.append('fileContent', base64Content);
                sendAjaxRequest(formData);
            };
            reader.readAsArrayBuffer(fileInput);
        } else {
            sendAjaxRequest(formData);
        }
    });

    function sendAjaxRequest(formData) {
        $.ajax({
            type: 'POST',
            url: '../BackEnd/Models/Company.php',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                alert("Server response:", 'file submited');

                // Add your logic here based on the server response
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
            }
        });
    }

    // Function to convert ArrayBuffer to base64
    function arrayBufferToBase64(buffer) {
        var binary = '';
        var bytes = new Uint8Array(buffer);
        var len = bytes.byteLength;
        for (var i = 0; i < len; i++) {
            binary += String.fromCharCode(bytes[i]);
        }
        return btoa(binary);
    }
});


    </script>
</body>

</html>