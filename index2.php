<?php

$tuition = "";
$commission = "";
if (isset($_POST['calculate_tuition'])) {
	$units = $_POST['units'];
	$tuition_fee = ($units * 45) + 200 + ($units * 45 * 0.15);
	$tuition = "<div class='alert'>Tuition Fee: Php " . number_format($tuition_fee, 2, ".", ",") . "</div>";
}

if (isset($_POST['calculate_commission'])) {
	$type = $_POST['type'];
	$price = $_POST['price'];
	switch ($type) {
		case 1:
			$commission = max($price * 0.07, 400);
			break;
		case 2:
			$commission = min($price * 0.1, 900);
			break;
		case 3:
			$commission = $price * 0.12;
			break;
		case 4:
			$commission = 250;
			break;
		default:
			$commission = 0;
			break;
	}
	$commission = "<div class='alert'>Commission: P" . number_format($commission, 2, ".", ",") . "</div>";
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Tuition Fee and Sales Commission Calculator</title>

	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
			margin: 0;
			padding: 5em;

		}

		h1 {
			text-align: center;
		}

		.container {
			display: flex;
			justify-content: center;
		}

		.card {
			background: #eee;
			padding: 20px;
			border-radius: 1em;
			box-shadow: 0px 0px 22px 2px rgba(0, 0, 0, 0.31);
			margin: 20px;
		}

		.alert {
			background: #d4edda;
			border: 1px solid #c3e6cb;
			padding: 10px;
			border-radius: 5px;
			margin-top: 10px;
			font-weight: 600;
		}

		footer {
			font-weight: 600;
			margin-top: 2em;
			text-align: center;
		}

		button {
			padding: 10px;
			background: #23272b;
			color: #f1fff2;
			border: 1px solid #1d2124;
			border-radius: 5px;
		}

		input,
		select {
			padding: 5px;
			border: 1px solid #ced4da;
			border-radius: 3px;
		}
	</style>
</head>

<body>

	<h1>CSIT226 PHP Activity</h1>

	<div class="container">
		<div class="card">
			<h2>Tuition Fee Calculator</h2>
			<form method="post">
				<label for="units">Number of Units:</label>
				<input type="number" id="units" name="units" required><br><br>
				<button type="submit" name="calculate_tuition">Calculate Tuition Fee</button>
			</form>
			<?php echo $tuition; ?>

		</div>
		<div class="card">
			<h2>Sales Commission Calculator</h2>
			<form method="post">
				<label for="type">Type of Appliance Sold:</label>
				<select id="type" name="type" required>
					<option value="">Select Type</option>
					<option value="1">Type 1: 7% of sale or 400, whichever is more.</option>
					<option value="2">Type 2: 10% of sale or 900, whichever is less.</option>
					<option value="3">Type 3: 12% of sale.</option>
					<option value="4">Type 4: P250, regardless of sale price.</option>
				</select><br><br>
				<label for="price">Sale Price:</label>
				<input type="number" step="0.01" id="price" name="price" required><br><br>
				<button type="submit" name="calculate_commission">Calculate Commission</button>
			</form>

			<?php echo $commission; ?>

		</div>

	</div>

	<footer>
		<p>Submitted by James Alein Ocampo</p>
	</footer>

</body>

</html>