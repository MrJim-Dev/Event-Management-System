<?php
$con = mysqli_connect('localhost', 'root', '', 'event_database');


if (isset($_POST['submitBtn'])) {
    $role = $_POST['role'];

    if ($role === 'Player') {
        $uid = uniqid();
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $birth_date = $_POST['birth_date'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email address.')</script>";
        } else {
            $sql = "SELECT * from players where Player_ID = '$uid'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            if ($row == 0) {
                $sql = "INSERT into players VALUES('$uid', '$first_name', '$middle_name', '$last_name', '$birth_date', '$gender', '$age', '$email', '$phone')";
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
    } elseif ($role === 'Coach') {
        $uid = uniqid();
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email address.')</script>";
        } else {
            $sql = "SELECT * from coaches where Coach_ID = '$uid'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            if ($row == 0) {
                $sql = "insert into coaches values('$uid', '$first_name', '$middle_name', '$last_name', '$email', '$phone')";
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
    } elseif ($role === 'Convenor') {
        $uid = uniqid();
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email address.')</script>";
        } else {
            $sql = "SELECT * from convenors where Convenor_ID = '$uid'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            if ($row == 0) {
                $sql = "insert into convenors values('$uid', '$first_name', '$middle_name', '$last_name', '$email', '$phone')";
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
    }
}

$first_name = '';
$middle_name = '';
$last_name = '';
$email = '';
$phone = '';
$birth_date = '';
$gender = '';
$age = '';


if (isset($_POST['updateBtn'])) {
    $role = $_GET['role'];

    if ($role == 'Player') {
        $uid = $_GET['pid'];

        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $birth_date = $_POST['birth_date'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email address.')</script>";
        } else {
            $sql = "SELECT * FROM players WHERE Player_ID = '$uid'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            if ($row != 0) {
                $sql = "UPDATE players SET Fname = '$first_name', Mname= '$middle_name', Lname= '$last_name', Email= '$email', Phone= '$phone', BirthDate= '$birth_date', Gender= '$gender', Age= '$age' WHERE Player_ID = '$uid'";
                mysqli_query($con, $sql);
                echo "<script language='javascript'>
                            alert ('New record updated.');
                        </script>";
            } else {
                echo "Error: " . mysqli_error($con);
                echo "<script language='javascript'>
                            alert ('There was a problem updating the record');
                        </script>";
            }
        }
    } elseif ($role == 'Coach') {
        $uid = $_GET['pid'];

        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email address.')</script>";
        } else {
            $sql = "SELECT * FROM coaches WHERE Coach_ID = '$uid'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            if ($row != 0) {

                $sql = "UPDATE coaches SET Fname = '$first_name', Mname= '$middle_name', Lname= '$last_name', Email= '$email', Phone= '$phone' WHERE Coach_ID = '$uid'";
                mysqli_query($con, $sql);
                echo "<script language='javascript'>
                            alert ('New record updated.');
                        </script>";
            } else {
                echo "Error: " . mysqli_error($con);
                echo "<script language='javascript'>
                            alert ('There was a problem updating the record');
                        </script>";
            }
        }
    } elseif ($role == 'Convenor') {
        $uid = $_GET['pid'];

        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email address.')</script>";
        } else {
            $sql = "SELECT * FROM convenors WHERE Convenor_ID = '$uid'";
            $result = mysqli_query($con, $sql);
            $row = mysqli_num_rows($result);

            if ($row != 0) {

                $sql = "UPDATE convenors SET Fname = '$first_name', Mname= '$middle_name', Lname= '$last_name', Email= '$email', Phone= '$phone' WHERE Convenor_ID = '$uid'";
                mysqli_query($con, $sql);
                echo "<script language='javascript'>
                            alert ('New record updated.');
                        </script>";
            } else {
                echo "<script language='javascript'>
                            alert ('There was a problem updating the record');
                        </script>";
            }
        }
    }
}


$role = 'Player';

if (isset($_GET['pid'])) {
    $pid = $_GET['pid'];
    $role = $_GET['role'];

    if ($role == 'Player') {
        $query = "SELECT * FROM players WHERE Player_ID = '$pid'";
        $result = mysqli_query($con, $query);

        $player = mysqli_fetch_assoc($result);

        $first_name = $player['Fname'];
        $middle_name = $player['Mname'];
        $last_name = $player['Lname'];
        $email = $player['Email'];
        $phone = $player['Phone'];
        $birth_date = $player['BirthDate'];
        $gender = $player['Gender'];
        $age = $player['Age'];
    } else if ($role == 'Coach') {

        $query = "SELECT * FROM coaches WHERE Coach_ID = '$pid'";
        $result = mysqli_query($con, $query);

        $coach = mysqli_fetch_assoc($result);

        $first_name = $coach['Fname'];
        $middle_name = $coach['Mname'];
        $last_name = $coach['Lname'];
        $email = $coach['Email'];
        $phone = $coach['Phone'];
    } else if ($role == 'Convenor') {
        $query = "SELECT * FROM convenors WHERE Convenor_ID = '$pid'";
        $result = mysqli_query($con, $query);

        $convenor = mysqli_fetch_assoc($result);

        $first_name = $convenor['Fname'];
        $middle_name = $convenor['Mname'];
        $last_name = $convenor['Lname'];
        $email = $convenor['Email'];
        $phone = $convenor['Phone'];
    } else {
        header("Location: RegistrationForm.php");
    }
}

