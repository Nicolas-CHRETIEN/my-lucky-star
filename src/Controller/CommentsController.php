<?php

namespace App\Controller;


use DateTime;
use App\Entity\User;
use App\Entity\Stars;
use App\Entity\Images;
use DateTimeInterface;
use App\Entity\Comment;
use App\Form\ImageType;
use App\Form\CreateStarType;
use App\Form\CommentStarType;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\StarsRepository;
use App\Repository\ImagesRepository;
use App\Repository\CommentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CommentsController extends AbstractController {

    // ----------------------- Add comment. ---------------------------
    /**
    * @Route("/stars/{id}/comment", name="star_comment")
    * @Security("is_granted('IS_AUTHENTICATED_FULLY')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @param EntityManagerInterface $manager
    * @return response
    */

    public function addComment ($id, Request $request, EntityManagerInterface $manager, CommentRepository $comment_repository, StarsRepository $star_repository): Response {
        $comment = new comment;
        $form = $this->createForm(CommentStarType::class, $comment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $star = $star_repository->findOneById($id);
            $comment->setUserId($user);
            $comment->setStarId($star);
            $date = new DateTime('@'. strtotime('now'));
            $comment->setDate($date);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('app_stars_knowmore', ['id' => $star->getId()]);
        }
        $star = $star_repository->findOneById($id);
        $comments = $comment_repository->findAll();
        return $this->render('comments/commentAdd.html.twig', ['form' => $form->createView(), 'comments' => $comments, 'star' => $star]);
    }

    // ----------------------- Edit comment. ---------------------------
    /**
    * @Route("/stars/{starId}/comment/{id}/edit", name="comment_edit")
    * @Security("is_granted('ROLE_ADMIN')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @param $id
    * @param $starId
    * @param Request $request
    * @param EntityManagerInterface $manager
    * @param CommentRepository $comment_repository
    * @param StarsRepository $star_repository
    * @return Response
    */

    public function editComment ($id, $starId, Request $request, EntityManagerInterface $manager, CommentRepository $comment_repository, StarsRepository $star_repository) {
        $comment = $comment_repository->findOneById($id);
        $form = $this->createForm(CommentStarType::class, $comment);
        $star = $star_repository->findOneById($starId);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $star = $star_repository->findOneById($id);
            $date = new DateTime('@'. strtotime('now'));
            $comment->setEdit($date);
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('app_stars_knowmore', ['id' => $starId]);
        }

        $comments = $comment_repository->findAll();
        return $this->render('comments/commentEdit.html.twig', ['form' => $form->createView(),'comment' => $comment, 'comments' => $comments, 'star' => $star, 'commentToEdit' => $comment]);
    }

    // ----------------------- Delete comment. ---------------------------
    /**
    * @Route("/stars/{starId}/comment/{id}/delete", name="comment_delete")
    * @Security("is_granted('ROLE_ADMIN')", message="Vous n'avez pas les autorisations requises pour accéder à cette commande.")
    * @param $id
    * @param $starId
    * @param EntityManagerInterface $manager
    * @param CommentRepository $comment_repository
    * @param StarsRepository $star_repository
    * @return Response
    */

    public function removeComment($id, $starId, EntityManagerInterface $manager, CommentRepository $comment_repository) {
        $comment = $comment_repository->findOneById($id);
        $manager->remove($comment);
        $manager->flush();
        $comments = $comment_repository->findAll();
        return $this->redirectToRoute('app_stars_knowmore', ['id' => $starId]);
    }
}
