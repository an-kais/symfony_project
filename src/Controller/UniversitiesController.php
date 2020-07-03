<?php

namespace App\Controller;

use App\Entity\Universities;
use App\Form\UniversitiesType;
use App\Repository\UniversitiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/universities")
 */
class UniversitiesController extends AbstractController
{
    /**
     * @Route("/", name="universities_index", methods={"GET"})
     */
    public function index(UniversitiesRepository $universitiesRepository): Response
    {
        return $this->render('universities/index.html.twig', [
            'universities' => $universitiesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="universities_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $university = new Universities();
        $form = $this->createForm(UniversitiesType::class, $university);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($university);
            $entityManager->flush();

            return $this->redirectToRoute('universities_index');
        }

        return $this->render('universities/new.html.twig', [
            'university' => $university,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="universities_show", methods={"GET"})
     */
    public function show(Universities $university): Response
    {
        return $this->render('universities/show.html.twig', [
            'university' => $university,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="universities_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Universities $university): Response
    {
        $form = $this->createForm(UniversitiesType::class, $university);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('universities_index');
        }

        return $this->render('universities/edit.html.twig', [
            'university' => $university,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="universities_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Universities $university): Response
    {
        if ($this->isCsrfTokenValid('delete'.$university->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($university);
            $entityManager->flush();
        }

        return $this->redirectToRoute('universities_index');
    }
}
