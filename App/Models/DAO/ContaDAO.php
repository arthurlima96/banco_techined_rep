<?php

namespace App\Models\DAO;

use App\Models\Entidades\Conta;

class ContaDAO extends BaseDAO
{

    public function criar_conta($id_usuario,$tp_conta)
    {
        try {
            $agencia    = rand(10,10000);
            $numero     = rand(10,10000);
            $titular    = $id_usuario;
            $saldo      = 0.0;
                                     
            return $this->insert(
                'conta',
                ":agencia,:numero,:titular,:saldo,:tipo",
                [
                    ':agencia'=>$agencia,
                    ':numero' =>$numero,
                    ':titular'=>$titular,
                    ':saldo'  =>$saldo,
                    ':tipo'   =>$tp_conta
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

    public  function atualizarSaldoRend(Conta $conta) {
        try {
            $titular = $conta->getTitular();
            $saldo   = $conta->getSaldo();
            $data_rendimento = $conta->getData_rendimento();

            return $this->update(
                'conta',
                "saldo = :saldo, data_rendimento = :data_rendimento",
                [
                    ':titular'=>$titular,
                    ':saldo'  =>$saldo,
                    ':data_rendimento' =>$data_rendimento
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public  function atualizarSaldoEspecial(Conta $conta) {
        try {
            $titular = $conta->getTitular();
            $limite_espacial   = $conta->getLimite_especial();

            return $this->update(
                'conta',
                "limite_especial = :limite_especial",
                [
                    ':titular'=>$titular,
                    ':limite_especial'  =>$limite_espacial
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.".$e->getMessage(), 500);
        }
    }
}