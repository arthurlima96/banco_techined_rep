CREATE TABLE usuario
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  senha VARCHAR(100) NOT NULL
);


CREATE TABLE conta
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  agencia INT NOT NULL,
  numero INT NOT NULL,
  titular INT NOT NULL,
  saldo DOUBLE NOT NULL,
  tipo INT NOT NULL, 
  data_abertura DATETIME DEFAULT NOW(),
  FOREIGN KEY (titular) REFERENCES usuario(id)
);

CREATE TABLE conta_corrente
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  conta_id INT NOT NULL,
  limite_especial DOUBLE NOT NULL DEFAULT 50,
  FOREIGN KEY (conta_id) REFERENCES conta(id)
);

CREATE TABLE conta_poupanca
(
  id INT PRIMARY KEY AUTO_INCREMENT,
  data_rendimento DATETIME,
  conta_id INT NOT NULL,
  FOREIGN KEY (conta_id) REFERENCES conta(id)
);