<?php

namespace App\Controller;

use App\Helper\DriverFactory;
use App\Helper\ProcessRequest;
use App\Repository\DriverRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DriverController extends BaseController
{
    /**
     * @var DriverRepository
     */
    private $repository;

    /**
     * PilotController constructor.
     *
     * @param DriverRepository $repository
     * @param DriverFactory $factory
     * @param EntityManagerInterface $entityManager
     * @param ProcessRequest $processRequest
     */
    public function __construct(
        DriverRepository $repository,
        DriverFactory $factory,
        EntityManagerInterface $entityManager,
        ProcessRequest $processRequest
    ) {
        $this->repository = $repository;
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
        $entity->setBorn($requestEntity->getBorn());
        $entity->setLocation($requestEntity->getLocation());
        $entity->setRaceWins($requestEntity->getRaceWins());
        $entity->setChampionshipWin($entity->getChampionsipWin());
        $entity->setPhoto($entity->getPhoto());
        $entity->setTeam($requestEntity->getTeam());
    }

    /**
     * @param $teamId
     *
     * @return JsonResponse
     */
    public function getDriverTeam(int $teamId): JsonResponse
    {
        $drivers = $this->repository->findBy(['team' => $teamId]);

        return new JsonResponse($drivers);
    }

    public function welcome(): Response
    {
        return new Response("FORMULA ONE API");
    }
}
