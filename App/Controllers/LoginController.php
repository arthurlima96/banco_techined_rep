<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\UsuarioDAO;
use App\Models\DAO\ContaDAO;
use App\Models\Entidades\Usuario;

class LoginController extends Controller{
    
    public function logar(){
        $Usuario = new Usuario();
        $Usuario->setEmail($_POST['email']);
        $Usuario->setSenha($_POST['senha']);

        $usuarioDAO = new UsuarioDAO();
        $contaDAO   = new ContaDAO();
        
        $linha = $usuarioDAO->verificaEmailESenha($Usuario);
        $contaUser = $contaDAO->pegarConta($linha['id']);
        if($linha){
            Sessao::gravaUsuario($linha['email']);
            Sessao::gravaId($linha['id']);
            Sessao::gravaAgencia($contaUser['agencia']);
            Sessao::gravaNumero($contaUser['numero']);
            Sessao::gravaSaldo($contaUser['saldo']);
            Sessao::gravaTipo($contaUser['tipo']);
            $this->redirect('/home/index');
        }else{
            Sessao::gravaMensagem("Erro ao logar");
            $this->redirect('/login');
        }
    }

    public function sair(){
        Sessao::limpaUsuario();
        Sessao::limpaId();
        Sessao::limpaAgencia();
        Sessao::limpaNumero();
        Sessao::limpaTipo();
        
        $this->redirect('/login');
    }

    public function index()  {
        $this->render('login/sign');
        Sessao::limpaMensagem();
    }
}