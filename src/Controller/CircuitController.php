<?php

namespace App\Controller;

use App\Helper\CircuitFactory;
use App\Helper\Factory;
use App\Helper\ProcessRequest;
use App\Repository\CircuitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class CircuitController extends BaseController
{
    /**
     * CircuitController constructor.
     *
     * @param CircuitRepository $repository
     * @param CircuitFactory $factory
     * @param EntityManagerInterface $entityManager
     * @param ProcessRequest $processRequest
     */
    public function __construct(
        CircuitRepository $repository,
        CircuitFactory $factory,
        EntityManagerInterface $entityManager,
        ProcessRequest $processRequest
    ) {
        parent::__construct($repository, $factory, $entityManager, $processRequest);
    }

    /**
     * @param $entity
     * @param $requestEntity
     *
     * @return mixed|void
     */
    public function updateEntity($entity, $requestEntity)
    {
        $entity->setName($requestEntity->getName());
        $entity->setLocation($requestEntity->getLocation());
        $entity->setFastLap($requestEntity->getFastLap());
        $entity->setFastLapDriver($requestEntity->getFastLapDriver());
        $entity->setPhoto($requestEntity->getPhoto());
    }
}
