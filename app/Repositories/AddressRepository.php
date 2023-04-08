<?php

namespace App\Repositories;

use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;


class AddressRepository implements AddressRepositoryInterface
{
    
    private $address;

    public function __construct()
    {
        $this->address = new Address();
    }

    public function paginate($page): object
    {
        return $this->address->paginate($page);
    }
    
    public function create($request) : void
    {
        //$address = new Address();
        $this->address->save([
            "first_name" => $request["first_name"],
            "last_name" => $request["last_name"],
            "street" => $request["street"],
            "postal" => $request["postal"],
            "city" => $request["city"],
            "country" => $request["country"]
        ]);
    }
}
