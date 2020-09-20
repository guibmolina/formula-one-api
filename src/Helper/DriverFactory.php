<?php

namespace App\Helper;

use DateTime;
use App\Entity\Driver;
use App\Repository\TeamRepository;

class DriverFactory implements Factory
{
    /**
     * @var TeamRepository
     */
    private $teamRepository;

    /**
     * DriverFactory constructor.
     *
     * @param TeamRepository $teamRepository
     */
    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * @param \stdClass $requestData
     *
     * @return Driver
     */
    public function createEntity(\stdClass $requestData): Driver
    {
        $team = $this->teamRepository->find($requestData->team_id);


        $driver = new Driver();
        $date = new DateTime($requestData->born);
        $born = $date->format('Y-m-d H:i:s');
        $driver->setName($requestData->name);
        $driver->setBorn($born);
        $driver->setLocation($requestData->location);
        $driver->setRaceWins($requestData->race_wins);
        $driver->setChampionshipWin($requestData->championship_win);
        $driver->setPhoto($requestData->photo);
        $driver->setTeam($team);

        return $driver;
    }
}
