<?php

namespace App\Controller;

use App\Entity\Media;
use App\Entity\Snowtricks;
use App\Entity\Message;
use App\Form\SnowtricksType;
use App\Repository\SnowtricksRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/snow")
 */
class SnowController extends AbstractController
{
    /**
     * @Route("/", name="snow_index", methods={"GET"})
     */
    public function index(SnowtricksRepository $snowtricksRepository): Response
    {
        return $this->render('snow/index.html.twig', [
            'snowtricks' => $snowtricksRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="snow_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $snowtrick = new Snowtricks();
        $snowtrick->setUpdatedAt(new \DateTime());
        $snowtrick->setCreatedAt(new \DateTime());
        $snowtrick->setUserId($this->getUser());
        $form = $this->createForm(SnowtricksType::class, $snowtrick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($snowtrick);
            $entityManager->flush();

            return $this->redirectToRoute('snow_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('snow/new.html.twig', [
            'snowtrick' => $snowtrick,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="snow_show", methods={"GET"})
     */
    public function show($id): Response
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

    /**
     * @Route("/{id}/edit", name="snow_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Snowtricks $snowtrick): Response
    {
        if((($this->getUser() == null) || ($this->getUser())->getId() != $snowtrick->getUserId()->getId())){
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }
        $form = $this->createForm(SnowtricksType::class, $snowtrick);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $snowtrick->setUpdatedAt(new \DateTime());
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('snow/edit.html.twig', [
            'snowtrick' => $snowtrick,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="snow_delete", methods={"POST"})
     */
    public function delete(Request $request, Snowtricks $snowtrick): Response
    {
        if ($this->isCsrfTokenValid('delete'.$snowtrick->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($snowtrick);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }
}
