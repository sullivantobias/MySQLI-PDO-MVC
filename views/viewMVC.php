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

echo '</br>========================== MVC Section ========================== </br>';
include ("../controler.php");

$oneControler = new Controler ("localhost", "Logiciels", "root", "root");
$oneControler -> setTable ("logiciels");

/** MVC SELECT ALL REQUEST */
$res = $oneControler -> selectAll();

foreach ($res as $key => $value) {
    echo "Iteration number : ".$key."</br>";
    echo "id : ".$value[1]." / Name : ".$value[0]."</br></br>";
}

/** MVC SELECT WHERE REQUEST */
$whereSelect = ["id" => 1];
$res = $oneControler -> selectWhere($whereSelect);

echo $res[0]." / Made By Select Where Request";

/** MVC INSERT REQUEST */
if (isset($_POST['insert'])) {

    $nameToInsert = $_POST['name'];
    $idToInsert = $_POST['id'];

    $tab = [
        "name" => $nameToInsert,
        "id" => $idToInsert
    ];

    $oneControler -> insert ($tab);
}

/** MVC DELETE REQUEST */
if (isset($_POST['delete'])) {

    $idToDelete = $_POST['idToDelete'];

    $tab = [ "id" => $idToDelete ];

    $oneControler -> deleting ($tab);

}

/** MVC UPDATE REQUEST */
if (isset($_POST['changed'])) {

    $idToUpdate = $_POST['idToUpdate'];
    $nameToUpdate = $_POST['nameChanged'];

    $where = [ "id" => $idToUpdate ];
    $tab = [ "name" => $nameToUpdate ];

    $oneControler -> update ($tab, $where);
}

?>