<?php

namespace App\Controller;

use App\Facade\FileImport;

class AddressController
{
    public function index()
    {
        $addresses = require_once FileImport::generatePath('resource/address.php');

//        foreach ($addresses as $address) {
//            preg_match(
//                '/^([0-9.-])+(.)*$/',
//                $address,
//                $matches,
//                PREG_OFFSET_CAPTURE
//            );
//        }
    }
}
