<?php
class dbHandler
{
    private $dataSource = "mysql:host=localhost;dbname=superheroes;";
    private $username = "root";
    private $password = "password";
    
    public function selectSuperheroes()
    {
        try{
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("Select * from superheroes");
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $rows;
        }
        catch(PDOException $exception){
            return false;
        }
    }

    public function createHero($name, $publisher){
        try{
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("Insert into superheroes(name, publisher) VALUES(:name, :publisher)");
            $statement->bindValue("name", $name, PDO::PARAM_STR);
            $statement->bindValue("publisher", $publisher, PDO::PARAM_STR);
    
            $statement->execute();
            return true;
        }
        catch(PDOException $exception){
            return false;
        }
    }

    public function selectOne($superHeroId){
        try{
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("Select * from superheroes WHERE superheroId = :id");
            $statement->bindParam("id", $superHeroId, PDO::PARAM_INT);
            $statement->execute();
            $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $rows[0];
        }
        catch(PDOException $exception){
            return false;
        }
    }

    public function updateHero($superHeroId, $name, $publisher){
        try{
            $pdo = new PDO($this->dataSource, $this->username, $this->password);
            $statement = $pdo->prepare("UPDATE superheroes SET name=:thename, publisher=:publisher WHERE superheroId = :id");
            $statement->bindParam("id", $superHeroId, PDO::PARAM_INT);
            $statement->bindParam("thename", $name, PDO::PARAM_STR);
            $statement->bindParam("publisher", $publisher, PDO::PARAM_STR);
            $statement->execute();
            return true;
        }
        catch(PDOException $exception){
            return false;
        }
    }

     //Delete
    public function deleteHero($id){
        try{
            $pdo = new PDO($this->dataSource, $this->username, $this->password);

            $statement = $pdo->prepare("DELETE FROM superheroes WHERE superheroId = :id");

            $statement->bindValue(":id", $id, PDO::PARAM_INT);

            $statement->execute();
            return true;
        }
        catch(PDOException $e){
            return false;
        }

    }
}
?>