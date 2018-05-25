<?php
namespace App\Controllers;

use App\Lib\Sessao;
use App\Models\DAO\ContaDAO;
use App\Models\Entidades\Conta;

class ContaController extends Controller{

  public function sucesso(){
    $this->render('/conta/sucesso');

    Sessao::limpaFormulario();
    Sessao::limpaMensagem();
  }

  public function rendimento(){
    $contaDAO = new ContaDAO();
    $usuarioAtual = $contaDAO->pegarConta(Sessao::retornaId()); 
    $dataRedimentoUser = date('m', strtotime($usuarioAtual['data_rendimento']));
    $dataEMesAtual = date('m');
    if($dataEMesAtual != $dataRedimentoUser){

      $usuarioAtual['saldo'] +=  $usuarioAtual['saldo']*0.005;
      $usuarioAtual['data_rendimento'] = date('Y-m-d h:i:s');
      
      $conta = new Conta();
      $conta->setSaldo($usuarioAtual['saldo']);
      $conta->setTitular($usuarioAtual['titular']);
      $conta->setData_rendimento($usuarioAtual['data_rendimento']);

      $contaDAO = new ContaDAO();
      $contaDAO->atualizarSaldoRend($conta);

      Sessao::gravaSaldo($this->verificarSaldo());
      $this->redirect('/conta/sucessoRend');
    
    }else{
      $this->redirect('/conta/errorRend');
    }
  }

  public function sucessoRend(){
    $this->render('/conta/sucessoRend');

    Sessao::limpaFormulario();
    Sessao::limpaMensagem();
  }

  public function errorRend(){
    $this->render('/conta/errorRend');

    Sessao::limpaFormulario();
    Sessao::limpaMensagem();
  }

  public function deposito(){
    $this->render('/conta/deposito');

    Sessao::limpaFormulario();
    Sessao::limpaMensagem();
  }


  public function depositar(){
    $contaDAO = new ContaDAO();
    $linha = $contaDAO->pegarConta(Sessao::retornaId()); 

    $conta = new Conta();
    $conta->setSaldo($linha['saldo'] + $_POST['valor']);
    $conta->setTitular(Sessao::retornaId());

    $contaDAO->atualizarSaldo($conta);

    Sessao::limpaFormulario();
    Sessao::limpaMensagem();

    Sessao::gravaSaldo($this->verificarSaldo());
    $this->redirect('/conta/sucesso');
    
  }  

  public function saque(){
    $this->render('/conta/saque');

    Sessao::limpaFormulario();
    Sessao::limpaMensagem();
  }

  public function sacar(){
    $contaDAO = new ContaDAO();
    $linha = $contaDAO->pegarConta(Sessao::retornaId()); 

    if( $_POST['valor'] <= $linha['saldo']){
        $conta = new Conta();
        $conta->setSaldo($linha['saldo'] - $_POST['valor']);
        $conta->setTitular(Sessao::retornaId());

        $contaDAO->atualizarSaldo($conta);
    }elseif ($_POST['valor'] <= $linha['limite_especial']) {
        $conta = new Conta();
        $conta->setLimite_especial($linha['limite_especial'] - $_POST['valor']);
        $conta->setTitular(Sessao::retornaId());

        $contaDAO->atualizarSaldoEspecial($conta);
    }else{
        Sessao::gravaMensagem("Valor de saque maior que o saldo especial");
        $this->redirect('/conta/saque');
    }
    
    Sessao::limpaFormulario();
    Sessao::limpaMensagem();
    Sessao::gravaSaldo($this->verificarSaldo());
    $this->redirect('/conta/sucesso');
  }  

  public function transferencia(){
    $this->render('/conta/transferencia');

    Sessao::limpaFormulario();
    Sessao::limpaMensagem();
  }

  public function transferir(){
    $agenciaDest = $_POST['agencia'];
    $numeroDest  = $_POST['numero'];
    $valorDest   = $_POST['valor'];

    Sessao::gravaFormulario($_POST);

    $contaDAO = new ContaDAO();

    $contaDest = $contaDAO->verificarConta($agenciaDest,$numeroDest);
    $contaUser = $contaDAO->pegarConta(Sessao::retornaId()); 

    if($valorDest<=$contaUser['saldo'] ){
      if($contaDest && $contaUser['tipo']=='Conta Poupança'){
        $this->adicionarSaldoDest($contaDest,$valorDest);
        $this->subtrairSaldoAtual($contaUser,$valorDest);
      }elseif($contaDest){      
        $this->adicionarSaldoDest($contaDest,$valorDest);
        $contaUser['saldo'] -= $valorDest*0.03;
        $this->subtrairSaldoAtual($contaUser,$valorDest);
      }else{
        Sessao::gravaMensagem("Agência ou numero da conta inválido");
        $this->redirect('/conta/transferencia');
      }
    }else{
      Sessao::gravaMensagem("Valor inválido, maior que seu saldo atual");
      $this->redirect('/conta/transferencia');
    }

    Sessao::gravaSaldo($this->verificarSaldo());
    $this->redirect('/conta/sucesso');

    Sessao::limpaFormulario();
    Sessao::limpaMensagem();
  }

  private function subtrairSaldoAtual($contaAtual,$valorTrans){
      $conta = new Conta();
      $conta->setSaldo($contaAtual['saldo'] - $valorTrans);
      $conta->setTitular(Sessao::retornaId());

      $contaDAO = new ContaDAO();
      $contaDAO->atualizarSaldo($conta);
  }

  private function adicionarSaldoDest($contaDest,$valorTrans){
    $conta = new Conta();
    $conta->setSaldo($contaDest['saldo']+$valorTrans);
    $conta->setTitular($contaDest['titular']);

    $contaDAO = new ContaDAO();
    $contaDAO->atualizarSaldo($conta);
  }

  private function verificarSaldo(){
    $contaDAO = new ContaDAO();
    $conta = $contaDAO->pegarConta(Sessao::retornaId());
    return $conta['saldo'];  
  }

  public function index()  {
      $this->render('home/index');
  }
}