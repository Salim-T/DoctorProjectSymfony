<?php

namespace App\Controller;

use App\Entity\LignePrescription;
use App\Form\LignePrescriptionType;
use App\Repository\LignePrescriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/ligne/prescription')]
class LignePrescriptionController extends AbstractController
{
    #[Route('/', name: 'app_ligne_prescription_index', methods: ['GET'])]
    public function index(LignePrescriptionRepository $lignePrescriptionRepository): Response
    {
        return $this->render('ligne_prescription/index.html.twig', [
            'ligne_prescriptions' => $lignePrescriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_ligne_prescription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, LignePrescriptionRepository $lignePrescriptionRepository): Response
    {
        $lignePrescription = new LignePrescription();
        $form = $this->createForm(LignePrescriptionType::class, $lignePrescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lignePrescriptionRepository->save($lignePrescription, true);

            return $this->redirectToRoute('app_ligne_prescription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne_prescription/new.html.twig', [
            'ligne_prescription' => $lignePrescription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne_prescription_show', methods: ['GET'])]
    public function show(LignePrescription $lignePrescription): Response
    {
        return $this->render('ligne_prescription/show.html.twig', [
            'ligne_prescription' => $lignePrescription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_ligne_prescription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, LignePrescription $lignePrescription, LignePrescriptionRepository $lignePrescriptionRepository): Response
    {
        $form = $this->createForm(LignePrescriptionType::class, $lignePrescription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lignePrescriptionRepository->save($lignePrescription, true);

            return $this->redirectToRoute('app_ligne_prescription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ligne_prescription/edit.html.twig', [
            'ligne_prescription' => $lignePrescription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_ligne_prescription_delete', methods: ['POST'])]
    public function delete(Request $request, LignePrescription $lignePrescription, LignePrescriptionRepository $lignePrescriptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lignePrescription->getId(), $request->request->get('_token'))) {
            $lignePrescriptionRepository->remove($lignePrescription, true);
        }

        return $this->redirectToRoute('app_ligne_prescription_index', [], Response::HTTP_SEE_OTHER);
    }
}
