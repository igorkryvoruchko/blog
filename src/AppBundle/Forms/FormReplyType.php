<?php
namespace AppBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormReplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('reply', TextareaType::class, array('label' =>false, 'attr' => array(
                'class' => 'form-control', 'placeholder' => 'Your reply'
            )))
            ->add('Save my reply', SubmitType::class, array('attr' => array(
                'class' => 'btn btn-success'
            )));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\Reply'
        ]);
    }
}