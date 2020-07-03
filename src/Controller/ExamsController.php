<?php

namespace App\Controller;

use App\Entity\Exams;
use App\Form\ExamsType;
use App\Repository\ExamsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/exams")
 */
class ExamsController extends AbstractController
{
    /**
     * @Route("/", name="exams_index", methods={"GET"})
     */
    public function index(ExamsRepository $examsRepository): Response
    {
        return $this->render('exams/index.html.twig', [
            'exams' => $examsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="exams_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $exam = new Exams();
        $form = $this->createForm(ExamsType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($exam);
            $entityManager->flush();

            return $this->redirectToRoute('exams_index');
        }

        return $this->render('exams/new.html.twig', [
            'exam' => $exam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exams_show", methods={"GET"})
     */
    public function show(Exams $exam): Response
    {
        return $this->render('exams/show.html.twig', [
            'exam' => $exam,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="exams_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Exams $exam): Response
    {
        $form = $this->createForm(ExamsType::class, $exam);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('exams_index');
        }

        return $this->render('exams/edit.html.twig', [
            'exam' => $exam,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="exams_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Exams $exam): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exam->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($exam);
            $entityManager->flush();
        }

        return $this->redirectToRoute('exams_index');
    }
}
