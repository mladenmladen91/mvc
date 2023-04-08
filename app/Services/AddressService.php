<?php


namespace App\Services;

use App\Repositories\AddressRepository;


class AddressService
{
    private array $errors = [];

    public $addressRepository;

    public function __construct()
    {
        $this->addressRepository = new AddressRepository();
    }

    // getting product data
    public function paginate($page) : object
    {
        return $this->addressRepository->paginate($page);
    }
    // accepting the request and pass it to the saving repository
    public function create($request): array
    {
        // check address first
        $this->checkAddress($request);
        // if no errors continue
        if (count($this->errors) === 0) {

            $this->addressRepository->create($request);
        }

        return $this->errors;
    }

    protected function checkAddress($request) : void
    {
        // create a new cURL resource
        $url = 'https://interview.performance-technologies.de/api/address?token=' . API_TOKEN . '&city=' . urlencode($request["city"]) . '&street=' . urlencode($request["street"]) . '&postal=' . urlencode($request["postal"]) . '&country=' . urlencode($request["country"]);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = json_decode(curl_exec($ch), true);
        curl_close($ch);

        if ($result["success"] === "false") {
            foreach ($result["error"] as $key => $value) {
                $this->errors[$key] = $value[0];
            }
        }
    }
}
