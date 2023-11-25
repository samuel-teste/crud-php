<?php


class Crud{
    public ?\PDO $pdo = null;

    public function connect(){
        $this->pdo = new PDO("mysql:host=localhost;dbname=crud", "root", "");

        return $this->pdo;
    }

    public function create(){
        if($_POST['criar']){
            $title = $_POST['title'];
            
            // Inserir
            $db = $this->connect()->prepare("INSERT INTO films VALUES (null,?)");
            $db->execute([$title]);
        }
    }

    public function list($id = 0){
        if($id == 0){
            $db = $this->connect()->prepare("SELECT * FROM films");
            $db->execute();
        }else{
            $db = $this->connect()->prepare("SELECT * FROM films WHERE id = ?");
            $db->execute([$id]);
        }

        return $db->fetchAll();
    }

    public function delete($id){
        $db = $this->connect()->prepare("DELETE FROM films WHERE id = ?");
        $db->execute([$id]);

        if($db->fetchAll() != 0){
            return true;
        }

        return false;
    }

    public function update($id){
        $db = $this->connect()->prepare("UPDATE films SET title = ? WHERE id = ?");
        $db->execute([$_POST['title'], $id]);

        if($db->fetchAll() != 0){
            header("Location: index.php");
            return true;
        }

        return false;
    }
}