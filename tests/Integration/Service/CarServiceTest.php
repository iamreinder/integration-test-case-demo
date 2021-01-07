<?php

namespace App\Tests\Integration\Service;

use App\Entity\Car;
use App\Repository\CarRepository;
use App\Service\CarService;
use App\Tests\TestCases\Integration\IntegrationTestCase;

/**
 * @package App\Tests\Integration\Service
 * @testdox CarService: a service class to manage cars in the database
 */
class CarServiceTest extends IntegrationTestCase
{
    private const TEST_VALUE_CAR_BRAND = 'Mercedes-Benz';
    private const TEST_VALUE_CAR_MODEL = 'GLA45';
    private const TEST_VALUE_CAR_YEAR_OF_CONSTRUCTION = 2018;

    /**
     * @var CarService
     */
    private CarService $carService;

    /**
     * @var CarRepository
     */
    private CarRepository $carRepository;

    public function setUp(): void
    {
        $this->carService = new CarService($this->getEntityManager());
        $this->carRepository = $this->getEntityManager()->getRepository(Car::class);
    }

    /**
     * @test
     * @testdox The method to add a car, adds a car to the database
     */
    public function addCar_addsCarToDatabase(): void
    {
        $initialNumberOfCars = $this->carRepository->count([]);

        $this->carService->addCar(
            self::TEST_VALUE_CAR_BRAND,
            self::TEST_VALUE_CAR_MODEL,
            self::TEST_VALUE_CAR_YEAR_OF_CONSTRUCTION
        );

        $newNumberOfCars = $this->carRepository->count([]);

        self::assertGreaterThan(
            $initialNumberOfCars,
            $newNumberOfCars,
            sprintf(
                'The number of cars should be higher than "%d" after a car is added',
                $initialNumberOfCars
            )
        );
    }

    /**
     * @test
     * @testdox The method to get a car, gets a car from the database
     */
    public function getCar_getsCarFromDatabase(): void
    {
        $addedCar = $this->carService->addCar(
            self::TEST_VALUE_CAR_BRAND,
            self::TEST_VALUE_CAR_MODEL,
            self::TEST_VALUE_CAR_YEAR_OF_CONSTRUCTION
        );

        $car = $this->carService->getCar($addedCar->getId());

        self::assertSame(
            $addedCar->getId(),
            $car->getId(),
            sprintf(
                'The retrieved car is expected to have id "%s"',
                $addedCar->getId()
            )
        );
    }

    /**
     * @test
     * @testdox The method to remove a car, removes a car from the database
     */
    public function removeCar_removesCarFromDatabase(): void
    {
        $car = $this->carService->addCar(
            self::TEST_VALUE_CAR_BRAND,
            self::TEST_VALUE_CAR_MODEL,
            self::TEST_VALUE_CAR_YEAR_OF_CONSTRUCTION
        );

        $carId = $car->getId();

        self::assertNotNull(
            $this->carRepository->find($carId),
            sprintf(
                'A car with id "%s" is expected to be found in the database before deleting it',
                $carId
            )
        );

        $this->carService->removeCar($car);

        self::assertNull(
            $this->carRepository->find($carId),
            sprintf(
                'A car with id "%s" is not expected to be found in the database after deleting it',
                $carId
            )
        );
    }
}
