<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Blog;
use AppBundle\Entity\Comments;
use AppBundle\Entity\Reply;
use AppBundle\Forms\FormCommentType;
use AppBundle\Forms\FormReplyType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $repository = $this->getDoctrine()->getRepository(Blog::class);

        $content = $repository->findAll();
        return $this->render('AppBundle:Default:home.html.twig', array(
            'content' => $content));
    }

    /**
     * @Route("/page/{id}", name="page")
     */
    public function pageAction(Blog $blog, $id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Blog::class);
        $content = $repository->find($id);

        $comment = new Comments();
        $comment->setBlog($content);
        $form = $this->createForm(FormCommentType::class, $comment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($comment);
            $em->flush();
            return $this->redirectToRoute('page', ['id' => $id]);
        }


        return $this->render('AppBundle:Default:page.html.twig', array(
            'content' => $content,
            'form_add_comment' => $form->createView()
            ));
    }


    /**
     * @Route("/page/{id}/{id_comment}", name="reply")
     */
    public function replyAction(Blog $blog, $id, $id_comment, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $com_id = $repository->find($id_comment);

        $reply = new Reply();
        $reply->setComment($com_id);
        $form = $this->createForm(FormReplyType::class, $reply);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($reply);
            $em->flush();
            return $this->redirectToRoute('page', ['id' => $id]);
        }

        return $this->render('AppBundle:Default:reply.html.twig', array(
            'form_add_reply' => $form->createView()
        ));
    }



}
