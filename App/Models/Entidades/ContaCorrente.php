<?php

namespace App\Models\Entidades;

use App\Models\Entidades\Conta;

class Contacorrente extends Conta 
{

	private $limite_especial;
	private $conta_id;

	public function getConta_Id()
	{
		return $this->conta_id;
	}

	public function setConta_Id($conta_id)
	{
		$this->conta_id = $conta_id;
	}

	public function getLimite_Especial()
	{
		return $this->limite_especial;
	}

	public  function setLimite_Especial($limite_especial)
	{
		$this->limite_especial = $limite_especial;
	}

	public function transfererir($valor_transferencia)
	{
		$this->saldo -= ($this->saldo - $valor_transferencia) - ($valor_transferencia * 0.03);

		return $this->saldo;
	}

	public function sacarLimiteEspecial($valor_saque)
	{
        if($valor_saque <= $this->getLimite_Especial())
        {
            $this->limite_especial -= $valor_saque;

            return true;
        }else{
            return false;
        }
            
    }
}