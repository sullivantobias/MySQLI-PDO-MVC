<?php
include ("model.php");
class Controler {
    private $oneModel;

    public function __construct ($serv, $dbname, $user, $pass) {
        $this -> oneModel = new Model ($serv, $dbname, $user, $pass);
    }

    public function setTable ($table) {
        $this -> oneModel -> setTable($table);
    }

    public function selectAll() {
        return $this -> oneModel -> selectAll();
    }

    public function insert ($tab) {
        $this -> oneModel -> insert ($tab);
    }

    public function selectWhere ($where) {
        return $this -> oneModel -> selectWhere($where);
    }

    public function deleting ($where) {
        $this -> oneModel -> deleting ($where);
    }

    public function update ($tab, $where) {
        $this -> oneModel -> update ($tab, $where);
    }
}
?>