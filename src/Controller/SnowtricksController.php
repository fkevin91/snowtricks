<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Snowtricks;
use App\Entity\Message;


class SnowtricksController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Snowtricks::class);
        $snowtricks = $repo->findAll();
    
        return $this->render('snowtricks/home.html.twig', [
            'controller_name' => 'SnowtricksController',
            'snowtricks' => $snowtricks
        ]);
    }

    /**
     * @Route("/createSnowtrick", name="createSnowtrick")
     */
    public function createSnowtrick(Request $request): Response
    {
        $snowtrick = new Snowtricks();
        $form = $this->createFormBuilder($snowtrick)
            ->add('nom')
            ->add('description')
            ->add('groupeFigure')
            ->add('photo')
            ->add('video')
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $snowtrick = $form->getData();
            $snowtrick->setUpdatedAt(new \DateTime());
            $snowtrick->setCreatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($snowtrick);
            $entityManager->flush();
            return $this->show($snowtrick->getId());
        }

        dump($snowtrick);
        return $this->render('snowtricks/createSnowtrick.html.twig',
        [
            'formSnow' => $form->createView()
        ]);
    }

    /**
     * @Route("/snowtricks", name="snowtricks")
     */
    public function index(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Snowtricks::class);
        $snowtricks = $repo->findAll();

        return $this->render('snowtricks/home.html.twig', [
            'controller_name' => 'SnowtricksController',
            'snowtricks' => $snowtricks
        ]);
    }

    /**
     * @Route("/registration", name="registration")
     */
    public function registration(): Response
    {
        return $this->render('snowtricks/registration.html.twig');
    }

    /**
     * @Route("/plogin", name="plogin")
     */
    public function login(): Response
    {
        return $this->render('snowtricks/login.html.twig');
    }

    /**
     * @Route("/forgotPassword", name="forgotPassword")
     */
    public function forgotPassword(): Response
    {
        return $this->render('snowtricks/forgotPassword.html.twig');
    }

    /**
     * @Route("/snowtricks/{id}", name="snowtricks_show")
     */
    public function show($id, Request $request = null): Response
    {
        $repo_figure = $this->getDoctrine()->getRepository(Snowtricks::class);
        $snowtrick = $repo_figure->find($id);
        $repo_message = $this->getDoctrine()->getRepository(Message::class);
        $messages = $repo_message->findBy(array('snowtricks' => $id));


        return $this->render('snowtricks/show.html.twig', [
            'controller_name' => 'SnowtricksController',
            'snowtrick' => $snowtrick,
            'messages' => $messages
        ]);
    }
}
