CREATE DATABASE IF NOT EXISTS lifetool;
USE lifetool;

CREATE TABLE IF NOT EXISTS cadconta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    genero CHAR(1) NOT NULL,
    senha VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS tbusuario_info (
    usuario_id INT PRIMARY KEY,
    objetivo VARCHAR(255),
    peso_atual DECIMAL(5, 2),
    altura DECIMAL(3, 2),
    nivel_atividade VARCHAR(50),
    dias_treino_semana INT,
    FOREIGN KEY (usuario_id) REFERENCES cadconta(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS tbdieta (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    dia_semana VARCHAR(10),
    refeicao VARCHAR(20),
    descricao VARCHAR(255),
    FOREIGN KEY (usuario_id) REFERENCES cadconta(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS tbtreino (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    dia_semana VARCHAR(10),
    exercicio VARCHAR(255),
    series INT,
    repeticoes INT,
    FOREIGN KEY (usuario_id) REFERENCES cadconta(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS tbcontrolefinanceiro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    data_registro DATE NOT NULL,
    salario_total DECIMAL(10, 2),
    valor_saida DECIMAL(10, 2),
    descricao_saida VARCHAR(255),
    valor_entrada DECIMAL(10, 2),
    descricao_entrada VARCHAR(255),
    poupado DECIMAL(10, 2),
    FOREIGN KEY (usuario_id) REFERENCES cadconta(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS tbagenda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    data_compromisso DATE NOT NULL,
    hora_compromisso TIME,
    atividade VARCHAR(255) NOT NULL,
    descricao TEXT,
    FOREIGN KEY (usuario_id) REFERENCES cadconta(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS tbcontroletrabalho (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    descricao TEXT,
    status ENUM('a_fazer', 'fazendo', 'feito') DEFAULT 'a_fazer',
    data_entrega DATE,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES cadconta(id) ON DELETE CASCADE
);