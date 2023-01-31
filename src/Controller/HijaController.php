<?php

namespace App\Controller;

use App\Entity\Hija;
use App\Form\HijaType;
use App\Repository\HijaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/hija")
 */
class HijaController extends AbstractController
{
    /**
     * @Route("/", name="app_hija_index", methods={"GET"})
     */
    public function index(HijaRepository $hijaRepository): Response
    {
        return $this->render('hija/index.html.twig', [
            'hijas' => $hijaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_hija_new", methods={"GET", "POST"})
     */
    public function new(Request $request, HijaRepository $hijaRepository): Response
    {
        $hija = new Hija();
        $form = $this->createForm(HijaType::class, $hija);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hijaRepository->add($hija, true);

            return $this->redirectToRoute('app_hija_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hija/new.html.twig', [
            'hija' => $hija,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_hija_show", methods={"GET"})
     */
    public function show(Hija $hija): Response
    {
        return $this->render('hija/show.html.twig', [
            'hija' => $hija,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_hija_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Hija $hija, HijaRepository $hijaRepository): Response
    {
        $form = $this->createForm(HijaType::class, $hija);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hijaRepository->add($hija, true);

            return $this->redirectToRoute('app_hija_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hija/edit.html.twig', [
            'hija' => $hija,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_hija_delete", methods={"POST"})
     */
    public function delete(Request $request, Hija $hija, HijaRepository $hijaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hija->getId(), $request->request->get('_token'))) {
            $hijaRepository->remove($hija, true);
        }

        return $this->redirectToRoute('app_hija_index', [], Response::HTTP_SEE_OTHER);
    }
}
