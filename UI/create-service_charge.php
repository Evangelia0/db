<?php if (isset($_POST['submit'])) {
  require "config.php";
  require "common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

   $new_client = array(
      "ID_area" => $_POST['ID_area'],
      "Area_name"  => $_POST['Area_name'],
	  "description_of_area" => $_POST['description_of_area'],
      "Num_of_rooms"     => $_POST['Num_of_rooms'],
    
    );
 $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"service_charge",
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
  > <?php echo $_POST['ID_area']; ?> successfully added.
<?php } ?>

<h2>Add a user</h2>
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="css/styles.css" rel="stylesheet">

</head>
<form method="post">
    	<label for="ID_area">ID_area</label>
    	<input type="text" name="ID_area" id="ID_area">
    	<label for="Area_name">Area_name</label>
    	<input type="text" name="Area_name" id="Area_name">
		  <label for="description_of_area">description_of_area</label>
    	<input type="text" name="description_of_area" id="description_of_area">
    	<label for="Num_of_rooms">Num_of_rooms</label>
    	<input type="text" name="Num_of_rooms" id="Num_of_rooms">
    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

    <?php require "templates/footer.php"; ?>