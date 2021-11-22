<?php

namespace App\Controller;

use App\Entity\Media;
use App\Entity\Snowtricks;
use App\Form\MediaType;
use App\Repository\MediaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/media")
 */
class MediaController extends AbstractController
{
    /**
     * @Route("/by/{id}", name="media_index", methods={"GET"})
     */
    public function index($id, MediaRepository $mediaRepository): Response
    {
        return $this->render('media/index.html.twig', [
            'media' => $mediaRepository->findBy(['snowtrickId' => $id])
        ]);
    }

    /**
     * @Route("/new/{id}", name="media_new", methods={"GET","POST"})
     */
    public function new($id, Request $request): Response
    {
        $repo_figure = $this->getDoctrine()->getRepository(Snowtricks::class);
        $snowtrick = $repo_figure->find($id);
        dump($snowtrick);
        $medium = new Media();
        $medium->setSnowtrickId($snowtrick);
        dump($medium);

        $form = $this->createForm(MediaType::class, $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($medium);
            $entityManager->flush();

            return $this->redirect('http://localhost:8000/media/new/' . $snowtrick->getId());
        }

        return $this->renderForm('media/new.html.twig', [
            'medium' => $medium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="media_show", methods={"GET"})
     */
    public function show(Media $medium): Response
    {
        return $this->render('media/show.html.twig', [
            'medium' => $medium,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="media_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Media $medium): Response
    {
        $form = $this->createForm(MediaType::class, $medium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('media_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('media/edit.html.twig', [
            'medium' => $medium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="media_delete", methods={"POST"})
     */
    public function delete(Request $request, Media $medium): Response
    {
        if ($this->isCsrfTokenValid('delete'.$medium->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medium);
            $entityManager->flush();
        }

        return $this->redirectToRoute('media_index', [], Response::HTTP_SEE_OTHER);
    }
}
