<?php

namespace App\Tests\TestCases\Integration;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @author Reinder van Bochove (@iamreinder)
 * @package App\Tests\TestCases\Integration
 */
class IntegrationTestCase extends WebTestCase
{
    /**
     * @var EntityManagerInterface|null
     */
    protected static ?EntityManagerInterface $entityManager = null;

    /**
     * @var KernelInterface|null
     */
    protected static ?KernelInterface $kernelInterface = null;

    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        static::buildSchema();
    }

    public function tearDown(): void
    {
        // this is empty to prevent the parent tearDown function being called
    }

    protected static function buildSchema(): void
    {
        $metadata = static::entityManager()
            ->getMetadataFactory()
            ->getAllMetadata();

        $tool = new SchemaTool(static::entityManager());

        if (!empty($tool->getUpdateSchemaSql($metadata))) {
            $tool->updateSchema($metadata);
        }
    }

    /**
     * @return KernelInterface
     */
    protected static function bootedKernel(): KernelInterface
    {
        if (static::$kernelInterface === null) {
            static::$kernelInterface = static::bootKernel();
        }

        return static::$kernelInterface;
    }

    /**
     * @return EntityManagerInterface
     */
    protected static function entityManager(): EntityManagerInterface
    {
        if (static::$entityManager === null) {
            static::$entityManager = static::bootedKernel()
                ->getContainer()
                ->get('doctrine.orm.entity_manager');
        }

        return static::$entityManager;
    }

    /**
     * @return EntityManagerInterface
     */
    protected function getEntityManager(): EntityManagerInterface
    {
        return static::entityManager();
    }

    /**
     * @return KernelBrowser
     */
    protected function getKernelBrowser(): KernelBrowser
    {
        return (new KernelBrowser(static::bootedKernel()));
    }
}
