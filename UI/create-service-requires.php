<?php if (isset($_POST['submit'])) {
  require "config.php";
  require "common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

   $new_client = array(
        "Service_ID_Regis" => $_POST['Service_ID_Regis'],
       
    );
 $sql = sprintf(
"INSERT INTO %s (%s) values (%s)",
"Service_requires_registration",
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
  > <?php echo $_POST['Service_ID_Regis']; ?> successfully added.
<?php } ?>

<h2>Add a Service which requires registration</h2>
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="css/styles.css" rel="stylesheet">

</head>
<form method="post">
        <label for="Service_ID_Regis">Service_ID_Regis</label>
    	<input type="text" name="Service_ID_Regis" id="Service_ID_Regis">

    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

    <?php require "templates/footer.php"; ?>