<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Snowtricks;
use App\Entity\Message;

class SnowtricksController extends AbstractController
{
    /**
     * @Route("/snowtricks", name="snowtricks")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Snowtricks::class);
        $snowtricks = $repo->findAll();

        return $this->render('snowtricks/index.html.twig', [
            'controller_name' => 'SnowtricksController',
            'snowtricks' => $snowtricks
        ]);
    }
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('snowtricks/home.html.twig', [
            'controller_name' => 'SnowtricksController',
        ]);
    }
    /**
     * @Route("/snowtricks/{id}", name="snowtricks_show")
     */
    public function show($id): Response
    {
        $repo_figure = $this->getDoctrine()->getRepository(Snowtricks::class);
        $snowtrick = $repo_figure->find($id);
        $repo_message = $this->getDoctrine()->getRepository(Message::class);
        $message = $repo_message->findAll($id);
        return $this->render('snowtricks/show.html.twig', [
            'snowtrick' => $snowtrick,
            'message' => $message
        ]);
    }
}
