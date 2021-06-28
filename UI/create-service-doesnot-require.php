<?php if (isset($_POST['submit'])) {
  require "config.php";
  require "common.php";

  try {
    $connection = new PDO($dsn, $username, $password, $options);

   $new_client = array(
        "Service_ID_NonRegis" => $_POST['Service_ID_NonRegis'],
       
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
  > <?php echo $_POST['Service_ID_NonRegis']; ?> successfully added.
<?php } ?>

<h2>Add a Service which doesn't require registration</h2>
<head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <link href="css/styles.css" rel="stylesheet">

</head>
<form method="post">
        <label for="Service_ID_NonRegis"> Service_ID_NonRegis</label>
    	<input type="text" name="Service_ID_NonRegis" id="Service_ID_NonRegis">

    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="index.php">Back to home</a>

    <?php require "templates/footer.php"; ?>