<?php

namespace App\Models\DAO;

use App\Models\Entidades\Conta;
use App\Models\Entidades\ContaCorrente;
use App\Models\Entidades\ContaPoupanca;

class ContaDAO extends BaseDAO
{

    public function criar_conta(Conta $conta)
    {
        try {
            $conta->setAgencia(rand(10,10000));
            $conta->setNumero(rand(10,10000));
            $conta->setSaldo(0.0);
                                     
            return $this->insert(
                'conta',
                ":agencia,:numero,:titular,:saldo,:tipo",
                [
                    ':agencia'=>$conta->getAgencia(),
                    ':numero' =>$conta->getNumero(),
                    ':titular'=>$conta->getTitular(),
                    ':saldo'  =>$conta->getSaldo(),
                    ':tipo'   =>$conta->getTipo()  
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.".$e->getMessage(), 500);
        }
    }

    public function criarContaPorTipo(Conta $conta)
    {
        try {

            if($conta instanceof ContaCorrente){
                $nome_tabela = "conta_corrente";
            }elseif($conta instanceof ContaPoupanca){
                $nome_tabela = "conta_poupanca";
            }
                                     
            return $this->insert(
                $nome_tabela,
                ":conta_id",
                [
                    ':conta_id'=>$conta->getId()
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.".$e->getMessage(), 500);
        }
    }

    public function pegarConta($id)
    {
        try {

            $query = $this->select(
                "SELECT * FROM conta WHERE titular = '$id' "
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public function verificarConta($agencia,$numero)
    {
        try {

            $query = $this->select(
                "SELECT * FROM conta WHERE agencia = '$agencia' AND numero = '$numero' "
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public  function atualizarSaldo(Conta $conta) {
        try {
            $titular = $conta->getTitular();
            $saldo   = $conta->getSaldo();

            return $this->update(
                'conta',
                "saldo = :saldo",
                [
                    ':titular'=>$titular,
                    ':saldo'  =>$saldo
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public  function atualizarSaldoRend(Conta $conta) 
    {
        try {
            $titular = $conta->getTitular();
            $saldo   = $conta->getSaldo();
            $data_rendimento = $conta->getData_rendimento();

            return $this->update(
                'conta',
                "saldo = :saldo, data_rendimento = :data_rendimento",
                [
                    ':titular'         =>$titular,
                    ':saldo'           =>$saldo,
                    ':data_rendimento' =>$data_rendimento
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public  function atualizarSaldoEspecial(ContaCorrente $conta) 
    {
        try {
            $conta_id          = $conta->getConta_Id();
            $limite_especial   = $conta->getLimite_Especial();

            return $this->updateContaCorrente(
                'conta_corrente',
                'limite_especial = :limite_especial',
                [
                    ':conta_id'        =>$conta_id,
                    ':limite_especial' =>$limite_especial
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.".$e->getMessage(), 500);
        }
    }

    public function pegarContaCorrente($conta)
    {
        try {

            $query = $this->select(
                "SELECT * FROM conta_corrente WHERE conta_id = '$conta'"
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }
}