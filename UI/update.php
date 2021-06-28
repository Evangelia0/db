<?php 
try {
  require "config.php";
  require "common.php";

  $connection = new PDO($dsn, $username, $password, $options);

  $sql = "SELECT * FROM Client";

  $statement = $connection->prepare($sql);
  $statement->execute();

  $result = $statement->fetchAll();

} catch(PDOException $error) {
  echo $sql . "<br>" . $error->getMessage();
}

require "templates/header.php"; ?>

<h2>Update Clients</h2>

<table>
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Date of Birth</th>
      <th>Document of ID</th>
      <th>email</th>
      <th>phone number</th>
	  <th>NFC ID</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($result as $row) : ?>
    <tr>
      <td><?php echo escape($row["first_name"]); ?></td>
      <td><?php echo escape($row["last_name"]); ?></td>
      <td><?php echo escape($row["date_of_birth"]); ?></td>
      <td><?php echo escape($row["document_of_id"]); ?></td>
      <td><?php echo escape($row["email"]); ?></td>
      <td><?php echo escape($row["phone_number"]); ?></td>
      <td><?php echo escape($row["NFC_ID"]); ?> </td>
	  <td><a href="update-single.php?id=<?php echo escape($row["NFC_ID"]); ?>">Edit</a>
  </tr>
  <?php endforeach; ?>
  </tbody>
</table>

<a href="index.php">Back to home</a>