<?php if (isset($_POST['submit'])) {
  require "config.php";
  require "common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

   $new_client = array(
      "first_name" => $_POST['first_name'],
      "last_name"  => $_POST['last_name'],
	  "date_of_birth"   => $_POST['date_of_birth'],
      "email" => $_POST['email'],
      "document_of_id" => $_POST['document_of_id'],
	  "phone_number" => $_POST['phone_number'],
      "NFC_ID"  => $_POST['NFC_ID']
    );
 $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"Client",
implode(", ", array_keys($new_client)),
":" . implode(", :", array_keys($new_client))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_client);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php echo $_POST['first_name']; ?> successfully added.
<?php } ?>

<h2>Add a user</h2>

<form method="post">
    	<label for="first_name">first_name</label>
    	<input type="text" name="first_name" id="first_name">
    	<label for="last_name">last_name</label>
    	<input type="text" name="last_name" id="last_name">
		<label for="date_of_birth">date_of_birth</label>
    	<input type="text" name="date_of_birth" id="date_of_birth">
    	<label for="email">email</label>
    	<input type="text" name="email" id="email">
		<label for="phone_number">phone_number</label>
    	<input type="text" name="phone_number" id="phone_number">
    	<label for="document_of_id">document_of_id</label>
    	<input type="text" name="document_of_id" id="document_of_id">
    	<label for="NFC_ID">NFC_ID</label>
    	<input type="text" name="NFC_ID" id="NFC_ID">
    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

    <?php require "templates/footer.php"; ?>