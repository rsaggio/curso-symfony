<?php
namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImovelType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
        $builder->add('titulo', TextType::class)
        ->add('tamanho', TextType::class)
        ->add('foto', FileType::class, array('label' => 'Selecione uma foto'))
        ->add('preco', MoneyType::class)
        ->add('tipo', ChoiceType::class,array (
            'choices' => array(
                'Casa' => 'c',
                'Apartamento' => 'a'
            )
        ))
        ->add('salvar', SubmitType::class, array('label' => 'Anunciar imóvel'));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Imovel',
        ));
    }
}