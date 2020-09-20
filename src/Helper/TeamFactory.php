<?php

namespace App\Helper;

use App\Entity\Team;
use DateTime;

class TeamFactory implements Factory
{
    public function createEntity(\stdClass $requestData): Team
    {
        $team = new Team();
        $date = new DateTime($requestData->born);
        $born = $date->format('Y-m-d H:i:s');
        $team->setName($requestData->name);
        $team->setBorn($born);
        $team->setLocation($requestData->location);
        $team->setPhoto($requestData->photo);

        return $team;
    }
}
