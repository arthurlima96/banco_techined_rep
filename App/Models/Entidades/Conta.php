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
    private $tipo;
    
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

    public function getTipo(){
        return $this->tipo;
    }

    public function setTipo($tipo){
        $this->tipo = $tipo;
    }

    public function depositar($valor_deposito)
    {
        if($valor_deposito > 0)
            $this->saldo += $valor_deposito;
    }

    public function sacar($valor_saque){
        if($valor_saque <= $this->getSaldo()){
            $this->saldo -= $valor_saque;

            return true;
        }else{
            return false;
        }
    }

    public function tipoCorrente(){
        return $this instanceof ContaCorrente;
    }

    public function tipoPoupanca(){
        return $this instanceof ContaCorrente;
    }

}