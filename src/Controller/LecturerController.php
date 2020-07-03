<?php

namespace App\Controller;

use App\Entity\Lecturer;
use App\Form\LecturerType;
use App\Repository\LecturerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lecturer")
 */
class LecturerController extends AbstractController
{
    /**
     * @Route("/", name="lecturer_index", methods={"GET"})
     */
    public function index(LecturerRepository $lecturerRepository): Response
    {
        return $this->render('lecturer/index.html.twig', [
            'lecturers' => $lecturerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lecturer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lecturer = new Lecturer();
        $form = $this->createForm(LecturerType::class, $lecturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lecturer);
            $entityManager->flush();

            return $this->redirectToRoute('lecturer_index');
        }

        return $this->render('lecturer/new.html.twig', [
            'lecturer' => $lecturer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lecturer_show", methods={"GET"})
     */
    public function show(Lecturer $lecturer): Response
    {
        return $this->render('lecturer/show.html.twig', [
            'lecturer' => $lecturer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lecturer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lecturer $lecturer): Response
    {
        $form = $this->createForm(LecturerType::class, $lecturer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lecturer_index');
        }

        return $this->render('lecturer/edit.html.twig', [
            'lecturer' => $lecturer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lecturer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lecturer $lecturer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lecturer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lecturer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lecturer_index');
    }
}
