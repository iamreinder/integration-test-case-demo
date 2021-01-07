<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    public const ROUTE_INDEX = '/';
    public const ROUTE_HELLO = '/hello';

    /**
     * @Route(path=HomeController::ROUTE_INDEX, name="index")
     *
     * @return Response
     */
    public function index(): Response
    {
        return new Response('Hello World!');
    }

    /**
     * @Route(path=HomeController::ROUTE_HELLO, name="hello")
     *
     * @param Request $request
     * @return Response
     */
    public function hello(Request $request): Response
    {
        $name = $request->get('name');

        return new Response('Hello ' . $name);
    }
}
