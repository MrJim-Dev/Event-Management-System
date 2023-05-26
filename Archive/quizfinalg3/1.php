<!DOCTYPE html>
<html lang="en">

<?php
$con = mysqli_connect("localhost", "root", "", "quizfinalg3");

$alertmsg = '';
if (isset($_POST['submitBtn'])) {

    $speaker_id = $_POST['speaker_id'];
    $speaker_name = $_POST['speaker_name'];
    $topic = $_POST['topic'];
    $event_name = $_POST['event_name'];

    $sql = "select * from events where EventName = '$event_name'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_num_rows($result);

    if ($row == 1) {
        $event = mysqli_fetch_assoc($result);
        $event_id = $event['EventID'];

        $sql = "select * from eventspeakers where SpeakerID = '$speaker_id'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_num_rows($result);

        if ($row == 0) {
            $sql = "insert into eventspeakers value('$speaker_id', '$event_id', '$speaker_name', '$topic')";
            mysqli_query($con, $sql);
            $alertmsg = 'New record has been saved.';
        } else {
            $alertmsg = 'Speaker Id is already existing.';
        }
    } else {
        $alertmsg = 'Event name not existing.';
    }
}
?>


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events</title>

    <style>
        .form-group {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div>
        <span><?php echo $alertmsg; ?></span>
        <form method="POST">
            <div class="form-group">
                <label for="speaker_id">Input Speaker ID: </label>
                <input type="text" id="speaker_id" name="speaker_id" value="" required>
            </div>
            <div class="form-group">
                <label for="speaker_namer">Input Speaker name: </label>
                <input type="text" id="speaker_name" name="speaker_name" value="" required>

            </div class="form-group">

            <div class="form-group">
                <label for="topic">Input Topic: </label>
                <input type="text" id="topic" name="topic" value="" required>
            </div>

            <div class="form-group">
                <label for="event_name">Event Name: </label>
                <input type="text" id="event_name" name="event_name" value="" required>
            </div>
            <button type="submit" name="submitBtn">Add</button>
        </form>
    </div>
</body>

</html>