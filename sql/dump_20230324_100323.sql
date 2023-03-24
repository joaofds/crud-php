--
-- PostgreSQL database dump
--

-- Dumped from database version 12.4
-- Dumped by pg_dump version 15rc2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: public; Type: SCHEMA; Schema: -; Owner: postgres
--

-- *not* creating schema, since initdb creates it


ALTER SCHEMA public OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: categorias; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.categorias (
    id integer NOT NULL,
    nome character varying(100),
    percentual numeric(9,2),
    deleted boolean DEFAULT false,
    data_cadastro timestamp without time zone
);


ALTER TABLE public.categorias OWNER TO postgres;

--
-- Name: categorias_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.categorias ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.categorias_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: clientes; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.clientes (
    id integer NOT NULL,
    nome character varying(100),
    cpf character varying(11),
    data_cadastro timestamp without time zone
);


ALTER TABLE public.clientes OWNER TO postgres;

--
-- Name: clientes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.clientes ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.clientes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: produtos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.produtos (
    id integer NOT NULL,
    nome character varying(100),
    valor numeric(9,2),
    qtde numeric,
    categoria_id integer,
    deleted boolean DEFAULT false,
    data_cadastro timestamp without time zone
);


ALTER TABLE public.produtos OWNER TO postgres;

--
-- Name: produtos_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.produtos ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.produtos_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: vendas; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vendas (
    id integer NOT NULL,
    cliente_id integer,
    total_venda numeric(9,2),
    total_imposto numeric(9,2),
    data_cadastro timestamp without time zone
);


ALTER TABLE public.vendas OWNER TO postgres;

--
-- Name: vendas_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

ALTER TABLE public.vendas ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public.vendas_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);


--
-- Name: vendas_itens; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.vendas_itens (
    venda_id integer,
    produto_id integer,
    qtde integer,
    preco_unt numeric(9,2),
    total numeric(9,2),
    total_imposto numeric(9,2)
);


ALTER TABLE public.vendas_itens OWNER TO postgres;

--
-- Data for Name: categorias; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.categorias OVERRIDING SYSTEM VALUE VALUES
	(1, 'biscoitos', 0.18, false, '2023-03-24 10:58:25.801123'),
	(2, 'massas', 0.44, false, '2023-03-24 10:58:25.801123');


--
-- Data for Name: clientes; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.clientes OVERRIDING SYSTEM VALUE VALUES
	(1, 'avulso', '12345678911', '2023-03-24 10:58:25.801123');


--
-- Data for Name: produtos; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.produtos OVERRIDING SYSTEM VALUE VALUES
	(3, 'pao frances 50g', 1.19, 100, 2, false, '2023-03-24 10:58:25.801123'),
	(2, 'macarrao 500g', 4.90, 70, 2, false, '2023-03-24 10:58:25.801123'),
	(1, 'rosquinha mabel', 11.49, 60, 1, false, '2023-03-24 10:58:25.801123');


--
-- Data for Name: vendas; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.vendas OVERRIDING SYSTEM VALUE VALUES
	(1, 1, 2.38, 1.05, '2023-03-24 08:07:47'),
	(2, 1, 70.82, 16.22, '2023-03-24 10:01:22');


--
-- Data for Name: vendas_itens; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.vendas_itens VALUES
	(1, 3, 2, 1.19, 2.38, 1.05),
	(2, 3, 3, 1.19, 3.57, 1.57),
	(2, 2, 2, 4.90, 9.80, 4.31),
	(2, 1, 5, 11.49, 57.45, 10.34);


--
-- Name: categorias_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categorias_id_seq', 2, true);


--
-- Name: clientes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.clientes_id_seq', 1, true);


--
-- Name: produtos_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.produtos_id_seq', 3, true);


--
-- Name: vendas_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.vendas_id_seq', 2, true);


--
-- Name: categorias categorias_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categorias
    ADD CONSTRAINT categorias_pkey PRIMARY KEY (id);


--
-- Name: clientes clientes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.clientes
    ADD CONSTRAINT clientes_pkey PRIMARY KEY (id);


--
-- Name: produtos produtos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produtos
    ADD CONSTRAINT produtos_pkey PRIMARY KEY (id);


--
-- Name: vendas vendas_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas
    ADD CONSTRAINT vendas_pkey PRIMARY KEY (id);


--
-- Name: produtos fk_categorias_produtos; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.produtos
    ADD CONSTRAINT fk_categorias_produtos FOREIGN KEY (categoria_id) REFERENCES public.categorias(id);


--
-- Name: vendas fk_clientes_vendas; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas
    ADD CONSTRAINT fk_clientes_vendas FOREIGN KEY (cliente_id) REFERENCES public.clientes(id);


--
-- Name: vendas_itens fk_produtos_vendas_itens; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas_itens
    ADD CONSTRAINT fk_produtos_vendas_itens FOREIGN KEY (produto_id) REFERENCES public.produtos(id);


--
-- Name: vendas_itens fk_vendas_vendas_itens; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.vendas_itens
    ADD CONSTRAINT fk_vendas_vendas_itens FOREIGN KEY (venda_id) REFERENCES public.vendas(id);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE USAGE ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

