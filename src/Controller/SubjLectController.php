<?php

namespace App\Controller;

use App\Entity\SubjLect;
use App\Form\SubjLectType;
use App\Repository\SubjLectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/subj/lect")
 */
class SubjLectController extends AbstractController
{
    /**
     * @Route("/", name="subj_lect_index", methods={"GET"})
     */
    public function index(SubjLectRepository $subjLectRepository): Response
    {
        return $this->render('subj_lect/index.html.twig', [
            'subj_lects' => $subjLectRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="subj_lect_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $subjLect = new SubjLect();
        $form = $this->createForm(SubjLectType::class, $subjLect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($subjLect);
            $entityManager->flush();

            return $this->redirectToRoute('subj_lect_index');
        }

        return $this->render('subj_lect/new.html.twig', [
            'subj_lect' => $subjLect,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subj_lect_show", methods={"GET"})
     */
    public function show(SubjLect $subjLect): Response
    {
        return $this->render('subj_lect/show.html.twig', [
            'subj_lect' => $subjLect,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="subj_lect_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SubjLect $subjLect): Response
    {
        $form = $this->createForm(SubjLectType::class, $subjLect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('subj_lect_index');
        }

        return $this->render('subj_lect/edit.html.twig', [
            'subj_lect' => $subjLect,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="subj_lect_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SubjLect $subjLect): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subjLect->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($subjLect);
            $entityManager->flush();
        }

        return $this->redirectToRoute('subj_lect_index');
    }
}
