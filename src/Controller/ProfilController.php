<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\CommentRepository;
use App\Repository\TrackRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    // PROFIL ACCESS //

    /**
     * @Route("/profil", name="app_profil")
     */
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    // EDIT PROFIL //

    /**
     * @Route("/profil/edit", name="app_profil_edit")
     */
    public function editProfil(EntityManagerInterface $em, SecurityController $security, Request $request): Response
    {
        $user = $security->getUser();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Your profile has been updated successfully.');

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/edit.html.twig', [
            'profil' => $user,
            'form' => $form->createView(),
        ]);
    }

    // DELETE USER //

    /**
     * @Route("profil/delete", name="app_profil_delete", methods={"POST"})
     */
    public function deleteProfil(EntityManagerInterface $em, SecurityController $security, Request $request): Response
    {
        $user = $security->getUser();
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
            session_destroy();
        }

        return $this->redirectToRoute('app_stream');

        return $this->render('common/error.html.twig', [
            'error' => 401,
            'message' => 'Unauthorized acces',
        ]);
    }

    /**
    * @Route("/profil/music", name="app_profil_music")
    */
    public function show(TrackRepository $repository): Response
    {
        $tracks = $repository->findAll();

        return $this->render('profil/music.html.twig', [
            'tracks' => $tracks,
        ]);
    }

    /**
    * @Route("/profil/comment", name="app_profil_comment")
    */
    public function all(CommentRepository $repository): Response
    {
        $comments = $repository->findAll();

        return $this->render('profil/comment.html.twig', [
            'comments' => $comments,
        ]);
    }

    
}

    // Faire une fonction pour récupérer l'id des tracks pour ensuite l'afficher dans profil music //

    // /**
    //  * @Route("/profil/{id}", name="app_track_find")
    //  *
    //  * @param mixed $id
    //  */
    // public function findtracks(Request $request, UserRepository $userRepository, $id): Response
    // {
    //     $user = $userRepository->find($id);

    //     return $this->render('user/one.html.twig', [
    //         'user' => $user,
    //         'tracks' => $user->gettracks(),
    //     ]);
    // }

    

    //     /**
    //  * @Route("/user/{id}", name="app_likes_find")
    //  *
    //  * @param mixed $id
    //  */
    // public function findlikes(Request $request, PaginatorInterface $paginator, UserRepository $userRepository, $id): Response
    // {
    //     $user = $userRepository->find($id);

    //     return $this->render('user/one.html.twig', [
    //         'user' => $user,
    //         'likes' => $paginator->paginate(
    //             $user->getlikes(),
    //             $request->query->getInt('page', 1),
    //             6
    //         ),
    //     ]);
    // }

