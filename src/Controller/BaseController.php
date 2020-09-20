<?php

namespace App\Controller;

use App\Helper\Factory;
use App\Helper\ProcessRequest;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends AbstractController
{
    /*url: /pilots?sort['name']=DESC&nome=Guilherme
           /pilots?page=2&itemsperpage=3
    */

    /**
     * @var ObjectRepository
     */
    private $repository;
    /**
     * @var Factory
     */
    private $factory;
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var ProcessRequest
     */
    private $processRequest;

    /**
     * BaseController constructor.
     *
     * @param ObjectRepository $repository
     * @param Factory $factory
     * @param EntityManagerInterface $entityManager
     * @param ProcessRequest $processRequest
     */
    public function __construct(
        ObjectRepository $repository,
        Factory $factory,
        EntityManagerInterface $entityManager,
        ProcessRequest $processRequest
    ) {
        $this->repository = $repository;
        $this->factory = $factory;
        $this->entityManager = $entityManager;
        $this->processRequest = $processRequest;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getAll(Request $request): JsonResponse
    {
        $order = $this->processRequest->getOrder($request);
        $filter = $this ->processRequest->getFilter($request);
        $page = $this->processRequest->getPage($request);
        $itemPage = $this->processRequest->getItemPage($request);

        $entities = $this->repository->findBy(
            $filter,
            $order,
            $itemPage,
            ($page - 1) * $itemPage
        );

        return new JsonResponse($entities);
    }

    /**
     * @param $id
     *
     * @return JsonResponse
     */
    public function getOne($id): JsonResponse
    {
        $entity = $this->repository->find($id);

        return new JsonResponse($entity);
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent());
        $entity = $this->factory->createEntity($requestData);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return new JsonResponse($entity);
    }

    /**
     * @param $id
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function update($id, Request $request)
    {
        $jsonData = json_decode($request->getContent());
        $entityRequest = $this->factory->createEntity($jsonData);
        $entity = $this->repository->find($id);
        if (is_null($entity)) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        }

        $this->updateEntity($entity, $entityRequest);
        $this->entityManager->flush();

        return new JsonResponse($entity);
    }

    /**
     * @param $entity
     * @param $requestEntity
     *
     * @return mixed
     */
    abstract public function updateEntity($entity, $requestEntity);

    public function delete($id)
    {
        $entity = $this->repository->find($id);
        if (is_null($entity)) {
            return new JsonResponse('', Response::HTTP_NOT_FOUND);
        }
        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        return new JsonResponse('', Response::HTTP_NO_CONTENT);
    }
}

