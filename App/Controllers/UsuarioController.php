<?php

namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\DAO\ContaDAO;
use App\Models\Entidades\Usuario;
use App\Models\Entidades\Conta;
use App\Models\Entidades\ContaCorrente;
use App\Models\Entidades\ContaPoupanca;

class UsuarioController extends Controller{
   
    public function cadastro(){
        $this->render('/usuario/cadastro');

        Sessao::limpaFormulario();
        Sessao::limpaMensagem();
    }

    public function salvar(){
        $Usuario = new Usuario();
        $Usuario->setNome($_POST['nome']);
        $Usuario->setEmail($_POST['email']);
        $Usuario->setSenha($_POST['senha']);

        Sessao::gravaFormulario($_POST);

        $usuarioDAO = new UsuarioDAO();
               
        if($usuarioDAO->verificaEmail($_POST['email'])){
            Sessao::gravaMensagem("Email existente");
            $this->redirect('/usuario/cadastro');
        }

        if($usuarioDAO->salvar($Usuario)){

            $linha_usuario = $usuarioDAO->pegarUsuarioPorEmail($_POST['email']);
            
            $contaDAO = new ContaDAO();

            switch ($_POST['tp_conta']) {
                case 1:
                    $conta = new ContaCorrente();
                    break;
                case 2:
                    $conta = new ContaPoupanca();
                    break;
            }

            $conta->setTitular($linha_usuario['id']);
            $conta->setTipo($_POST['tp_conta']);
            
            $contaDAO->criar_conta($conta);

            $linha_conta = $contaDAO->pegarConta($conta->getTitular());
            $conta->setId($linha_conta['id']);

            $contaDAO->criarContaPorTipo($conta);

            $this->redirect('/usuario/sucesso');
        }else{
            Sessao::gravaMensagem("Erro ao gravar");
        }
    }
    
    public function sucesso(){
        if(Sessao::retornaValorFormulario('nome')) {
            $this->render('/usuario/sucesso');

            Sessao::limpaFormulario();
            Sessao::limpaMensagem();
        }else{
            $this->redirect('/');
        }
    }

    public function index(){
        $this->redirect('/usuario/cadastro');
    }

}