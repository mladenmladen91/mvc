<?php


namespace App\Interfaces;


interface AddressRepositoryInterface
{

    public function paginate(int $page) : object;

    public function create(array $request) : void;
}