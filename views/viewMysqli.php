<!DOCTYPE html>
<html>
<head>
  <title>MYSQLI Examples.</title>
</head>
<body>
<h1>MYSQLI EXAMPLES</h1>
  <form method="post" action="">
    Name <input type="text" name="name">
    ID <input type="number" name="id">
    <input type="submit" name="insert">
  </form>
</br>
  <form method="post" action="">
    ID <input type="number" name="idToDelete">
    <input type="submit" name="delete">
  </form>
  </br>
  <form method="post" action="">
    ID <input type="number" name="idToUpdate">
    Changed <input type="text" name="nameChanged">
    <input type="submit" name="changed">
  </form>
</body>
</html>
<?php 

echo '</br>========================== MYSQLI Section ========================== </br>';
$mysqli = new mysqli ("localhost", "root", "root", "Logiciels");

/** MYSQLI SELECT ALL REQUEST */
$selectAllRequest = "SELECT * FROM logiciels";
$selectAll = $mysqli -> query ($selectAllRequest);
$res = $selectAll -> fetch_all ();

foreach ($res as $key => $value) {
  echo "Iteration number : ".$key."</br>";
  echo "id : ".$value[1]." / Name : ".$value[0]."</br></br>";
}

/** MYSQLI SELECT WHERE REQUEST */
$selectWhereRequest = "SELECT * FROM logiciels WHERE id = 4";
$selectWhere = $mysqli -> query ($selectWhereRequest);
$resWhere = $selectWhere -> fetch_all ();

foreach ($resWhere as $key => $value) {
  echo "Name : ".$value[0];
}

/** MYSQLI INSERT REQUEST */
if (isset($_POST['insert'])) {

  $nameToInsert = $_POST['name'];
  $idToInsert = $_POST['id'];

  $insertRequest = "INSERT INTO logiciels VALUES (?,?)";
  $insert = $mysqli -> prepare ($insertRequest);
  $insert -> bind_param("si", $nameToInsert, $idToInsert);
  $insert -> execute ();

}

/** MYSQLI DELETE REQUEST */
if (isset($_POST['delete'])) {

  $idToDelete = $_POST['idToDelete'];

  $deleteRequest = "DELETE FROM logiciels WHERE id = ?";
  $delete = $mysqli -> prepare ($deleteRequest);
  $delete -> bind_param("i", $idToDelete);
  $delete -> execute ();

}

/** MYSQLI UPDATE REQUEST */
if (isset($_POST['changed'])) {

  $idToDelete = $_POST['idToUpdate'];
  $nameToUpdate = $_POST['nameChanged'];

  $updateRequest = "UPDATE logiciels SET name =? WHERE id = ?";
  $update = $mysqli -> prepare ($updateRequest);
  $update -> bind_param("si", $nameToUpdate, $idToDelete);
  $update -> execute ();

}

?>