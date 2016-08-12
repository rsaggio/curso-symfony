<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContatoController extends Controller
{
	 /**
     * @Route("/contato", name="contato")
     */
	public function contatoAction() {
		return $this->render('default/contato.html.twig');
	}

	/**
     * @Route("/envia", name="envia")
     */
	public function enviaAction(Request $request) {

		$nome = $request->get('nome');
		$email = $request->get('email');
		$mensagem = $request->get('msg');

		$html = "nome: {$nome} <br /> email: {$email} <br /> mensagem: {$mensagem}";

		$message = \Swift_Message::newInstance()
        ->setSubject('Contato imobiliaria feliz')
        ->setFrom('renan.saggio@gmail.com')
        ->setTo('renan.saggio@gmail.com')
        ->setBody($html,'text/html');


	    $this->get('mailer')->send($message);

	    $this->addFlash('notice', 'Email enviado com sucesso');
	    
	    return $this->redirectToRoute('contato');
	}
}