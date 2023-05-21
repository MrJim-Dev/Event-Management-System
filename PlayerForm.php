<?php
$con = mysqli_connect("localhost", "root", "", "event_database");

if (isset($_POST['btnRegister'])) {
    $uid = uniqid();
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $last_name = $_POST['last_name'];
    $birth_date = $_POST['birth_date'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    $sql = "select * from players where Player_ID = '$uid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_num_rows($result);

    if ($row == 0) {
        $sql = "insert into players value('$uid', '$first_name', '$middle_name', '$last_name', '$birth_date', '$gender', '$age', '$email', '$phone')";
        mysqli_query($con, $sql);
        echo "<script language='javascript'>
					alert ('New record saved.');
				</script>";
    } else {
        echo "<script language='javascript'>
					alert ('Username already existing');
				</script>";
    }
}

if (isset($_GET['id'])) {
    //Select user from the database
    // Validate 


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Form</title>



    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            min-height: 100vh;
            width: 100%;
            background: #efefef;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;

        }

        .card {
            background: white;
            width: 40em;
            padding: 20px;
            border-radius: .5em;
            box-shadow: 0px 0px 18px 5px rgba(0, 0, 0, 0.1);
            margin: 2em;
        }

        .card-header {
            margin-bottom: 20px;
        }

        .card-header p {
            margin-top: 5px;
            color: #4d4d4d;
            font-size: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            margin: 10px 0;
        }

        .form-group label {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-control {
            padding: 5px;
            border: 1px solid #ced4da;
            border-radius: 3px;
        }

        .btn {
            padding: 5px 10px;
            padding: 10px;
            background: #23272b;
            color: #f1fff2;
            border: 1px solid #1d2124;
            border-radius: 5px;
        }

        .w-auto {
            width: auto;
        }

        table {
            margin: 0 auto;
        }

        table {
            color: #333;
            background: white;
            border: 1px solid grey;
            font-size: 12pt;
            border-collapse: collapse;
        }

        table thead th,
        table tfoot th {
            color: #3a3a3a;
            background: rgba(0, 0, 0, .1);
        }

        table caption {
            padding: .5em;
        }

        table th,
        table td {
            padding: .5em;
            border: 1px solid lightgrey;
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="card">

            <div class="card-header">
                <h2>Player Form</h2>
                <p>This form allows you to register as a player.</p>
            </div>

            <div class="card-body">
                <form method="POST">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Birthdate</label>
                        <input type="date" name="birth_date" id="birth_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="select">-select one-</option>
                            <option value="Male">M</option>
                            <option value="Female">F</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="age">Age</label>
                        <input type="text" name="age" id="age" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>

                    <button class="btn" name="btnRegister">Register</button>
                </form>
            </div>
        </div>

        <div class="card w-auto">

            <div class="card-header">
                <h2>Players</h2>
                <p>All players will be listed here.</p>
            </div>

            <div class="card-body">
                <table>
                    <thead>
                        <th>First Name</th>
                        <th>Middle Name</th>
                        <th>Last Name</th>
                        <th>Birthdate</th>
                        <th>Gender</th>
                        <th>Age</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>

                    </thead>
                    <tbody>

                        <?php
                        $sql = "SELECT * FROM players";
                        $result = mysqli_query($con, $sql);


                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>
                                    <td>' . $row['Fname'] . '</td>
                                    <td>' . $row['Mname'] . '</td>
                                    <td>' . $row['Lname'] . '</td>
                                    <td>' . $row['BirthDate'] . '</td>
                                    <td>' . $row['Gender'] . '</td>
                                    <td>' . $row['Age'] . '</td>
                                    <td>' . $row['Email'] . '</td>
                                    <td>' . $row['Phone'] . '</td>
                                    <td>Edit Delete</td<>
                                </tr>
                                ';
                            }
                        } else {
                            echo '<tr><td colspan=10 style="text-align: center;">No result found.</td></tr>';
                        }

                        ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>