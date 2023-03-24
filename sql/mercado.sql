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
    deleted BOOLEAN DEFAULT false,
    data_cadastro TIMESTAMP
);

CREATE TABLE produtos (
    id INT GENERATED ALWAYS AS IDENTITY pRIMARY KEY,
    nome VARCHAR(100),
    valor NUMERIC(9,2),
    qtde DECIMAL,
    categoria_id int,
    deleted BOOLEAN DEFAULT false,
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
    VALUES('avulso', '12345678911', current_timestamp);

INSERT INTO categorias(nome, percentual, data_cadastro)
    VALUES
    ('biscoitos', 0.18, current_timestamp),
    ('massas', 0.44, current_timestamp);

INSERT INTO produtos(nome, valor, qtde, categoria_id, data_cadastro)
    VALUES
    ('rosquinha mabel', 11.49, 60, 1, current_timestamp),
    ('macarrao 500g', 4.90, 70, 2, current_timestamp),
    ('pao frances 50g', 1.19, 100, 2, current_timestamp);