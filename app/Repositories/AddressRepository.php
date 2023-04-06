<?php

namespace App\Repositories;

use App\Interfaces\AddressRepositoryInterface;
use App\Models\Address;


class AddressRepository implements AddressRepositoryInterface
{
       
    public function paginate($page): object
    {
        $address = new Address();
        return $address->paginate($page);
    }
    
    public function create($request) : void
    {
        $address = new Address();
        $address->save([
            "first_name" => $request["first_name"],
            "last_name" => $request["last_name"],
            "street" => $request["street"],
            "postal" => $request["postal"],
            "city" => $request["city"],
            "country" => $request["country"]
        ]);
    }
}
