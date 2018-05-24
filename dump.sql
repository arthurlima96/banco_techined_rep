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
    data_abertura DATETIME DEFAULT NOW(),
    data_rendimento DATETIME,
    tipo VARCHAR(100) NOT NULL,
    limite_especial DOUBLE NOT NULL DEFAULT 50,
    FOREIGN KEY (titular) REFERENCES usuario(id)
);