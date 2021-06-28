<?php if (isset($_POST['submit'])) {
  require "config.php";
  require "common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

   $new_area = array(
        "NFC_ID" => $_POST['NFC_ID'],
        "ID_area" => $_POST['ID_area'],
        "Start_time"  => $_POST['Start_time'],
        "End_time"    => $_POST['End_time'],
    
    );
 $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"Visits",
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
        <label for="NFC_ID">NFC_ID</label>
    	<input type="text" name="NFC_ID" id="NFC_ID">
    	<label for="ID_area">ID_area</label>
    	<input type="text" name="ID_area" id="ID_area">
    	<label for="Start_time">Start_time</label>
    	<input type="text" name="Start_time" id="Start_time">
    	<label for="End_time">End_time</label>
    	<input type="text" name="End_time" id="End_time">s
    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

    <?php require "templates/footer.php"; ?>