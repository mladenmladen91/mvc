<?php

namespace App\Http\Controllers;

use App\Models\Address;

use App\Services\AddressService;

use App\Interfaces\AddressRepositoryInterface;

use App\Http\Request;

use App\Validators\Validator;

class AddressController
{

    public function index()
    {
        // getting request data
        $request = (new Request())->getParams;
        // getting validation results
        $errors = (new Validator())->validate($request, [
            'page' => 'integer'
        ]);


        // check if there is an errors
        if (count($errors) === 0) {
            // load addresses
            $page = $request["page"] ?? 0;
            $addressService = new AddressService();
            $data = $addressService->paginate($page);
        }

        require_once APP_ROOT . '/views/index.php';
    }

    public function create()
    {

        $request = (new Request());

        if ($request->method === 'POST') {
            $requestParams = $request->postParams;
            // validating request
            $errors = (new Validator())->validate($requestParams, [
                'first_name' => 'required',
                'last_name' => 'required',
                'street' => 'required',
                'postal' => 'required',
                'city' => 'required',
            ]);

            if (count($errors) === 0) {

                $addressService = new AddressService();
                $errorsCheck = $addressService->create($requestParams);

                if (count($errorsCheck) > 0) {
                   $errors = [...$errors, ...$errorsCheck];
                }
               
//var_dump($errorsCheck);
                // create a new cURL resource
                /*$url = 'https://interview.performance-technologies.de/api/address?token=' . API_TOKEN . '&city=' . urlencode($requestParams["city"]) . '&street=' . urlencode($requestParams["street"]) . '&postal=' . urlencode($requestParams["postal"]) . '&country=' . urlencode($requestParams["country"]);
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $result = json_decode(curl_exec($ch), true);
                curl_close($ch);

                if ($result["success"] === "false") {
                    foreach ($result["error"] as $key => $value) {
                        $errors[$key] = $value[0];
                    }
                }

                if (count($errors) === 0) {
                    $address = new Address();
                    $address->save([
                        "first_name" => $requestParams["first_name"],
                        "last_name" => $requestParams["last_name"],
                        "street" => $requestParams["street"],
                        "postal" => $requestParams["postal"],
                        "city" => $requestParams["city"],
                        "country" => $requestParams["country"]
                    ]);  
                }
                */
            }

            // getting request data


            // check if there is an errors
            /* if (count($errors) === 0) {
                // load addresses
                $data = $address->paginate(0, 100);
            }*/
        }



        require_once APP_ROOT . '/views/create.php';
    }
}
