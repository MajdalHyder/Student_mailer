<?php

namespace App\Controller;

use App\Entity\Convention;
use App\Entity\Etudiant;
use App\Form\AttestaionType;
use App\Form\NouveauType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="main")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $attestationForm = $this->createForm(AttestaionType::class);
        $attestationForm->handleRequest($request);

        if ($attestationForm->isSubmitted() && $attestationForm->isValid()) {

            //$etudiant = $attestationForm;
           /* $em = $this->getDoctrine()->getManager();
            $em->persist();
            $em->flush();
            $user =$this->getUser();*/
            //dd($etudiant);

        }

        return $this->render('default/index.html.twig', [
            'form' => $attestationForm->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return Response
     * @Route ("/nouveau", name="nouveauEntree")
     */
    public function nouveau(Request $request): Response
    {
        $nouveauForm = $this->createForm(NouveauType::class);
        $nouveauForm->handleRequest($request);

        return $this->render('default/nouveau.html.twig', [
            'nouveauEtudiantform' => $nouveauForm->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     * @Route ("/cree", name="cree")
     * Method("POST")
     */
    public function create(Request $request): Response
    {
        $etudiant = new Etudiant();
        $convention = new Convention();
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(NouveauType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $request->request->get('nouveau');
            $convention->setNom($data['convention']);
            $convention->setNbHeur($data['nbHeur']);
            $em->persist($convention);
            $em->flush();
            $idConvention = $convention->getId();

            $etudiant->setNom($data['nom']);
            $etudiant->setPrenom($data['prenom']);
            $etudiant->setMail($data['mail']);
            $etudiant->setConvention($convention);
            $em->persist($etudiant);
            $em->flush();
        }
        return $this->redirectToRoute('nouveauEntree');
    }

    /**
     * @param Request $request
     * @param $id
     * @return Response
     * @Route ("/{id}", name="getConventionEtudiant")
     */
    public function fetch(Request $request, $id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $con = $em->getRepository(Etudiant::class)->find($id);
        $idconv = $con->getConvention()->getId();
        $conv = $em->getRepository(Convention::class)->findOneBy(['id' => $idconv]);
        $etu = $em->getRepository(Etudiant::class)->findOneBy(['id' => $id]);
        $data = [
            'nom_etu' => $etu->getNom(),
            'prenom_etu' => $etu->getPrenom(),
            'nom' => $conv->getNom(),
            'nbHeur' => $conv->getNbHeur()
        ];

        return new Response(json_encode($data), Response::HTTP_OK);
    }
}
