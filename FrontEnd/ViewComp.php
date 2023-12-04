<?php
require_once '../BackEnd/Common/Setup.php';

AccessControll();
authenticationCustomers();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php CommonFuncs(true); ?>
    <link rel="stylesheet" href="../css/plug.css">
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
            border-radius: 5px;
        }
    </style>
</head>

<body>

    <?php preloader();
    headerTop($useRelativePath = true); ?>

    <h2>Activity Monitor:</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Name</th>
            <th>Status</th>
        </tr>
        <?php
        $data = CompanyUsers();
        foreach ($data as $row) :
        ?>
            <tr>
                <td><?= htmlspecialchars($row['COMPANY_ID']) ?></td>
                <td><?= htmlspecialchars($row['USERNAME']) ?></td>
                <td><?= htmlspecialchars($row['LEGAL_NAME']) ?></td>
                
                <td>
                    <label class="switch">
                        <input type="checkbox" id="user-toggle-<?= htmlspecialchars($row['COMPANY_ID']) ?>" data-id="<?= htmlspecialchars($row['COMPANY_ID']) ?>" <?= $row['ISVERIFIED'] == 1 ? 'checked' : '' ?>>
                        <span class="slider round"></span>
                    </label>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div id='hiddenId' data-userid="<?php echo $_SESSION['user_id']; ?>"></div>

    <?php footer(true, true); ?>
    <?php JSfunctions(true); ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('input[type=checkbox]').on('change', function() {
                var userId = $(this).data('id');
                var isActive = $(this).is(':checked') ? 1 : -1;

                console.log("user: " + userId);
                console.log("Is active :" + isActive);

                $.ajax({
                    url: '../BackEnd/Models/Department.php',
                    method: 'POST',
                    data: {
                        action: 'User_activity',
                        user_id: userId,
                        activity: isActive
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            alert("Updated successfully");
                        } else {
                            if (response.message) {
                                alert(response.message);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>

</html>
