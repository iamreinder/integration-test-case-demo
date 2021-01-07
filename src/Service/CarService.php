<?php

namespace App\Service;

use App\Entity\Car;
use Doctrine\ORM\EntityManagerInterface;

class CarService
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param string $brand
     * @param string $model
     * @param int $yearOfConstruction
     * @return Car
     */
    public function addCar(string $brand, string $model, int $yearOfConstruction): Car
    {
        $car = new Car();

        $car->setBrand($brand);
        $car->setModel($model);
        $car->setYearOfConstruction($yearOfConstruction);

        $this->entityManager->persist($car);
        $this->entityManager->flush();

        return $car;
    }

    /**
     * @param int $id
     * @return Car|null
     */
    public function getCar(int $id): ?Car
    {
        $carRepository = $this->entityManager->getRepository(Car::class);

        return $carRepository->find($id);
    }

    /**
     * @param Car $car
     */
    public function removeCar(Car $car): void
    {
        $this->entityManager->remove($car);
        $this->entityManager->flush();
    }
}
