<!DOCTYPE html>
<html>
<head>
  <title>PDO Examples.</title>
</head>
<body>
<h1>PDO EXAMPLES</h1>
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

echo '</br>========================== PDO Section ========================== </br>';
$pdo = new PDO ("mysql:host=localhost;dbname=Logiciels", "root", "root");

/** PDO SELECT ALL REQUEST */
$selectAllRequest = "SELECT * FROM logiciels";
$selectAll = $pdo -> prepare ($selectAllRequest);
$selectAll -> execute ();
$res = $selectAll -> fetchAll ();

foreach ($res as $key => $value) {
  echo "Iteration number : ".$key."</br>";
  echo "id : ".$value[1]." / Name : ".$value[0]."</br></br>";
}

/** PDO SELECT WHERE REQUEST */
$selectWhereRequest = "SELECT * FROM logiciels WHERE id = 4";
$selectWhere = $pdo -> query ($selectWhereRequest);
$resWhere = $selectWhere -> fetch ()[0];

echo $resWhere;

/** PDO INSERT REQUEST */
if (isset($_POST['insert'])) {

  $nameToInsert = $_POST['name'];
  $idToInsert = $_POST['id'];

  $insertRequest = "INSERT INTO logiciels VALUES (:name, :id)";
  $insert = $pdo -> prepare ($insertRequest);
  $insert -> execute (array (
      "name" => $nameToInsert,
      "id" => $idToInsert
  ));

}

/** PDO DELETE REQUEST */
if (isset($_POST['delete'])) {

  $idToDelete = $_POST['idToDelete'];

  $deleteRequest = "DELETE FROM logiciels WHERE id = :id";
  $delete = $pdo -> prepare ($deleteRequest);
  $delete -> execute (array(
      "id" => $idToDelete
  ));

}

/** PDO UPDATE REQUEST */
if (isset($_POST['changed'])) {

  $idToUpdate = $_POST['idToUpdate'];
  $nameToUpdate = $_POST['nameChanged'];

  $updateRequest = "UPDATE logiciels SET name = :name WHERE id = :id";
  $update = $pdo -> prepare ($updateRequest);
  $update -> execute (array(
      "name" => $nameToUpdate,
      "id" => $idToUpdate
  ));

}

?>