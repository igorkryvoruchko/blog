<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Blog;
use AppBundle\Entity\Comments;
use AppBundle\Forms\FormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * Class AdminController
 * @package AppBundle\Controller
 *
 * @Route("/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route("/add-post", name="add-post")
     */
    public function addPostAction(Request $request)
    {
        $content = new Blog();
        $form = $this->createForm(FormType::class, $content);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('AppBundle:Default:create.html.twig', array(
            'form_add_post' => $form->createView()
        ));
    }

    /**
     * @Route("/edit-post/{id}", name="edit-post", requirements={"id" = "\d+"})
     */
    public function editPostAction($id, Request $request)
    {
        $em = $this->getDoctrine();
        $content = $em->getRepository(Blog::class)->find($id);
        if (!$content) {
            throw $this->createAccessDeniedException('You cannot access this page!');
        }
        $form = $this->createForm(FormType::class, $content);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render('AppBundle:Default:create.html.twig', array(
            'form_add_post' => $form->createView()
        ));

    }

    /**
     * @Route("/delete/{id}", name="delete-post", requirements={"id" = "\d+"})
     */
    public function deletePostAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $content = $em->getRepository(Blog::class)->find($id);
        $em->remove($content);
        $em->flush();
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/delete-comment/{id}/{id_page}", name="delete-comment", requirements={"id" = "\d+"})
     */
    public function deleteCommentAction($id, $id_page, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository(Comments::class)->find($id);
        $em->remove($comment);
        $em->flush();
        return $this->redirectToRoute('page', ['id' => $id_page]);
    }

}
