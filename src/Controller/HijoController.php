<?php

namespace App\Controller;

use App\Entity\Hijo;
use App\Form\HijoType;
use App\Repository\HijoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hijo")
 */
class HijoController extends AbstractController
{
    /**
     * @Route("/", name="app_hijo_index", methods={"GET"})
     */
    public function index(HijoRepository $hijoRepository): Response
    {
        return $this->render('hijo/index.html.twig', [
            'hijos' => $hijoRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_hijo_new", methods={"GET", "POST"})
     */
    public function new(Request $request, HijoRepository $hijoRepository): Response
    {
        $hijo = new Hijo();
        $form = $this->createForm(HijoType::class, $hijo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hijoRepository->add($hijo, true);

            return $this->redirectToRoute('app_hijo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hijo/new.html.twig', [
            'hijo' => $hijo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_hijo_show", methods={"GET"})
     */
    public function show(Hijo $hijo): Response
    {
        return $this->render('hijo/show.html.twig', [
            'hijo' => $hijo,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_hijo_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Hijo $hijo, HijoRepository $hijoRepository): Response
    {
        $form = $this->createForm(HijoType::class, $hijo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hijoRepository->add($hijo, true);

            return $this->redirectToRoute('app_hijo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hijo/edit.html.twig', [
            'hijo' => $hijo,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_hijo_delete", methods={"POST"})
     */
    public function delete(Request $request, Hijo $hijo, HijoRepository $hijoRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hijo->getId(), $request->request->get('_token'))) {
            $hijoRepository->remove($hijo, true);
        }

        return $this->redirectToRoute('app_hijo_index', [], Response::HTTP_SEE_OTHER);
    }
}
