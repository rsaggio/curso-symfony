<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Imovel;
use AppBundle\Form\ImovelType;
use AppBundle\Util\FileUploader;



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
    public function createAction(Request $request) {

        $form = $this->createForm(ImovelType::class);
        
        $form->handleRequest($request);
       
        if($form->isSubmitted() && $form->isValid()) {

            $imovel = $form->getData();

            $arquivo = $imovel->getFoto();

            $diretorio = $this->get('kernel')->getRootDir()."\..\web\uploads";
            
            $uploader = new FileUploader($diretorio);
            $fileName = $uploader->upload($arquivo);

            $imovel->setFoto($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($imovel);
            $em->flush();
            
            $this->addFlash('notice', 'Imovel anunciado com sucesso');

            return $this->redirectToRoute('imoveis_lista');
        }

        return $this->render('default/form.html.twig',array('form' => $form->createView()));
    }

}
