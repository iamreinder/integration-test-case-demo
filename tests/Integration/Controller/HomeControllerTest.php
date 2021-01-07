<?php

namespace App\Tests\Integration\Controller;

use App\Controller\HomeController;
use App\Tests\TestCases\Integration\IntegrationTestCase;

/**
 * @package App\Tests\Integration\Controller
 * @testdox HomeController: controller class for the homepage
 */
class HomeControllerTest extends IntegrationTestCase
{
    private const HTTP_METHOD_GET = 'GET';

    /**
     * @test
     * @testdox The index page shows a Hello World text
     */
    public function index_showsHelloWorld(): void
    {
        $response = $this->getKernelBrowser()->request(
            self::HTTP_METHOD_GET,
            HomeController::ROUTE_INDEX
        );

        self::assertStringContainsString(
            'Hello World',
            $response->html(),
            'The index page is expected to contain a Hello World text'
        );
    }

    /**
     * @test
     * @testdox The hello page shows a Hello <name> text
     * @dataProvider getNameTestData()
     * @param string $name
     */
    public function hello_showsExpectedHelloName(string $name): void
    {
        $response = $this->getKernelBrowser()->request(
            self::HTTP_METHOD_GET,
            HomeController::ROUTE_HELLO,
            [
                'name' => $name,
            ]
        );

        self::assertStringContainsString(
            'Hello ' . $name,
            $response->html(),
            sprintf(
                'The index page is expected to contain a Hello %s text',
                $name
            )
        );
    }

    /**
     * @return string[]
     */
    public function getNameTestData(): array
    {
        return [
            'Name: Lily' => [
                'Lily',
            ],
            'Name: Jane' => [
                'Jane',
            ],
            'Name: Rick' => [
                'Rick',
            ],
            'Name: John' => [
                'John',
            ],
            'Name: X Æ A-12' => [
                'X Æ A-12',
            ],
        ];
    }
}
