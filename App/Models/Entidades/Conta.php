<?php

namespace App\Models\Entidades;

class Conta
{
    private $id;
    private $agencia;
    private $numero;
    private $titular;
    private $saldo;
    private $data_abertura;
    private $data_rendimento;
    private $tipo;
    private $limite_especial;

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of agencia
     */ 
    public function getAgencia()
    {
        return $this->agencia;
    }

    /**
     * Set the value of agencia
     *
     * @return  self
     */ 
    public function setAgencia($agencia)
    {
        $this->agencia = $agencia;

        return $this;
    }

    /**
     * Get the value of numero
     */ 
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set the value of numero
     *
     * @return  self
     */ 
    public function setNumero($numero)
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * Get the value of titular
     */ 
    public function getTitular()
    {
        return $this->titular;
    }

    /**
     * Set the value of titular
     *
     * @return  self
     */ 
    public function setTitular($titular)
    {
        $this->titular = $titular;

        return $this;
    }

    /**
     * Get the value of saldo
     */ 
    public function getSaldo()
    {
        return $this->saldo;
    }

    /**
     * Set the value of saldo
     *
     * @return  self
     */ 
    public function setSaldo($saldo)
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * Get the value of data_abertura
     */ 
    public function getData_abertura()
    {
        return $this->data_abertura;
    }

    /**
     * Set the value of data_abertura
     *
     * @return  self
     */ 
    public function setData_abertura($data_abertura)
    {
        $this->data_abertura = $data_abertura;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of limite_especial
     */ 
    public function getLimite_especial()
    {
        return $this->limite_especial;
    }

    /**
     * Set the value of limite_especial
     *
     * @return  self
     */ 
    public function setLimite_especial($limite_especial)
    {
        $this->limite_especial = $limite_especial;

        return $this;
    }

    /**
     * Get the value of data_rendimento
     */ 
    public function getData_rendimento()
    {
        return $this->data_rendimento;
    }

    /**
     * Set the value of data_rendimento
     *
     * @return  self
     */ 
    public function setData_rendimento($data_rendimento)
    {
        $this->data_rendimento = $data_rendimento;

        return $this;
    }
}