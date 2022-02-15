<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController {

    #[Route('/home')]
    public function home(): Response 
    {
        $functions = [
            'function1' => [
                'method' => 'GET',
                'endpoint' => 'myendpoint',
                'parameters' => [
                    'param1' => 'string',
                    'param2' => 'number'
                ]
            ],
            'function2' => [
                'method' => 'POST',
                'endpoint' => 'myendpoint',
                'parameters' => [
                    'param1' => 'string',
                    'param2' => 'number'
                ]
            ]
        ];

        return $this->render('home.html.twig', [
            'functions' => $functions
        ]);
    }


    //#[Route('/myendpoint?param1={param1}&param2={param2}', methods: ['GET'])]
    #[Route('/myendpoint', methods: ['GET'])]
    public function function1(): Response  {
        $result = sprintf('this is the result of the request: GET /myendpoint?param1=%s&param2=%s', $_GET["param1"], $_GET["param2"]);
        return new Response($result);
    }

    #[Route('/myendpoint', methods: ['POST'])]
    public function function2(): Response  {
        $json = file_get_contents('php://input');
        $result = sprintf('this is the result of the request: POST /myendpoint with data %s', $json);
        return new Response($result);
    }
}