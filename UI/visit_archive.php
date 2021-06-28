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
	if ($criteria=='Description'){
		 $sql = "SELECT date_of_charge, time_of_charge, description,amount,service_charge.Service_ID,
		 service_charge.NFC_ID, Client.last_name
		FROM service_charge, services, Client
		WHERE service_charge.Service_ID = services.Service_ID and  service_charge.NFC_ID = Client.NFC_ID
		ORDER BY description";
		
	}
	elseif ($criteria=='Date'){
		  $sql = "SELECT date_of_charge, time_of_charge, description,amount,service_charge.Service_ID,
		 service_charge.NFC_ID, Client.last_name
		FROM service_charge, services, Client
		WHERE service_charge.Service_ID = services.Service_ID and  service_charge.NFC_ID = Client.NFC_ID
		ORDER BY date_of_charge";
		
	}
	elseif ($criteria=='Cost'){
		 $sql = "SELECT date_of_charge, time_of_charge, description,amount,service_charge.Service_ID,
		 service_charge.NFC_ID, Client.last_name
		FROM service_charge, services, Client
		WHERE service_charge.Service_ID = services.Service_ID and  service_charge.NFC_ID = Client.NFC_ID
		ORDER BY amount";
		
	}
	else{
		$sql = "SELECT *
	FROM service_charge";
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
	<th>Last Name</th>
  <th>Date of charge</th>
   <th>Time of charge</th>
   <th>Description</th>
  <th>Amount</th>
  <th>NFC_ID</th>
  <th>Service_ID</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
	 <td><?php echo escape($row["last_name"]); ?></td>
<td><?php echo escape($row["date_of_charge"]); ?></td>
<td><?php echo escape($row["time_of_charge"]); ?></td>
<td><?php echo escape($row["description"]); ?></td>
<td><?php echo escape($row["amount"]); ?></td>
<td><?php echo escape($row["NFC_ID"]); ?> </td>
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

<div class="container mt-5">
	<form method="post">
	<div class="select-block">
	
			<select name="criteria">
			   <option value="" disabled selected>Choose option</option>
					<option value="Date">Date</option>
					<option value="Cost">Cost</option>
					<option value="Description">Description</option>
					</select
					  <div class="selectIcon">
          <svg focusable="false" viewBox="0 0 104 128" width="25" height="35" class="icon">
            <path d="m2e1 95a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm0-3e1a9 9 0 0 1 -9 9 9 9 0 0 1 -9 -9 9 9 0 0 1 9 -9 9 9 0 0 1 9 9zm14 55h68v1e1h-68zm0-3e1h68v1e1h-68zm0-3e1h68v1e1h-68z"></path>
          </svg>
        </div>
      </div>
			  <input type="submit" name="submit" value="View Results">
	</form>
	  </div>

<a href="index.php">Back to home</a>
<link rel="stylesheet" href="css/style.css">

<?php require "templates/footer.php";