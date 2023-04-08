<?php

namespace App\Models;

use PDO;

class Address extends Model
{
    protected $table = 'addresses';

    public function paginate(int $page) : object
    {
        $limit = 50;
        // getting count for pagination
        $stCount = "SELECT count(*) as count FROM addresses";
        $statementCount = $this->conn->prepare($stCount);
        $statementCount->execute();
        $count = $statementCount->fetch()["count"];
        $pages = (int)ceil($count / $limit);

        $offset = ($page - 1) * $limit;

        // getting data for products
        $st = "SELECT * FROM addresses LIMIT :off, :lim";
        $statement = $this->conn->prepare($st);
        $statement->bindValue(':off', $offset, PDO::PARAM_INT);
        $statement->bindValue(':lim', $limit, PDO::PARAM_INT);
        $statement->execute();
        $data = $statement->fetchAll();

        // setting data for pagination
        $dataPage = ($page > 0 && $page <= $pages) ? $page : 1;
        $next = ($page + 1 <= $pages)  ? $page + 1 : null;
        $previous = ($page > 1)  ? $page - 1 : null;

        return (object)["products" => $data, "pages" => $pages, "page" => $dataPage, "next" => $next, "previous" => $previous];
    }

    public function save(array $data) : void
    {
        $st = "INSERT INTO addresses (first_name, last_name, street, postal, city) VALUES( :firstName, :lastName, :street, :postal, :city)";
        $statement = $this->conn->prepare($st);
        $statement->execute([
            ":firstName" => $data["first_name"],
            ":lastName" => $data["last_name"],
            ":street" => $data["street"],
            ":postal" => $data["postal"],
            ":city" => $data["city"]
        ]);
    }
}
