<?php

namespace App\Factory;

use App\Entity\Car;
use App\Repository\CarRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @method static Car|Proxy findOrCreate(array $attributes)
 * @method static Car|Proxy random()
 * @method static Car[]|Proxy[] randomSet(int $number)
 * @method static Car[]|Proxy[] randomRange(int $min, int $max)
 * @method static CarRepository|RepositoryProxy repository()
 * @method Car|Proxy create($attributes = [])
 * @method Car[]|Proxy[] createMany(int $number, $attributes = [])
 */
final class CarFactory extends ModelFactory
{
    /**
     * @return array
     */
    protected function getDefaults(): array
    {
        return [
            'brand' => self::faker()->company,
            'model' => self::faker()->name,
            'yearOfConstruction' => self::faker()->year,
        ];
    }

    /**
     * @return string
     */
    protected static function getClass(): string
    {
        return Car::class;
    }
}
