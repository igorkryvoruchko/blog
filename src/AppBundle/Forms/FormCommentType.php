<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 09.12.17
 * Time: 18:14
 */

namespace AppBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormCommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('comment', TextareaType::class, array('label' =>false, 'attr' => array(
                'class' => 'form-control', 'placeholder' => 'Your comment'
            )))
            ->add('Save my comment', SubmitType::class, array('attr' => array(
                'class' => 'btn btn-success'
            )));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Comments'
        ]);
    }
}