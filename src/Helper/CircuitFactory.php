<?php

namespace App\Helper;

use App\Entity\Circuit;

class CircuitFactory implements Factory
{

    public function createEntity(\stdClass $requestData)
    {
        $circuit = new Circuit();
        $circuit->setName($requestData->name);
        $circuit->setLocation($requestData->location);
        $circuit->setFastLap($requestData->fast_lap);
        $circuit->setFastLapDriver($requestData->fast_lap_driver);
        $circuit->setPhoto($requestData->photo);

        return $circuit;
    }
}
