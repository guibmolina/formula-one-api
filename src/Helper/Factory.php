<?php


namespace App\Helper;


interface Factory
{
    public function createEntity(\stdClass $requestData);
}