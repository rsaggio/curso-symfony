<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Imovel
 *
 * @ORM\Table(name="imovel")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ImovelRepository")
 */
class Imovel
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="tamanho", type="decimal", precision=10, scale=2)
     */
    private $tamanho;

    /**
     * @var string
     *
     * @ORM\Column(name="preco", type="decimal", precision=10, scale=2)
     */
    private $preco;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=1)
     */
    private $tipo;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     *
     * @return Imovel
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;

        return $this;
    }

    /**
     * Get titulo
     *
     * @return string
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set tamanho
     *
     * @param string $tamanho
     *
     * @return Imovel
     */
    public function setTamanho($tamanho)
    {
        $this->tamanho = $tamanho;

        return $this;
    }

    /**
     * Get tamanho
     *
     * @return string
     */
    public function getTamanho()
    {
        return $this->tamanho;
    }

    /**
     * Set preco
     *
     * @param string $preco
     *
     * @return Imovel
     */
    public function setPreco($preco)
    {
        $this->preco = $preco;

        return $this;
    }

    /**
     * Get preco
     *
     * @return string
     */
    public function getPreco()
    {
        return $this->preco;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return Imovel
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }
}

