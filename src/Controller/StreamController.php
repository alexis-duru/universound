<?php

namespace App\Controller;

use App\Entity\Track;
use App\Entity\Comment;
use App\Form\CommentFormType;
use App\Repository\TrackRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StreamController extends AbstractController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    /**
     * @Route("/stream", name="app_stream", methods={"GET"})
     */
    public function index(TrackRepository $trackRepository): Response
    {
        return $this->render('stream/index.html.twig', [
            'tracks' => $trackRepository->findAll(),
        ]);
    }

     /**
     * @Route("/stream/{id}", name="app_stream_details", methods={"GET", "POST"})
     */
    public function show(Track $track, Request $request): Response
    {
        return $this->render('stream/details.html.twig', [
            'track' => $track,
        ]);
    }

    /**
     * @Route("/stream/comment/{id}", name="app_stream_comment", methods={"GET", "POST"})
     */

    public function findAll(Track $track, Request $request): Response
    {
        $comments = $track->getComments();

        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->security->getUser();
            $comment->setAuthor($user);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($comment);
            $track->addComment($comment);

            $entityManager->flush();

            return $this->redirectToRoute('app_stream_details', ['id' => $track->getId()]);
        }

        return $this->render('stream/comment.html.twig', [
            'track' => $track,
            'comments' => $comments,
            'form' => $form->createView(),
        ]);
    }
    
}
