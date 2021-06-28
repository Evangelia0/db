<?php
/**
  * Function to query information based on
  * a parameter: in this case, location.
  *
  */


  try {
    require "config.php";
    require "common.php";

    $connection = new PDO($dsn, $username, $password, $options);

    $sql1 = "SELECT *
    FROM Client_info";


    $statement = $connection->prepare($sql1);
    $statement->execute();

    $result1 = $statement->fetchAll();
	$sql2 = "SELECT *
    FROM Sales";


    $statement = $connection->prepare($sql2);
    $statement->execute();

    $result2 = $statement->fetchAll();
	
  } catch(PDOException $error) {
    echo $sql1 . "<br>" . $error->getMessage();
  }

?>
<?php require "templates/header.php"; ?>


    <h2>Client_info</h2>
	 

 <table>
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Date of Birth</th>
      <th>email</th>
      <th>phone number</th>
	  <th>NFC ID</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result1 as $row) : ?>
    <tr>
      <td><?php echo escape($row["first_name"]); ?></td>
      <td><?php echo escape($row["last_name"]); ?></td>
      <td><?php echo escape($row["date_of_birth"]); ?></td>
      <td><?php echo escape($row["email"]); ?></td>
      <td><?php echo escape($row["phone_number"]); ?></td>
      <td><?php echo escape($row["NFC_ID"]); ?> </td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>

 <h2>Sales</h2>
	 

 <table>
  <thead>
    <tr>
      <th>Service ID</th>
      <th>Service description</th>
      <th>Total sales</th>

    </tr>
  </thead>
  <tbody>
  <?php foreach ($result2 as $row) : ?>
    <tr>
      <td><?php echo escape($row["Service_ID"]); ?></td>
      <td><?php echo escape($row["description"]); ?></td>
      <td><?php echo escape($row["sum(amount)"]); ?></td>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>







<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>