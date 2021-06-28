<?php

/**
  * Use an HTML form to edit an entry in the
  * users table.
  *
  */

require "config.php";
require "common.php";
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $client=[
       "first_name" => $_POST['first_name'],
      "last_name"  => $_POST['last_name'],
	  "date_of_birth"   => $_POST['date_of_birth'],
      "email" => $_POST['email'],
      "document_of_id" => $_POST['document_of_id'],
	  "phone_number" => $_POST['phone_number'],
      "NFC_ID"  => $_POST['NFC_ID']
    ];

    $sql = "UPDATE Client
            SET 
              first_name = :first_name,
              last_name = :last_name,
			  date_of_birth = :date_of_birth,
              email = :email,
              document_of_id =:document_of_id,
              phone_number =:phone_number,
              NFC_ID =: NFC_ID,
            WHERE NFC_ID = :NFC_ID";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}
if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $NFC_ID = $_GET['id'];

    $sql = "SELECT * FROM Client WHERE NFC_ID = :NFC_ID";
    $statement = $connection->prepare($sql);
    $statement->bindValue(':NFC_ID', $NFC_ID);
    $statement->execute();

    $client = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
  echo "Something went wrong!";
  exit;
}
?>
<?php require "templates/header.php"; ?>

`<h2>Edit a Client</h2>

<form method="post">
    <?php foreach ($client as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'NFC_ID' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>
?>