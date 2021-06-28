<?php
/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */

if (isset($_POST['submit'])) {
  try {
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $criteria = $_POST['criteria'];
	if ($criteria=='description'){
		 $sql = "SELECT date_of_charge, time_of_charge, description, amount, service_charge.Service_ID
		FROM service_charge, services
		WHERE service_charge.Service_ID = services.Service_ID
		ORDER BY description";
		
	}
	elseif ($criteria=='Date'){
		 $sql = "SELECT date_of_charge, time_of_charge, description, amount, service_charge.Service_ID
		FROM service_charge, services
		WHERE service_charge.Service_ID = services.Service_ID
		ORDER BY date_of_charge";
		
	}
	elseif ($criteria=='Cost'){
		 $sql = "SELECT date_of_charge, time_of_charge, description, amount, service_charge.Service_ID
		FROM service_charge, services
		WHERE service_charge.Service_ID = services.Service_ID
		ORDER BY amount";
		
	}
    $statement = $connection->prepare($sql);
    //$statement->bindParam(':criteria', $criteria, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>
	 

    <table>
      <thead>
<tr>
  <th>Date of charge</th>
   <th>Time of charge</th>
  <th>Description</th>
  <th>Amount</th>
  <th>Service_ID</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["date_of_charge"]); ?></td>
<td><?php echo escape($row["time_of_charge"]); ?></td>
<td><?php echo escape($row["description"]); ?></td>
<td><?php echo escape($row["amount"]); ?></td>
<td><?php echo escape($row["Service_ID"]); ?> </td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['criteria']); ?>.
  <?php }
} ?>

<h2>Find Service based on criteria</h2>

<form method="post">
<select name="criteria">
   <option value="" disabled selected>Choose option</option>
        <option value="Date">Date</option>
        <option value="Cost">Cost</option>
        <option value="Description">Description</option>
  <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>
<link rel="stylesheet" href="css/style.css">

<?php require "templates/footer.php";