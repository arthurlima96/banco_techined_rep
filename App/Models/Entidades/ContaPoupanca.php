<?php 

namespace App\Models\Entidades;

use App\Models\Entidades\Conta;

class ContaPoupanca extends Conta{
	
	private $data_rendimento;
	private $conta_id;

	public function getConta_Id()
	{
		return $this->conta_id;
	}

	public function setConta_Id($conta_id)
	{
		$this->conta_id = $conta_id;
	}

	public function getData_Rendimento()
	{
		return $this->data_rendimento;
	}

	public function setData_Rendimento($data_rendimento)
	{
		$this->data_rendimento = $data_rendimento;
	}

	public function efetuarRendimento()
	{
		$this->saldo += $this->saldo * 0.005;
	}
}