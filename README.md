# Banco Techined

Foi desenvolvido um sistema web com `PHP` 7.1.7 sendo executado em por meio do `XAMPP` em um servidor `Apache`. Foi utilizado o `Composer` para gerenciar as dependências utilizadas no projeto.

Infraestrutura necessária:
  - MySQL
  - PHP 7
  - XAMPP

# Configurações para acessar o banco de dados
É necessario criar uma base da dados `techined_banco`, rodando no servidor localmente, caso não tenha o `PDO` habilitado, siga os passos abaixo:
  - Acessar na servidor o arquivo `php.ini`
  - Retirar o `;` que está no inicio do parametro `extension=php_mysql.dll`
  - Em seguida reiniciar o servidor

É necessario criar as tabelas no banco de dados:
  - Vá até o endereço raiz do projeto, localize o arquivo `dump.sql`
  - Execute ele para criação das  tabelas, no gerenciador de banco de dados de sua preferência
  - Verifique se as tabelas foram criadas

Se for necessario alterar o nome do banco, usuario ou senha. No caminha `bancotechined\App\App.php` abra o arquivo.

```sh
        define('DB_HOST'        , "localhost");
        define('DB_USER'        , "root");
        define('DB_PASSWORD'    , "root");
        define('DB_NAME'        , "techined_banco");
```

Acima é como está definido atualmente, modifique caso necessário.
# Acesso da aplicação
Depois de executar a criação do banco e das suas repectivas tabelas, é necessario colocar o projeto na pasta de execução utlizada pelo servidor. acesse no seu navegador `localhost/bancotechined`, verifique se a página foi renderizada.

-   No primeiro acesso é nessário cadastrar um usuário
-   Em seguida acesse o usuario cadastrado no link de login

# Requisitos aplicados

### 1 . Diferentes tipos de contas:
> Tudo o que ele precisa fazer é representar diferentes tipos de contas bancárias e  suas especificidades.

Na tela de cadastro de usuário, pode-se escolher qual é o tipo de conta: Conta Corrente ou Poupança. 

### 2 . Diferentes tipos de contas:
> Todas as contas devem ter como atributos o número, agência, titular, data de abertura e saldo.

Foi criado uma tabela no banco de dados, que abrange os atributos requeridos, a tabela `Conta`.

### 3 . Ações bancárias :
> Em todas elas deve ser possível realizar saques, depósitos e transferências.

Foram definidaas todas as ações requisitadas, na tela inicial do sistema já é possivel acessa-lás 

### 4 . Ações bancárias :
> Para saques e transferências o sistema deve impedir que seja retirado um valor da conta maior que o saldo disponíve

Tal requisito foi aplicado, onde foi necessario fazer essa verificação, como no exemplo abaixo: 

```sh
    if( $_POST['valor'] <= $linha['saldo']){
        $conta = new Conta();
        $conta->setSaldo($linha['saldo'] - $_POST['valor']);
        $conta->setTitular(Sessao::retornaId());
        $contaDAO->atualizarSaldo($conta);
    }
```

Condicional encontra-se no arquivo `bancotechined\App\Controllers\ContaController.php` no método `sacar()` ;

### 5 . Valor real para déposito :
> Em depósitos deve-se garantir que o que está sendo depositado realmente é um número real. O mesmo vale para transferências e pedidos de saque, obviamente.

Tal requisito foi aplicado, onde foi necessario fazer essa verificação, como no exemplo abaixo: 

```sh
<input type="number" class="form-control" name="valor" ...  min="1" step="0.01" required>
```

No trecho acima defini-se que somente numeros maiores que 1 vão ser aceitos para que seja feito o déposito.

### 6 . Limite especial de saque :
> Em uma conta corrente é possível que haja um limite especial para o usuário saca além da quantidade de saldo disponível.

Tal requisito foi aplicado, onde foi necessario fazer essa verificação, como no exemplo abaixo: 

```sh
    if ($_POST['valor'] <= $linha['limite_especial']) {
        $conta = new Conta();
        $conta->setLimite_especial($linha['limite_especial'] - $_POST['valor']);
        $conta->setTitular(Sessao::retornaId());

        $contaDAO->atualizarSaldoEspecial($conta);
    }else{
```

Na condicional acima defini-se a estratégia para saque por meio do  limite especial, além disso foi definido por `default` um valor de R$ 50,00 para efetuar o saque.

Condicional encontra-se no arquivo `bancotechined\App\Controllers\ContaController.php` no método `sacar()` ;

### 7 . Taxa de transferência :
> Quando acontecer uma transferência de uma conta corrente para uma outra conta corrente ou poupança, deve ser descontado do saldo restante um valor equivalente a 3% do valor transferido.

Tal requisito foi aplicado, onde foi necessario fazer essa verificação, como no exemplo abaixo: 

```sh
    $this->adicionarSaldoDest($contaDest,$valorDest);
        $contaUser['saldo'] -= $valorDest*0.03;
        $this->subtrairSaldoAtual($contaUser,$valorDest);
```

Na condicional acima defini-se a estratégia para saque por meio do  limite especial, além disso foi definido por `default` um valor de R$ 50,00 para efetuar o saque.

Condicional encontra-se no arquivo `bancotechined\App\Controllers\ContaController.php` no método `transferir()` ;

### 8 . rendimento programado :
> Em uma conta poupança deve haver uma taxa de rendimento de 0,5% e uma ação que possa ser invocada para aplicar esse rendimento sobre o saldo em determinados períodos de tempo.

Tal requisito foi aplicado, onde foi necessario fazer essa verificação, como no exemplo abaixo: 

```sh
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
```

No método acima defini-se uma forma programada para o rendimento da poupanção, o rendimento de %0,5 mensalmente, por meio da checagem de um atributo na tabela `Conta` verifica-se de o rendimento está disponivel, lembrando que ele aplica-se somente para Conta Poupança.

### 9 . Detalhe a mais :

> Leve em consideração que é possível que surjam novas modalidades de contas no futuro, que terão algo em comum com as modalidades já existentes e possivelmente algo específico. Tente deixar o código de pronto para receber essa evolução sem sofrer grandes traumas.

Para resolver essa questão, optei por adotar a arquitetura MVC, organizando de forma modular os arquivos, casa seja necessária uma evolução, é muito simples de implementar.