<?php

namespace App\Controller;

use App\Entity\Track;
use App\Form\TrackUploadFormType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;

class UploadController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @IsGranted("ROLE_USER", statusCode=401, message="You have to be logged-in to access this ressource")
     * @Route("/upload", name="app_upload", methods={"GET","POST"})
     */
    public function new(Request $request, Security $security): Response
    {
        $track = new Track();
        $form = $this->createForm(TrackUploadFormType::class, $track);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->security->getUser();
            $track->setArtist($user);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($track);
            $entityManager->flush();

            return $this->redirectToRoute('app_stream');
        }

        return $this->render('upload/index.html.twig', [
            'track' => $track,
            'form' => $form->createView(),
        ]);
    }
}
