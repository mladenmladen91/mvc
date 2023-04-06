<?php

namespace App\Models;

use PDO;

class Address extends Model
{
    protected $table = 'addresses';

    public function paginate(int $page): object
    {
        $limit = 50;
        // getting count for pagination
        $stCount = "SELECT count(*) as count FROM addresses";
        $statementCount = $this->conn->prepare($stCount);
        $statementCount->execute();
        $count = $statementCount->fetch()["count"];
        $pages = ceil($count / $limit);

        $offset = $page > 0 ? (($page - 1) * $limit) : 0;

        // getting data for products
        $st = "SELECT * FROM addresses LIMIT :off, :lim";
        $statement = $this->conn->prepare($st);
        $statement->bindValue(':off', $offset, PDO::PARAM_INT);
        $statement->bindValue(':lim', $limit, PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetchAll();

        return (object)["products" => $data, "pages" => $pages];
    }

    public function save(array $data)
    {
        $firstName = $data["first_name"];
        $lastName = $data["last_name"];
        $street = $data["street"];
        $postal = $data["postal"];
        $city = $data["city"];
        
        $st = "INSERT INTO addresses (first_name, last_name, street, postal, city) VALUES( :firstName, :lastName, :street, :postal, :city)";
        $statement = $this->conn->prepare($st);
        $statement->execute([
            ":firstName" => $firstName,
            ":lastName" => $lastName,
            ":street" => $street,
            ":postal" => $postal,
            ":city" => $city
        ]);
    }
}
