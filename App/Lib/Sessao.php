<?php

namespace App\Lib;

class Sessao{

    public static function gravaSaldo($saldo){
        $_SESSION['saldo'] = $saldo;
    }

    public static function retornaSaldo(){
        return ($_SESSION['saldo']) ? $_SESSION['saldo'] : "0.0";
    }

    public static function gravaTipo($tipo){
        $_SESSION['tipo'] = $tipo;
    }

    public static function limpaTipo(){
        unset($_SESSION['tipo']);
    }

    public static function retornaTipo(){
        return ($_SESSION['tipo']) ? $_SESSION['tipo'] : "";
    }

    public static function gravaNumero($numero){
        $_SESSION['numero'] = $numero;
    }

    public static function limpaNumero(){
        unset($_SESSION['numero']);
    }

    public static function retornaNumero(){
        return ($_SESSION['numero']) ? $_SESSION['numero'] : "";
    }

    public static function gravaAgencia($agencia){
        $_SESSION['agencia'] = $agencia;
    }

    public static function limpaAgencia(){
        unset($_SESSION['agencia']);
    }

    public static function retornaAgencia(){
        return ($_SESSION['agencia']) ? $_SESSION['agencia'] : "";
    }

    public static function gravaUsuario($usuario){
        $_SESSION['usuario'] = $usuario;
    }

    public static function limpaUsuario(){
        unset($_SESSION['usuario']);
    }

    public static function retornaUsuario(){
        return ($_SESSION['usuario']) ? $_SESSION['usuario'] : "";
    }

    public static function gravaId($id){
        $_SESSION['id'] = $id;
    }

    public static function limpaId(){
        unset($_SESSION['id']);
    }

    public static function retornaId(){
        return ($_SESSION['id']) ? $_SESSION['id'] : "";
    }

    public static function gravaMensagem($mensagem){
        $_SESSION['mensagem'] = $mensagem;
    }

    public static function limpaMensagem(){
        unset($_SESSION['mensagem']);
    }

    public static function retornaMensagem(){
        return ($_SESSION['mensagem']) ? $_SESSION['mensagem'] : "";
    }

    public static function gravaFormulario($form){
        $_SESSION['form'] = $form;
    }

    public static function limpaFormulario(){
        unset($_SESSION['form']);
    }

    public static function retornaValorFormulario($key){
        return (isset($_SESSION['form'][$key])) ? $_SESSION['form'][$key] : "";
    }

    public static function existeFormulario(){
        return (isset($_SESSION['form'])) ? $_SESSION['form'] : "";
    }
}