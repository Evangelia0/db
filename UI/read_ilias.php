<?php
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


    
			
	$sql = "SELECT NFC_ID, start_time, end_time, Area_name
			FROM visits,area
			WHERE NFC_ID = :NFC_ID and visits.ID_area = area.ID_area";

    $NFC_ID = $_POST['NFC_ID'];

    $statement = $connection->prepare($sql);
    $statement->bindParam(':NFC_ID', $NFC_ID, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetchAll();
	
	$sql1 = "SELECT distinct cl.NFC_ID, cl.first_name, cl.last_name, v.start_time, v.end_time, Coroniarides.area_name
			FROM (
			SELECT NFC_ID, Start_time, End_time, Area_name
			FROM visits,area
			WHERE NFC_ID = :NFC_ID and visits.ID_area = area.ID_area
			
			
			) Coroniarides
			INNER JOIN visits as v on v.NFC_ID = Coroniarides.NFC_ID
			INNER JOIN visits as v2 on 
			v2.start_time BETWEEN DATE_ADD(v.start_time, INTERVAL -1 HOUR) AND DATE_ADD(v.end_time, INTERVAL 1 HOUR)
			OR
			v2.end_time BETWEEN DATE_ADD(v.start_time, INTERVAL -1 HOUR) AND DATE_ADD(v.end_time, INTERVAL 1 HOUR)
			INNER JOIN Client cl on v2.NFC_ID = cl.NFC_ID
			LEFT JOIN Client c2 ON cl.NFC_ID = c2.NFC_ID
			
			;";
			
			$statement = $connection->prepare($sql1);
			$statement->bindParam(':NFC_ID', $NFC_ID, PDO::PARAM_STR);
			$statement->execute();

			$result1 = $statement->fetchAll();
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
?>
<?php require "templates/header.php"; ?>

<?php
if (isset($_POST['submit'])) {
  if ($result1 && $statement->rowCount() > 0) { ?>
    <h2>Possible Infections</h2>
	 

    <table>
      <thead>
<tr>
   <th>NFC</th>
   <th>First Name</th>
   <th>Last Name</th>
  <th>Area name</th>
  <th>Start Time</th>
  <th>End Time</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result1 as $row) { ?>
      <tr>
<td><?php echo escape($row["NFC_ID"]); ?> </td>
<td><?php echo escape($row["first_name"]); ?> </td>
<td><?php echo escape($row["last_name"]); ?> </td>
<td><?php echo escape($row["Area_name"]); ?> </td>
<td><?php echo escape($row["start_time"]); ?></td>
<td><?php echo escape($row["end_time"]); ?></td>

      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['NFC_ID']); ?>.
  <?php }


if ($result && $statement->rowCount() > 0) { ?>
    <h2>Areas and Timelines visited by Covid patient</h2>
	 

    <table>
      <thead>
<tr>
   <th>NFC</th>
  <th>Area name</th>
  <th>Start Time</th>
  <th>End Time</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["NFC_ID"]); ?> </td>
<td><?php echo escape($row["Area_name"]); ?> </td>
<td><?php echo escape($row["start_time"]); ?></td>
<td><?php echo escape($row["end_time"]); ?></td>

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