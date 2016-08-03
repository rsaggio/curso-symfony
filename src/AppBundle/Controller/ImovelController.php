<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Imovel;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;



class ImovelController extends Controller
{
    /**
     * @Route("/", name="imoveis_lista")
     */
    public function listAction(Request $request)
    {
        $imovelRepository = $this->getDoctrine()->getRepository('AppBundle:Imovel');

        $imoveis = $imovelRepository->findAll();
        
        $dados = ["imoveis" => $imoveis];

        return $this->render('default/index.html.twig',$dados);

    }

    /**
     * @Route("/form", name="imoveis_form")
     */
    public function formAction() {
        // cria o form usando o helper

        $imovel = new Imovel();

        $form = $this->createFormBuilder($imovel)
        ->setAction($this->generateUrl('imoveis_save'))
        ->setMethod('POST')
        ->add('titulo', TextType::class)
        ->add('tamanho', TextType::class)
        ->add('preco', MoneyType::class)
        ->add('tipo', ChoiceType::class,array (
            'choices' => array(
                'Casa' => 'c',
                'Apartamento' => 'a'
            )
        ))
        ->add('salvar', SubmitType::class, array('label' => 'Anunciar imóvel'))
        ->getForm();


        return $this->render('default/form.html.twig',array('form' => $form->createView()));
    }

    /**
     * @Route("/save", name="imoveis_save")
     */
    public function saveAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createFormBuilder(new Imovel())
        ->setAction($this->generateUrl('imoveis_save'))
        ->setMethod('POST')
        ->add('titulo', TextType::class)
        ->add('tamanho', TextType::class)
        ->add('preco', MoneyType::class)
        ->add('tipo', ChoiceType::class,array (
            'choices' => array(
                'Casa' => 'c',
                'Apartamento' => 'a'
            )
        ))
        ->add('salvar', SubmitType::class, array('label' => 'Anunciar imóvel'))
        ->getForm();

        $form->handleRequest($request);
         
        $imovel = $form->getData();

        if($form->isSubmitted() && $form->isValid()) {
            $em->persist($imovel);
            $em->flush();
            
            return new Response('Produto adicionado com sucesso;');

        }else {
             return $this->render('default/form.html.twig',array('form' => $form->createView()));
        }

    }


}
