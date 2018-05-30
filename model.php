<?php

class Model {
    private $pdo, $table;

    public function __construct ($serv, $dbname, $user, $pass) {
        $this -> pdo = null;

        try {
            $this -> pdo = new PDO ("mysql:host=".$serv.";dbname=".$dbname, $user, $pass);
            echo "</br>Connected</br>";
        } catch (Exception $e) {
            echo "Not Connected";
        }
    }

    public function setTable($table) {
        $this -> table = $table;
    }

    public function selectAll () {
        if($this -> pdo != null) {
            $req = "SELECT * FROM ".$this -> table;
            $selectAll = $this -> pdo -> prepare ($req);
            $selectAll -> execute ();
            return $selectAll -> fetchAll();
        }
    }

    public function insert ($tab) {
        $fields = [];
        $data = [];

        foreach ($tab as $key => $value) {
            $fields [] = ":".$key;
            $data [":".$key] = $value;
        }

        $resFields = implode (",", $fields);

        if ($this -> pdo != null) {
            $req = "INSERT INTO ".$this -> table." VALUES (".$resFields.");";
            $insert = $this -> pdo -> prepare ($req);
            $insert -> execute ($data);
        }
    }

    public function deleting ($where) {
        $fields = [];
        $data = [];

        foreach ($where as $key => $value) {
            $fields [] = $key."=:".$key;
            $data [":".$key] = $value;
        }

        $resFields = implode ("and", $fields);

        if ($this -> pdo != null) {
            $req = "DELETE FROM ".$this -> table." where ".$resFields;
            $delete = $this -> pdo -> prepare ($req);
            $delete -> execute ($data);
        }
    }

        public function selectWhere ($whereTab) {
            $fields = [];
            $data = [];

        foreach ($whereTab as $key => $value) {
            $fields [] = $key."=:".$key;
            $data [":".$key] = $value;
        }

        $resFields = implode ("and", $fields);

        if ($this -> pdo != null) {
            $req = "SELECT * FROM ".$this -> table." WHERE ".$resFields;
            $selectWhere = $this -> pdo -> prepare ($req);
            $selectWhere -> execute ($data);
            return $selectWhere -> fetch();
        }
    }

        public function update ($tab, $where) {
        $fields = [];
        $data = [];
        $clause = [];

        foreach ($tab as $key => $value) {
            $fields [] = $key."=:".$key;
            $data [":".$key] = $value;
        }

        $resFields = implode (",", $fields);

        foreach ($where as $key => $value) {
            $clause [] = $key."=:".$key;
            $data [":".$key] = $value;
        }

        $resClause = implode ("and", $clause);

        if ($this -> pdo != null) {
            $req = "UPDATE ".$this -> table." SET ".$resFields." WHERE ".$resClause;
            $update = $this -> pdo -> prepare ($req);
            $update -> execute ($data);
        }
    }
}

?>