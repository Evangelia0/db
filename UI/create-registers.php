<?php if (isset($_POST['submit'])) {
  require "config.php";
  require "common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

   $new_area = array(
        "ID_area" => $_POST['ID_area'],
        "Service_ID"  => $_POST['Service_ID'],
    );
 $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"area",
implode(", ", array_keys($new_area)),
":" . implode(", :", array_keys($new_area))
    );

    $statement = $connection->prepare($sql);
    $statement->execute($new_area);
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }

}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) { ?>
  > <?php echo $_POST['Service_ID']; ?> successfully added.
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
    	<label for="Service_ID">Service_ID</label>
    	<input type="text" name="Service_ID" id="Service_ID">
    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

    <?php require "templates/footer.php"; ?>