if (isset($_GET['del'])) {
    $uid = $_GET['del'];
    $role = $_GET['role'];

    if ($role == 'Player') {
        $query1 = "DELETE FROM team_players WHERE Player_ID = '$uid'";
        $query2 = "DELETE FROM players WHERE Player_ID = '$uid'";
    } else if ($role == 'Coach') {
        $query1 = "DELETE FROM team_coaches WHERE Coach_ID = '$uid'";
        $query2 = "DELETE FROM coaches WHERE Coach_ID = '$uid'";
    } else if ($role == 'Convenor') {
        $query1 = "DELETE FROM event_convenors WHERE Convenor_ID = '$uid'";
        $query2 = "DELETE FROM convenors WHERE Convenor_ID = '$uid'";
    } else {
        header("Location: RegistrationForm.php");
        exit(); // Terminate script execution to prevent further processing
    }

    if (mysqli_query($con, $query1) && mysqli_query($con, $query2)) {
        echo "<script language='javascript'>
            alert ('The record has been deleted.');
            window.location.href = 'RegistrationForm.php'; // Redirect to desired page after successful deletion
        </script>";
        exit(); // Terminate script execution after redirection
    } else {
        echo "Error: " . mysqli_error($con);
    }
}


// $role = isset($_POST['role']) ? $_POST['role'] : 'Player';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Registration Form</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">


    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #efefef;
        }

        .container {
            min-height: 100vh;
            background: #efefef;
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-direction: column;

        }


        .card_table {
            background: white;
            width: auto;
            padding: 20px;
            border-radius: .5em;
            box-shadow: 0px 0px 18px 5px rgba(0, 0, 0, 0.1);
            margin: 2em;
        }
    </style>

</head>

