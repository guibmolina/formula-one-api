<?php

namespace App\Controller;

use App\Helper\ProcessRequest;
use App\Helper\TeamFactory;
use App\Repository\TeamRepository;
use Doctrine\ORM\EntityManagerInterface;

class TeamController extends BaseController
{
    /**
     * TeamController constructor.
     *
     * @param TeamRepository $teamRepository
     * @param TeamFactory $factory
     * @param EntityManagerInterface $entityManager
     * @param ProcessRequest $processRequest
     */
    public function __construct(
        TeamRepository $teamRepository,
        TeamFactory $factory,
        EntityManagerInterface $entityManager,
        ProcessRequest $processRequest
    ) {
        parent::__construct($teamRepository, $factory, $entityManager, $processRequest);
    }

    public function updateEntity($entity, $requestEntity)
    {
        $entity->setName($requestEntity->getName());
        $entity->setBorn($requestEntity->getBorn());
        $entity->setLocation($requestEntity->getLocation());
        $entity->setPhoto($requestEntity->getPhoto());
    }
}
