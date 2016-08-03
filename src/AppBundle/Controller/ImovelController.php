<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Imovel;


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
        return $this->render('default/form.html.twig');
    }

    /**
     * @Route("/save", name="imoveis_save")
     */
    public function saveAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $imovel = new Imovel();
        $imovel->setTitulo($request->get('titulo'));
        $imovel->setTamanho($request->get('tamanho'));
        $imovel->setPreco($request->get('preco'));
        $imovel->setTipo($request->get('tipo'));
        $em->persist($imovel);
        $em->flush();
        
        return new Response('Produto adicionado com sucesso;');
    }


}
