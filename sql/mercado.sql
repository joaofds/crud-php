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
    total_venda NUMERIC(9,2),
    total_imposto NUMERIC(9,2),
    data_cadastro TIMESTAMP,
    
    CONSTRAINT fk_clientes_vendas
        FOREIGN KEY(cliente_id)
        REFERENCES clientes(id)
);

CREATE TABLE vendas_itens (
    venda_id int,
    produto_id int,
    qtde int,
    preco_unt NUMERIC(9,2),
    total NUMERIC(9,2),
    total_imposto NUMERIC(9,2),
    
    CONSTRAINT fk_vendas_vendas_itens
        FOREIGN KEY(venda_id)
        REFERENCES vendas(id),
        
    CONSTRAINT fk_produtos_vendas_itens
        FOREIGN KEY(produto_id)
        REFERENCES produtos(id)
);

INSERT INTO clientes(nome, cpf, data_cadastro)
    VALUES('AVULSO', '12345678911', current_timestamp);

INSERT INTO categorias(nome, percentual, data_cadastro)
    VALUES('OUTROS', 10, current_timestamp);

INSERT INTO produtos(nome, valor, qtde, categoria_id, data_cadastro)
    VALUES
    ('PRODUTO 1', 2.99, 3, 1, current_timestamp),
    ('PRODUTO 2', 4.90, 5, 1, current_timestamp);

INSERT INTO vendas(cliente_id, total_venda, total_imposto, data_cadastro)
    VALUES
    (1, 8.97, 0.89, current_timestamp),
    (1, 24.50, 2.45, current_timestamp);
    
INSERT INTO vendas_itens(venda_id, produto_id, qtde, preco_unt, total, total_imposto)
    VALUES
    (1, 1, 3, 2.99, 8.97, 0.30),
    (2, 2, 5, 4.90, 24.50, 2.45);