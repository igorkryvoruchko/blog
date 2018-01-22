<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 14.11.17
 * Time: 0:52
 */

namespace AppBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class FormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array('label' =>false, 'attr' => array(
            'class' => 'form-control', 'placeholder' => 'Title'
        )))
            ->add('category', TextType::class, array('label' =>false, 'attr' => array(
                'class' => 'form-control', 'placeholder' => 'Category'
            )))
            ->add('preview', TextareaType::class, array('label' =>false, 'attr' => array(
                'class' => 'form-control', 'placeholder' => 'Preview'
            )))
            ->add('post', TextareaType::class, array('label' =>false, 'attr' => array(
                'class' => 'form-control', 'placeholder' => 'Post'
            )))
            ->add('Save post', SubmitType::class, array('attr' => array(
                'class' => 'btn btn-success'
            )));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Blog'
        ]);
    }

}