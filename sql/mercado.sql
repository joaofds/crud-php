SET CONSTRAINTS ALL DEFERRED;

DROP TABLE IF EXISTS clientes;
DROP TABLE IF EXISTS categorias;
DROP TABLE IF EXISTS produtos;
DROP TABLE IF EXISTS vendas;

CREATE TABLE clientes (
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nome VARCHAR(100),
    cpf VARCHAR(11),
    data_cadastro TIMESTAMP
);

CREATE TABLE categorias (
    id INT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
    nome VARCHAR(100),
    percentual NUMERIC(9,2),
    data_cadastro TIMESTAMP
);

CREATE TABLE produtos (
    id INT GENERATED ALWAYS AS IDENTITY pRIMARY KEY,
    nome VARCHAR(100),
    valor NUMERIC(9,2),
    qtde DECIMAL,
    categoria_id int,
    data_cadastro TIMESTAMP,
    
    CONSTRAINT fk_categorias_produtos
        FOREIGN KEY(categoria_id)
        REFERENCES categorias(id)
);

CREATE TABLE vendas (
    id INT GENERATED ALWAYS AS IDENTITY pRIMARY KEY,
    cliente_id int,
    produto_id int,
    qtde int,
    data_cadastro TIMESTAMP,
    
    CONSTRAINT fk_clientes_vendas
        FOREIGN KEY(cliente_id)
        REFERENCES clientes(id),
        
    CONSTRAINT fk_produtos_vendas
        FOREIGN KEY(produto_id)
        REFERENCES produtos(id)
);

INSERT INTO clientes(nome, cpf, data_cadastro)
    VALUES('avulso', '12345678911', current_timestamp);

INSERT INTO categorias(nome, percentual, data_cadastro)
    VALUES('outros', 10, current_timestamp);

INSERT INTO produtos(nome, valor, qtde, categoria_id, data_cadastro)
    VALUES('produto exemplo', 9.99, 7, 1, current_timestamp);

INSERT INTO vendas(cliente_id, produto_id, qtde, data_cadastro)
    VALUES(1, 1, 3, current_timestamp);