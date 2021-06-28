c<?php
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

    $sql = "SELECT *
    FROM service_charge
    WHERE NFC_ID = :NFC_ID ";

    $NFC_ID = $_POST['NFC_ID'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':NFC_ID', $NFC_ID, PDO::PARAM_STR);
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
  <th>Date of charge</th>
  <th>NFC_ID</th>
  <th>Amount</th>
  <th>NFC_ID</th>
  <th>Service_ID</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["date_of_charge"]); ?></td>

<td><?php echo escape($row["NFC_ID"]); ?></td>
<td><?php echo escape($row["amount"]); ?></td>
<td><?php echo escape($row["NFC_ID"]); ?></td>
<td><?php echo escape($row["Service_ID"]); ?> </td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['NFC_ID']); ?>.
  <?php }
} ?>

<h2>Find user based on criteria</h2>

<form method="post">
  <label for="NFC_ID">NFC_ID</label>
  <input type="text" id="NFC_ID" name="NFC_ID">
  <input type="submit" name="submit" value="View Results">
</form>

<a href="index.php">Back to home</a>
<link rel="stylesheet" href="css/style.css">

<?php require "templates/footer.php";