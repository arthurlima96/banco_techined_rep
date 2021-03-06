<?php

namespace App\Models\DAO;

use App\Models\Entidades\Usuario;

class UsuarioDAO extends BaseDAO
{
    public function verificaEmail($email)
    {
        try {

            $query = $this->select(
                "SELECT * FROM usuario WHERE email = '$email' "
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public function verificaEmailESenha(Usuario $usuario)
    {
        try {
            $email     = $usuario->getEmail();
            $senha     = $usuario->getSenha();

            $query = $this->select(
                "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'"
            );

            return $query->fetch();

        }catch (Exception $e){
            throw new \Exception("Erro no acesso aos dados.", 500);
        }
    }

    public function pegarUsuarioPorEmail($email){
        return $this->verificaEmail($email);
    }

    public  function salvar(Usuario $usuario) {
        try {
            $nome      = $usuario->getNome();
            $email     = $usuario->getEmail();
            $senha     = $usuario->getSenha();
             
            return $this->insert(
                'usuario',
                ":nome,:email,:senha",
                [
                    ':nome'=>$nome,
                    ':email'=>$email,
                    ':senha'=>$senha
                ]
            );

        }catch (\Exception $e){
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }
}