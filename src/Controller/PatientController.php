<?php

namespace App\Controller;

use App\Entity\Patient;
use App\Form\PatientType;
use App\Repository\PatientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{
  
       /**
    * This function display all patients
    *
    * @param PatientRepository $repository
    * @param Request $request
    * @return Response
    */


    #[Route('/patient', name: 'patient.index', methods: ['GET'])]
    public function index(PatientRepository $repository, Request $request): Response
    {
        $patients = $repository->findAll();
        return $this->render('pages/patient/index.html.twig', [
            'patients' => $patients,
        ]);
    }

    /*********************************************************************** */
    /**
     * This function creates a recipe
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    #[Route('/patient/nouveau', 'patient.new', methods: ['GET', 'POST'])]
    public function new(
        Request $request,
        EntityManagerInterface $manager

    ) : Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();

            $manager->persist($patient);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre patient a bien été créé'
            );

            return $this->redirectToRoute('patient.index');
        }
return $this->render('pages/patient/new.html.twig', [
    'form' => $form->createView()
]);
    }

    /**
     * This function edits the patient
     * @param Patient $patient
     * @return Response
     */



    #[Route('patient/edition/{id}', 'patient.edit', methods: ['GET', 'POST'])]
    public function edit(

        Patient $patient,
        EntityManagerInterface $manager,
        Request $request
    ) : Response {

        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($patient);

        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();

            $manager->persist($patient);
            $manager->flush();

            $this->addFlash(
                'success',
                'Votre patient a été modifié avec succès !'
            );

            return $this->redirectToRoute('patient.index');
        }


        return $this->render('pages/patient/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * This controller allows us to delete a patient
     *
     * @param EntityManagerInterface $manager
     * @param Patient $patient
     * @return Response
     */
    #[Route('/patient/suppression/{id}', 'patient.delete', methods: ['GET'])]

    public function delete(
        EntityManagerInterface $manager,
        Patient $patient
    ): Response {
       
        $manager->remove($patient);
        $manager->flush();

        $this->addFlash(
            'success',
            'Votre patient a été supprimé avec succès !'
        );

        return $this->redirectToRoute('patient.index');
    }



}


