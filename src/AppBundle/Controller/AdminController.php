<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Blog;
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
        $form = $this->createForm( FormType::class, $content );
        $form->handleRequest($request);
        if($form -> isSubmitted() && $form -> isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($content);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }

        return $this->render('AppBundle:Default:create.html.twig', array(
            'form_add_post' => $form->createView()
        ));
    }


}
