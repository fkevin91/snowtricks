<?php

namespace App\Controller;

use App\Entity\Media;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Snowtricks;
use App\Entity\Message;
use App\Repository\SnowtricksRepository;
use Knp\Component\Pager\PaginatorInterface;

class SnowtricksController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(
        SnowtricksRepository $snowtricksRepository, 
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $data = $snowtricksRepository->findAll();
        $snowtricks = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            15
        );
        $repo_img = $this->getDoctrine()->getRepository(Media::class);
        $images = $repo_img->findAll();


        $user = $this->getUser();
        return $this->render('snow/index.html.twig', [
            'snowtricks' => $snowtricks,
            'images' => $images,
            'user' => $user
        ]);
    }

    /**
     * @Route("/createSnowtrick", name="createSnowtrick")
     */
    public function createSnowtrick(Request $request, PaginatorInterface $paginator): Response
    {
        $snowtrick = new Snowtricks();
        $form = $this->createFormBuilder($snowtrick)
            ->add('nom')
            ->add('description')
            ->add('groupeFigure')
            ->add('photo')
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $snowtrick = $form->getData();
            $snowtrick->setUserId($this->getUser());
            $snowtrick->setUpdatedAt(new \DateTime());
            $snowtrick->setCreatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($snowtrick);
            $entityManager->flush();
            return $this->show($snowtrick->getId(), $paginator, $request);
        }
        return $this->render('snowtricks/createSnowtrick.html.twig',
        [
            'formSnow' => $form->createView()
        ]);
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
    public function show(
        $id,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $repo_figure = $this->getDoctrine()->getRepository(Snowtricks::class);
        $snowtrick = $repo_figure->find($id);
        $repo_message = $this->getDoctrine()->getRepository(Message::class);
        $dataMessage = $repo_message->findBy(array('snowtricks' => $id));
        $messages = $paginator->paginate(
            $dataMessage,
            $request->query->getInt('page', 1),
            3
        );

        return $this->render('snowtricks/show.html.twig', [
            'controller_name' => 'SnowtricksController',
            'snowtrick' => $snowtrick,
            'messages' => $messages
        ]);
    }
}