<body>

    <?php include("navbar.php"); ?>

    <div class="container">

        <div class="card col-md-12 col-lg-6 m-5">

            <div class="card-body">
                <h4>Registration Form</h4>
                <p>This form allows you to register as a <span id="roleText">Player</span>.</p>

                <form method="POST">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control" onclick="changeTextForm()" <?php echo (isset($_GET['pid'])) ? 'disabled' : ''; ?>>
                            <option value="Player" <?php echo ($role == 'Player') ? 'selected' : ''; ?>>Player</option>
                            <option value="Coach" <?php echo ($role == 'Coach') ? 'selected' : ''; ?>>Coach</option>
                            <option value="Convenor" <?php echo ($role == 'Convenor') ? 'selected' : ''; ?>>Convenor</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $first_name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="middle_name">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name" class="form-control" value="<?php echo $middle_name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $last_name; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="phone" name="phone" id="phone" class="form-control" value="<?php echo $phone; ?>" maxlength="14" required>
                    </div>

                    <div id="playerform" class="<?php echo ($role != 'Player') ? 'd-none' : ''; ?>">
                        <div class="form-group">
                            <label for="birth_date">Birthdate</label>
                            <input type="date" name="birth_date" id="birth_date" class="form-control" value="<?php echo $birth_date; ?>">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" id="gender" class="form-control" value="<?php echo $gender; ?>">
                                <option value="select">-select one-</option>
                                <option value="Male" <?php echo ($gender == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($gender == 'Female') ? 'selected' : ''; ?>>Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="age">Age</label>
                            <input type="number" name="age" id="age" class="form-control" value="<?php echo $age; ?>">
                        </div>
                    </div>


                    <?php
                    if (isset($_GET['pid'])) {
                        echo '<button class="btn btn-dark" type="submit" name="updateBtn">Update</button>';
                        echo '<a class="btn btn-secondary ml-2" href="RegistrationForm.php">Back</a>';
                    } else {
                        echo '<button class="btn btn-dark" type="submit" name="submitBtn">Register</button>';
                    }

                    ?>
                </form>
            </div>
        </div>



        <div class="card_table card col-md-12 m-5">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h4 id="change_header">Player</h4>
                        <p>All <span id="change_span"> Players</span> will be listed here.</p>
                    </div>
                    <div>
                        <form method="post">
                            <label for="role">Role</label>
                            <select name="role_table" id="role_table" class="form-control" onchange="changeText()">
                                <option value="Player">Player</option>
                                <option value="Coach">Coach</option>
                                <option value="Convenor">Convenor</option>
                            </select>
                        </form>
                    </div>
                </div>

                <span id="player_table">
                    <table class="table table-responsive table-striped">
                        <thead class="thead-dark">
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Birthdate</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Action</th>

                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM players ";
                            $result = mysqli_query($con, $sql);


                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $uid = $row['Player_ID'];
                                    echo '<tr>
                                            <td>' . $row['Fname'] . '</td>
                                            <td>' . $row['Mname'] . '</td>
                                            <td>' . $row['Lname'] . '</td>
                                            <td>' . $row['Email'] . '</td>
                                            <td>' . $row['Phone'] . '</td>
                                            <td>' . $row['BirthDate'] . '</td>
                                            <td>' . $row['Gender'] . '</td>
                                            <td>' . $row['Age'] . '</td>
                                            <td>
                                                <a href="?pid=' . $uid . '&role=Player">Edit</a>
                                                <a href="?del=' . $uid . '&role=Player">Delete</a>
                                            </td>
                                        </tr>
                                        ';
                                }
                            } else {
                                echo '<tr><td colspan=10 style="text-align: center;">No result found.</td></tr>';
                            }

                            ?>
                        </tbody>
                    </table>
                </span>

                <span class="d-none" id="coach_table">
                    <table class="table table-responsive table-striped">
                        <thead class="thead-dark">
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM coaches";
                            $result = mysqli_query($con, $sql);


                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $uid = $row['Coach_ID'];
                                    echo '<tr>
                                            <td>' . $row['Fname'] . '</td>
                                            <td>' . $row['Mname'] . '</td>
                                            <td>' . $row['Lname'] . '</td>
                                            <td>' . $row['Email'] . '</td>
                                            <td>' . $row['Phone'] . '</td>
                                            <td>
                                                <a href="?pid=' . $uid . '&role=Coach">Edit</a>
                                                <a href="?del=' . $uid . '&role=Coach">Delete</a>
                                            </td>
                                        </tr>
                                        ';
                                }
                            } else {
                                echo '<tr><td colspan=10 style="text-align: center;">No result found.</td></tr>';
                            }

                            ?>
                        </tbody>
                    </table>
                </span>

                <span class="d-none" id="convenor_table">
                    <table class="table table-responsive table-striped">
                        <thead class="thead-dark">
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM convenors";
                            $result = mysqli_query($con, $sql);


                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $uid = $row['Convenor_ID'];
                                    echo '<tr>
                                            <td>' . $row['Fname'] . '</td>
                                            <td>' . $row['Mname'] . '</td>
                                            <td>' . $row['Lname'] . '</td>
                                            <td>' . $row['Email'] . '</td>
                                            <td>' . $row['Phone'] . '</td>
                                            <td>
                                                <a href="?pid=' . $uid . '&role=Convenor">Edit</a>
                                                <a href="?del=' . $uid . '&role=Convenor">Delete</a>
                                            </td>
                                        </tr>
                                        ';
                                }
                            } else {
                                echo '<tr><td colspan=10 style="text-align: center;">No result found.</td></tr>';
                            }

                            ?>
                        </tbody>
                    </table>
                </span>
            </div>



        </div>




        <script src="js/jquery.min.js"></script>




        <script>
            $('#role').on("change", function() {
                var role = $('#role').val();


                if (role == 'Player') {
                    $('#playerform').removeClass('d-none');
                } else {
                    $('#playerform').addClass("d-none");
                }

            });


            $('#role_table').on("change", function() {
                var role_table = $('#role_table').val();


                if (role_table == 'Player') {
                    $('#player_table').removeClass('d-none');
                    $('#coach_table, #convenor_table').addClass("d-none");
                } else if (role_table == 'Coach') {
                    $('#coach_table').removeClass('d-none');
                    $('#player_table, #convenor_table').addClass("d-none");
                } else if (role_table == 'Convenor') {
                    $('#convenor_table').removeClass('d-none');
                    $('#player_table, #coach_table').addClass("d-none");
                }
            });

            function changeTextForm() {
                var selectElement = document.getElementById("role");
                var roleText = document.getElementById("roleText");

                var selectedOption = selectElement.value;
                roleText.textContent = selectedOption;
            }

            function changeText() {
                var selectElement = document.getElementById("role_table");
                var headerElement = document.getElementById("change_header");
                var spanElement = document.getElementById("change_span");

                var selectedOption = selectElement.value;

                headerElement.textContent = selectedOption;

                spanElement.textContent = selectedOption;
            }
        </script>

    </div>



</body>

</html>