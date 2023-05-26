<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Displays the Attendees of Seminar C</title>

    <style>
        td {
            padding: 5px;
        }
    </style>
</head>

<body>
    <?php
    $con = mysqli_connect("localhost", "root", "", "quizfinalg3");

    $sql = "SELECT e.EventName, a.Name, a.Email FROM events e, attendees a WHERE e.EventID = 3 AND e.EventID = a.EventID";

    $result = mysqli_query($con, $sql);

    ?>

    <h2>Attendees of Seminar C</h2>
    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>

            <?php
            while ($data = mysqli_fetch_assoc($result)) {
                echo '
                <tr>
                    <td>' . $data['EventName'] . '</td>
                    <td>' . $data['Name'] . '</td>
                    <td>' . $data['Email'] . '</td>
                </tr>
                ';
            }
            ?>

        </tbody>
    </table>

</body>

</html>