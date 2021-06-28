<?php



if (isset($_POST['submit'])) {
  require "../config.php";
  require "../common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $new_client = array(
      "Name" => $_POST['cl_name'],
    //   "email"     => $_POST['email'],
    //   "phone"       => $_POST['phone'],
      "Date_Of_Birth"  => $_POST['dateofbirth'],
	  "Identifying_Document" => $_POST['id'],
	  "NFC_ID" => $_POST['nfcid']

	  

    );

	

	$new_client_email = array(
		"NFC_ID" => $_POST['nfcid'],
		"Email_address" => $_POST['email']
	);

	$new_client_phone = array(
		"NFC_ID" => $_POST['nfcid'],
		"Phone_Number" => $_POST['phone']
	);

    $sql = sprintf(
		"INSERT INTO %s (%s) VALUES (%s)",
		"Client",
		implode(", ", array_keys($new_client)),
		":" . implode(", :", array_keys($new_client))
		);
	$sql1 = sprintf(
		"INSERT INTO %s (%s) VALUES (%s)",
		"Client_Email",
		implode(", ", array_keys($new_client_email)),
		":" . implode(", :", array_keys($new_client_email))
		// implode(", ", array_keys($new_client_email)),
		// ":" . implode(", :", array_keys($new_client_email))
		);

	$sql2 = sprintf(
		"INSERT INTO %s (%s) VALUES (%s)",
		"Client_Phone",
		implode(", ", array_keys($new_client_phone)),
		":" . implode(", :", array_keys($new_client_phone))
		);

    $statement = $connection->prepare($sql);
    $statement->execute($new_client);
	$statement = $connection->prepare($sql1);
	$statement->execute($new_client_email);
	$statement = $connection->prepare($sql2);
	$statement->execute($new_client_phone);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php echo $_POST['cl_name']; ?> successfully added.
<?php } ?>

    <form method="post">
    	<label for="cl_name">Name</label>
    	<input type="text" name="cl_name" id="cl_name">
    	<label for="email">Email Address</label>
    	<input type="text" name="email" id="email">
        <label for="phone">Phone Number</label>
    	<input type="text" name="phone" id="phone">
    	<label for="dateofbirth">Date of Birth</label>
    	<input type="text" name="dateofbirth" id="dateofbirth">
    	<label for="id">Identifying Document</label>
    	<input type="text" name="id" id="id">
        <label for="nfcid">NFC ID</label>
    	<input type="text" name="nfcid" id="nfcid">
    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Γύρνα πίσω ρε</a>

<?php require "templates/footer.php"; ?>