<?php

namespace App\Controller;

use App\Entity\Padre;
use App\Form\PadreType;
use App\Repository\PadreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/padre")
 */
class PadreController extends AbstractController
{
    /**
     * @Route("/", name="app_padre_index", methods={"GET"})
     */
    public function index(PadreRepository $padreRepository): Response
    {
        dd($padreRepository->findAll());
        return $this->render('padre/index.html.twig', [
            'padres' => $padreRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_padre_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PadreRepository $padreRepository): Response
    {
        $padre = new Padre();
        $form = $this->createForm(PadreType::class, $padre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $padreRepository->add($padre, true);

            return $this->redirectToRoute('app_padre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('padre/new.html.twig', [
            'padre' => $padre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_padre_show", methods={"GET"})
     */
    public function show(Padre $padre): Response
    {
        return $this->render('padre/show.html.twig', [
            'padre' => $padre,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_padre_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Padre $padre, PadreRepository $padreRepository): Response
    {
        $form = $this->createForm(PadreType::class, $padre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $padreRepository->add($padre, true);

            return $this->redirectToRoute('app_padre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('padre/edit.html.twig', [
            'padre' => $padre,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_padre_delete", methods={"POST"})
     */
    public function delete(Request $request, Padre $padre, PadreRepository $padreRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$padre->getId(), $request->request->get('_token'))) {
            $padreRepository->remove($padre, true);
        }

        return $this->redirectToRoute('app_padre_index', [], Response::HTTP_SEE_OTHER);
    }
}
