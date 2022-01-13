--
-- PostgreSQL database dump
--

-- Dumped from database version 10.19 (Ubuntu 10.19-2.pgdg20.04+1)
-- Dumped by pg_dump version 11.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_id_user_foreign;
ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_perfil_foreign;
ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_organizacao_fo;
ALTER TABLE ONLY public.rel_organizacao DROP CONSTRAINT rel_organizacao_rel_cod_organizacao_foreign;
ALTER TABLE ONLY public.rel_organizacao DROP CONSTRAINT rel_organizacao_cod_organizacao_foreign;
ALTER TABLE ONLY public.acoes DROP CONSTRAINT acoes_id_user_foreign;
ALTER TABLE ONLY pei.tab_plano_de_acao DROP CONSTRAINT pei_tab_plano_de_acao_cod_tipo_execucao_foreign;
ALTER TABLE ONLY pei.tab_plano_de_acao DROP CONSTRAINT pei_tab_plano_de_acao_cod_organizacao_foreign;
ALTER TABLE ONLY pei.tab_plano_de_acao DROP CONSTRAINT pei_tab_plano_de_acao_cod_objetivo_estrategico_foreign;
ALTER TABLE ONLY pei.tab_perspectiva DROP CONSTRAINT pei_tab_perspectiva_cod_pei_foreign;
ALTER TABLE ONLY pei.tab_objetivo_estrategico DROP CONSTRAINT pei_tab_objetivo_estrategico_cod_perspectiva_foreign;
ALTER TABLE ONLY pei.tab_missao_visao_valores DROP CONSTRAINT pei_tab_missao_visao_valores_cod_pei_foreign;
ALTER TABLE ONLY pei.tab_missao_visao_valores DROP CONSTRAINT pei_tab_missao_visao_valores_cod_organizacao_foreign;
DROP INDEX public.sessions_user_id_index;
DROP INDEX public.sessions_last_activity_index;
DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
DROP INDEX public.password_resets_email_index;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_cpf_unique;
ALTER TABLE ONLY public.tab_perfil_acesso DROP CONSTRAINT tab_perfil_acesso_pkey;
ALTER TABLE ONLY public.tab_organizacoes DROP CONSTRAINT tab_organizacoes_pkey;
ALTER TABLE ONLY public.sessions DROP CONSTRAINT sessions_pkey;
ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_pkey;
ALTER TABLE ONLY public.rel_organizacao DROP CONSTRAINT rel_organizacao_pkey;
ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
ALTER TABLE ONLY public.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
ALTER TABLE ONLY public.migrations DROP CONSTRAINT migrations_pkey;
ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
ALTER TABLE ONLY public.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
ALTER TABLE ONLY public.acoes DROP CONSTRAINT acoes_pkey;
ALTER TABLE ONLY pei.tab_tipo_execucao DROP CONSTRAINT tab_tipo_execucao_pkey;
ALTER TABLE ONLY pei.tab_plano_de_acao DROP CONSTRAINT tab_plano_de_acao_pkey;
ALTER TABLE ONLY pei.tab_perspectiva DROP CONSTRAINT tab_perspectiva_pkey;
ALTER TABLE ONLY pei.tab_pei DROP CONSTRAINT tab_pei_pkey;
ALTER TABLE ONLY pei.tab_objetivo_estrategico DROP CONSTRAINT tab_objetivo_estrategico_pkey;
ALTER TABLE ONLY pei.tab_nivel_hierarquico DROP CONSTRAINT tab_nivel_hierarquico_pkey;
ALTER TABLE ONLY pei.tab_missao_visao_valores DROP CONSTRAINT tab_missao_visao_valores_pkey;
ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
DROP TABLE public.users;
DROP TABLE public.tab_perfil_acesso;
DROP TABLE public.tab_organizacoes;
DROP TABLE public.sessions;
DROP TABLE public.rel_users_tab_organizacoes_tab_perfil_acesso;
DROP TABLE public.rel_organizacao;
DROP SEQUENCE public.personal_access_tokens_id_seq;
DROP TABLE public.personal_access_tokens;
DROP TABLE public.password_resets;
DROP SEQUENCE public.migrations_id_seq;
DROP TABLE public.migrations;
DROP SEQUENCE public.failed_jobs_id_seq;
DROP TABLE public.failed_jobs;
DROP TABLE public.acoes;
DROP TABLE pei.tab_tipo_execucao;
DROP TABLE pei.tab_plano_de_acao;
DROP TABLE pei.tab_perspectiva;
DROP TABLE pei.tab_pei;
DROP TABLE pei.tab_objetivo_estrategico;
DROP TABLE pei.tab_nivel_hierarquico;
DROP TABLE pei.tab_missao_visao_valores;
DROP SCHEMA pei;
--
-- Name: pei; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA pei;


ALTER SCHEMA pei OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: tab_missao_visao_valores; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_missao_visao_valores (
    cod_missao_visao_valores uuid NOT NULL,
    dsc_missao text NOT NULL,
    dsc_visao text NOT NULL,
    dsc_valores text NOT NULL,
    cod_pei uuid NOT NULL,
    cod_organizacao uuid NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_missao_visao_valores OWNER TO marcio;

--
-- Name: tab_nivel_hierarquico; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_nivel_hierarquico (
    num_nivel_hierarquico_apresentacao smallint NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_nivel_hierarquico OWNER TO marcio;

--
-- Name: tab_objetivo_estrategico; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_objetivo_estrategico (
    cod_objetivo_estrategico uuid NOT NULL,
    dsc_objetivo_estrategico text NOT NULL,
    num_nivel_hierarquico_apresentacao smallint NOT NULL,
    cod_perspectiva uuid NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_objetivo_estrategico OWNER TO marcio;

--
-- Name: tab_pei; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_pei (
    cod_pei uuid NOT NULL,
    dsc_pei text NOT NULL,
    num_ano_inicio_pei smallint NOT NULL,
    num_ano_fim_pei smallint NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_pei OWNER TO marcio;

--
-- Name: tab_perspectiva; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_perspectiva (
    cod_perspectiva uuid NOT NULL,
    dsc_perspectiva text NOT NULL,
    num_nivel_hierarquico_apresentacao smallint NOT NULL,
    cod_pei uuid NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_perspectiva OWNER TO marcio;

--
-- Name: tab_plano_de_acao; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_plano_de_acao (
    cod_plano_de_acao uuid NOT NULL,
    cod_objetivo_estrategico uuid NOT NULL,
    cod_tipo_execucao uuid NOT NULL,
    cod_organizacao uuid NOT NULL,
    num_nivel_hierarquico_apresentacao smallint NOT NULL,
    dsc_plano_de_acao text NOT NULL,
    txt_principais_entregas text,
    dte_inicio date NOT NULL,
    dte_fim date NOT NULL,
    vlr_orcamento_previsto numeric(1000,2) NOT NULL,
    bln_status character varying(255) NOT NULL,
    cod_ppa character varying(255),
    cod_loa character varying(255),
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_plano_de_acao OWNER TO marcio;

--
-- Name: tab_tipo_execucao; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_tipo_execucao (
    cod_tipo_execucao uuid NOT NULL,
    dsc_tipo_execucao character varying(255) NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_tipo_execucao OWNER TO marcio;

--
-- Name: acoes; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.acoes (
    id uuid NOT NULL,
    id_table character varying(255) NOT NULL,
    id_user uuid NOT NULL,
    "table" character varying(255) NOT NULL,
    acao text NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.acoes OWNER TO marcio;

--
-- Name: failed_jobs; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE public.failed_jobs OWNER TO marcio;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: public; Owner: marcio
--

CREATE SEQUENCE public.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.failed_jobs_id_seq OWNER TO marcio;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: marcio
--

ALTER SEQUENCE public.failed_jobs_id_seq OWNED BY public.failed_jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO marcio;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: marcio
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO marcio;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: marcio
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: password_resets; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE public.password_resets OWNER TO marcio;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.personal_access_tokens (
    id bigint NOT NULL,
    tokenable_type character varying(255) NOT NULL,
    tokenable_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    token character varying(64) NOT NULL,
    abilities text,
    last_used_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.personal_access_tokens OWNER TO marcio;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: public; Owner: marcio
--

CREATE SEQUENCE public.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.personal_access_tokens_id_seq OWNER TO marcio;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: marcio
--

ALTER SEQUENCE public.personal_access_tokens_id_seq OWNED BY public.personal_access_tokens.id;


--
-- Name: rel_organizacao; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.rel_organizacao (
    id uuid NOT NULL,
    cod_organizacao uuid NOT NULL,
    rel_cod_organizacao uuid NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.rel_organizacao OWNER TO marcio;

--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.rel_users_tab_organizacoes_tab_perfil_acesso (
    id uuid NOT NULL,
    id_user uuid NOT NULL,
    cod_organizacao uuid NOT NULL,
    cod_perfil uuid NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.rel_users_tab_organizacoes_tab_perfil_acesso OWNER TO marcio;

--
-- Name: sessions; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.sessions (
    id character varying(255) NOT NULL,
    user_id uuid,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE public.sessions OWNER TO marcio;

--
-- Name: tab_organizacoes; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.tab_organizacoes (
    cod_organizacao uuid NOT NULL,
    sgl_organizacao character varying(255) NOT NULL,
    nom_organizacao text NOT NULL,
    rel_cod_organizacao uuid,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.tab_organizacoes OWNER TO marcio;

--
-- Name: tab_perfil_acesso; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.tab_perfil_acesso (
    cod_perfil uuid NOT NULL,
    dsc_perfil text NOT NULL,
    dsc_permissao text NOT NULL,
    deleted_at timestamp(0) without time zone,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone
);


ALTER TABLE public.tab_perfil_acesso OWNER TO marcio;

--
-- Name: users; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.users (
    id uuid NOT NULL,
    cpf character varying(11),
    name character varying(255) NOT NULL,
    email character varying(255) NOT NULL,
    ativo smallint DEFAULT '0'::smallint NOT NULL,
    email_verified_at timestamp(0) without time zone,
    password character varying(255) NOT NULL,
    trocarsenha smallint DEFAULT '0'::smallint NOT NULL,
    remember_token character varying(100),
    current_team_id bigint,
    profile_photo_path character varying(2048),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    two_factor_secret text,
    two_factor_recovery_codes text
);


ALTER TABLE public.users OWNER TO marcio;

--
-- Name: failed_jobs id; Type: DEFAULT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.failed_jobs ALTER COLUMN id SET DEFAULT nextval('public.failed_jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('public.personal_access_tokens_id_seq'::regclass);


--
-- Data for Name: tab_missao_visao_valores; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_missao_visao_valores (cod_missao_visao_valores, dsc_missao, dsc_visao, dsc_valores, cod_pei, cod_organizacao, deleted_at, created_at, updated_at) VALUES ('f8337876-53a2-466c-b203-082f7b56d037', 'Assistir o Ministro de Estado na condução estratégica de governo e prover o suporte para o alcance dos objetivos institucionais do Ministério.', 'Ser referência na consolidação da estratégia nacional para um Estado moderno e na gestão institucional.', 'Inovação, Proatividade, Cooperação, Foco no Resultado, Ética.', 'c64ca4bb-8f87-47e3-97b9-b3eb87b40deb', '3834910f-66f7-46d8-9104-2904d59e1241', NULL, '2021-11-24 15:28:42', '2021-11-24 15:28:42');


--
-- Data for Name: tab_nivel_hierarquico; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (1, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (2, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (3, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (4, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (5, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (6, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (7, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (8, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (9, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (10, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (11, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (12, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (13, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (14, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (15, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (16, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (17, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (18, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (19, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (20, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (21, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (22, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (23, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (24, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (25, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (26, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (27, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (28, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (29, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (30, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (31, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (32, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (33, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (34, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (35, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (36, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (37, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (38, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (39, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (40, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (41, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (42, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (43, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (44, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (45, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (46, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (47, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (48, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (49, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (50, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (51, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (52, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (53, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (54, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (55, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (56, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (57, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (58, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (59, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (60, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (61, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (62, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (63, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (64, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (65, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (66, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (67, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (68, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (69, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (70, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (71, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (72, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (73, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (74, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (75, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (76, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (77, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (78, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (79, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (80, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (81, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (82, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (83, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (84, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (85, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (86, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (87, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (88, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (89, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (90, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (91, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (92, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (93, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (94, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (95, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (96, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (97, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (98, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (99, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, deleted_at, created_at, updated_at) VALUES (100, NULL, '2021-11-09 09:59:21', '2021-11-09 09:59:21');


--
-- Data for Name: tab_objetivo_estrategico; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('5bb6ab27-40a6-4af9-b742-06a666a44fc3', 'Fortalecer a capacidade institucional', 1, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', NULL, '2021-11-24 15:49:32', '2021-11-24 15:49:32');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('f771e066-9e0f-4526-82d7-87bd68b92b55', 'Fortalecer as ações do Centro de Governo', 3, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', NULL, '2021-11-24 15:59:39', '2021-11-24 15:59:39');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('51bc941d-706d-4a20-a424-1830e2beb6b2', 'Aperfeiçoar a análise, articulação e monitoramento das ações governamentais', 4, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', NULL, '2021-11-24 16:00:54', '2021-11-24 16:00:54');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('a0cf9c57-1508-45d7-b4c9-60314530e061', 'Assegurar o alinhamento das políticas públicas à estratégia Nacional para a modernização do Estado', 2, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', NULL, '2021-11-24 15:58:57', '2021-11-24 16:01:04');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('892a7b22-e6a1-43ba-acf9-5f6467d63198', 'Fortalecer o Pacto Federativo', 5, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', NULL, '2021-11-24 16:01:56', '2021-11-24 16:01:56');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('05908aba-69b3-41f7-984a-b8a828b013d4', 'Fortalecer o relacionamento institucional', 6, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', NULL, '2021-11-24 16:02:41', '2021-11-24 16:02:41');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('1120f3d5-d34c-472e-af77-6cb0873d57ff', 'Comunicar ações de governo', 7, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', NULL, '2021-11-24 16:03:10', '2021-11-24 16:03:10');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('3c195b29-6522-44ce-a689-899b818ba71f', 'Alinhar as necessidades da sociedade e as políticas de governo', 8, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', NULL, '2021-11-24 16:03:58', '2021-11-24 16:03:58');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('a990b3a8-853f-40ec-ac3f-5903bbc65bcf', 'Proteção do Estado e Salvaguarda dos Interesses Nacionais', 9, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', NULL, '2021-11-24 16:04:52', '2021-11-24 16:04:52');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('a5235280-2d9c-43a0-a118-82d4c0c7204e', 'Assegurar a implementação da Política Nacional de Modernização do Estado', 10, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:01:00', '2021-11-25 13:01:39');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('34ee4c9e-244e-40b0-ba3b-91bbad68e348', 'Fortalecer o sistema de Governança da Presidência da República', 11, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:02:21', '2021-11-25 13:02:21');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('340bf6d5-7a56-4150-8f49-46e5932a195c', 'Assegurar a universalização do acesso aos atos oficiais e acesso à informação', 12, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:02:42', '2021-11-25 13:02:42');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('0c4bf513-0003-403b-a82b-e08a42b4380e', 'Garantir a segurança jurídica dos atos do Presidente da República', 13, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:02:58', '2021-11-25 13:02:58');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('b1afe341-f1e2-4dc2-9214-e29b4b5a8344', 'Fortalecer a promoção do voluntariado e a inclusão de pessoas em situação de vulnerabilidade', 14, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:03:21', '2021-11-25 13:03:21');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('60bc20fd-61a8-4221-af07-9b87b3e2b075', 'Integrar políticas públicas nacionais aos padrões da OCDE', 15, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:03:38', '2021-11-25 13:03:38');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('8a173bf1-3e88-4235-9825-46b768127475', 'Monitorar os programas, projetos e ações prioritárias da Presidência da República', 16, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:03:57', '2021-11-25 13:03:57');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('6e99715b-965b-4401-a8e1-c70ed1342336', 'Fortalecer a análise de mérito das propostas e posicionamentos legislativos', 17, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:04:17', '2021-11-25 13:04:17');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('7298d6e4-5dc5-46f8-b4b2-db68225c61ff', 'Fortalecer a articulação institucional e a representatividade internacional', 18, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:04:34', '2021-11-25 13:04:34');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('296d1655-334a-4e44-89f4-7c8079a4a7da', 'Aperfeiçoar a gestão dos processos, rotinas e procedimentos', 19, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:04:52', '2021-11-25 13:04:52');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('07d218d3-6a23-48cf-abce-ce2b37961eff', 'Gerar inteligência dos dados políticos do Governo Federal', 20, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:05:08', '2021-11-25 13:05:08');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('22d5475b-450b-4ef9-a6db-599c175007c3', 'Potencializar ações de assuntos estratégicos de defesa e segurança nacional', 21, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-25 13:05:30', '2021-11-25 13:05:30');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('3af137c7-d8a4-47e4-9bfd-ce0dc2b63938', 'Aperfeiçoar a gestão do conhecimento e inovação', 22, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-26 18:46:54', '2021-11-26 18:46:54');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('b0ee3b23-76aa-4969-9964-f05cab1ec6a0', 'Aperfeiçoar a gestão de inteligência do Estado', 23, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-26 18:47:13', '2021-11-26 18:47:13');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('aa0df061-c193-48af-885c-40e5c64ec414', 'Intensificar os mecanismos de proteção da PR e de outras instituições de Estado', 24, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', NULL, '2021-11-26 18:47:40', '2021-11-26 18:47:40');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('5f6d7967-d3ba-4abd-9b42-e596cd029821', 'Aprimorar a gestão de pessoas com foco nas competências necessárias à Presidência da República', 25, '1c8d3440-ca67-49ec-bb49-2264b2d509a8', NULL, '2021-11-26 18:51:32', '2021-11-26 18:51:48');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('cd783c8b-6ee0-463e-afb5-25200eaf2637', 'Aperfeiçoar os serviços logísticos e a infraestrutura física da Presidência da República', 26, '1c8d3440-ca67-49ec-bb49-2264b2d509a8', NULL, '2021-11-26 18:52:07', '2021-11-26 18:52:07');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('e8cae4e5-0ad5-4acd-8d4b-8e3d20da9ed3', 'Aperfeiçoar os serviços e infraestrutura de tecnologia de informação e comunicação da Presidência da República', 27, '1c8d3440-ca67-49ec-bb49-2264b2d509a8', NULL, '2021-11-26 18:52:24', '2021-11-26 18:52:24');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('b881376a-8d57-4c02-84db-63b6e4e76576', 'Aprimorar a gestão orçamentária e financeira com foco em resultados da Presidência da República', 28, '1c8d3440-ca67-49ec-bb49-2264b2d509a8', NULL, '2021-11-26 18:52:40', '2021-11-26 18:52:40');
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, deleted_at, created_at, updated_at) VALUES ('d6cd668e-333b-4a5e-9430-fc5528ebd232', 'Fortalecer os mecanismos de controle interno, comunicação e  Gestão da Presidência da República', 29, '1c8d3440-ca67-49ec-bb49-2264b2d509a8', NULL, '2021-11-26 18:52:57', '2021-11-26 18:52:57');


--
-- Data for Name: tab_pei; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_pei (cod_pei, dsc_pei, num_ano_inicio_pei, num_ano_fim_pei, deleted_at, created_at, updated_at) VALUES ('c64ca4bb-8f87-47e3-97b9-b3eb87b40deb', 'Planejamento Estratégico Integrado da Presidência da República', 2020, 2023, NULL, '2021-11-24 15:24:49', '2021-11-24 15:24:49');
INSERT INTO pei.tab_pei (cod_pei, dsc_pei, num_ano_inicio_pei, num_ano_fim_pei, deleted_at, created_at, updated_at) VALUES ('3424b284-1fcc-4dc0-8adf-adcf61f0b055', 'Planejamento Estratégico Integrado da Presidência da República', 2024, 2027, NULL, '2021-11-24 15:25:03', '2021-11-24 15:25:03');


--
-- Data for Name: tab_perspectiva; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_perspectiva (cod_perspectiva, dsc_perspectiva, num_nivel_hierarquico_apresentacao, cod_pei, deleted_at, created_at, updated_at) VALUES ('1c8d3440-ca67-49ec-bb49-2264b2d509a8', 'Suporte', 1, 'c64ca4bb-8f87-47e3-97b9-b3eb87b40deb', NULL, '2021-11-24 15:29:26', '2021-11-24 15:29:26');
INSERT INTO pei.tab_perspectiva (cod_perspectiva, dsc_perspectiva, num_nivel_hierarquico_apresentacao, cod_pei, deleted_at, created_at, updated_at) VALUES ('4cf54ed4-4d02-4395-aeb2-43d5314a2301', 'Processos Estruturantes', 2, 'c64ca4bb-8f87-47e3-97b9-b3eb87b40deb', NULL, '2021-11-24 15:30:27', '2021-11-24 15:30:27');
INSERT INTO pei.tab_perspectiva (cod_perspectiva, dsc_perspectiva, num_nivel_hierarquico_apresentacao, cod_pei, deleted_at, created_at, updated_at) VALUES ('7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', 'Resultados', 3, 'c64ca4bb-8f87-47e3-97b9-b3eb87b40deb', NULL, '2021-11-24 15:30:48', '2021-11-24 15:30:48');


--
-- Data for Name: tab_plano_de_acao; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_plano_de_acao (cod_plano_de_acao, cod_objetivo_estrategico, cod_tipo_execucao, cod_organizacao, num_nivel_hierarquico_apresentacao, dsc_plano_de_acao, txt_principais_entregas, dte_inicio, dte_fim, vlr_orcamento_previsto, bln_status, cod_ppa, cod_loa, deleted_at, created_at, updated_at) VALUES ('24a325c4-2389-43d8-bdf1-e1c2cfecb244', '5f6d7967-d3ba-4abd-9b42-e596cd029821', 'c00b9ebc-7014-4d37-97dc-7875e55fff1b', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', 1, 'Texto da Descrição', 'Text da Principais entregas', '2021-07-01', '2023-07-31', 1321333.00, 'Não iniciada', NULL, NULL, NULL, '2021-12-02 18:39:26', '2021-12-02 18:39:26');


--
-- Data for Name: tab_tipo_execucao; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_tipo_execucao (cod_tipo_execucao, dsc_tipo_execucao, deleted_at, created_at, updated_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff1b', 'Ação', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');
INSERT INTO pei.tab_tipo_execucao (cod_tipo_execucao, dsc_tipo_execucao, deleted_at, created_at, updated_at) VALUES ('ecef6a50-c010-4cda-afc3-cbda245b55b0', 'Iniciativa', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');
INSERT INTO pei.tab_tipo_execucao (cod_tipo_execucao, dsc_tipo_execucao, deleted_at, created_at, updated_at) VALUES ('57518c30-3bc5-4305-a998-8ce8b11550ed', 'Projeto', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');


--
-- Data for Name: acoes; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.acoes (id, id_table, id_user, "table", acao, deleted_at, created_at, updated_at) VALUES ('b479095f-7dad-4d3d-a48a-641931cc33bb', '24a325c4-2389-43d8-bdf1-e1c2cfecb244', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_pei', 'Inseriu os seguintes dados em relação ao novo Plano de Ação:<br><br>Objetivo Estratégico: <span class=''text-green-800''>25. Aprimorar a gestão de pessoas com foco nas competências necessárias à Presidência da República</span><br>Tipo: <span class=''text-green-800''>Ação</span><br>Unidade Responsável: <span class=''text-green-800''>DIGEC - Diretoria de Gestão Estratégica e Coordenação Estrutural</span><br>Descrição: <span class=''text-green-800''>1. Texto da Descrição</span><br>Principais entregas: <span class=''text-green-800''>Text da Principais entregas</span><br>Data de Início: <span class=''text-green-800''>01/07/2021</span><br>Data de Conclusão: <span class=''text-green-800''>31/07/2023</span><br>Status: <span class=''text-green-800''>Não iniciada</span><br>Orçamento Previsto: <span class=''text-green-800''>1.321.333,00</span><br>Servidor(a) Responsável: <span class=''text-green-800''>Kyler Fritsch</span><br>Servidor(a) Substituto: <span class=''text-green-800''>Prof. Vivien Macejkovic Jr.</span><br>', NULL, '2021-12-02 18:39:26', '2021-12-02 18:39:26');


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: public; Owner: marcio
--



--
-- Data for Name: migrations; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.migrations (id, migration, batch) VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (6, '2021_08_20_230616_create_organizacaos_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (7, '2021_09_20_230616_create_rel_organizacao_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (8, '2021_10_06_140542_create_sessions_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (9, '2021_10_20_230616_create_acoes_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (10, '2021_10_31_171917_create_tab_pei_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (11, '2021_11_01_212118_create_tab_missao_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (12, '2021_11_08_185623_create_tab_perspectiva_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (13, '2021_11_09_094804_create_tab_objetivo_estrategico_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (14, '2021_11_09_095359_create_tab_nivel_hierarquico_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (15, '2021_11_14_221355_create_tab_tipo_execucao_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (16, '2021_11_14_221613_create_tab_plano_de_acao_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (17, '2021_11_25_080128_create_tab_perfil_acesso_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (18, '2021_11_25_081914_create_rel_users_tab_organizacoes_tab_perfil_acesso_table', 1);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: marcio
--



--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: marcio
--



--
-- Data for Name: rel_organizacao; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.rel_organizacao (id, cod_organizacao, rel_cod_organizacao, deleted_at, created_at, updated_at) VALUES ('9e4bca96-8b11-4c7f-b2c3-4040e8d52d44', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', '3834910f-66f7-46d8-9104-2904d59e1241', NULL, '2021-11-24 15:21:46', '2021-11-24 15:21:46');
INSERT INTO public.rel_organizacao (id, cod_organizacao, rel_cod_organizacao, deleted_at, created_at, updated_at) VALUES ('2cdfa312-a9e0-44f9-b71c-c97092679443', '17f4ad22-8bd5-41f8-a385-49818562d736', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', NULL, '2021-11-24 15:23:08', '2021-11-24 15:23:08');
INSERT INTO public.rel_organizacao (id, cod_organizacao, rel_cod_organizacao, deleted_at, created_at, updated_at) VALUES ('41d2ff5b-29a8-4662-be3a-f7dab38321a4', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', '17f4ad22-8bd5-41f8-a385-49818562d736', NULL, '2021-11-24 15:24:04', '2021-11-24 15:24:04');


--
-- Data for Name: rel_users_tab_organizacoes_tab_perfil_acesso; Type: TABLE DATA; Schema: public; Owner: marcio
--



--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('gIkaxGd4jQTHfbf6pjd16fxjlx6NyYs5gXH92apE', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '10.216.4.66', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiT001WFFvTmNoNnhHSnFMdWZDcDdLbFJIVGIxZWhMc1hZMk1vQzFGVSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjYzOiJodHRwOi8vMTAuMjE2LjQuMTQ4L2dvdmVybmFuY2EtcHIvcHVibGljLzIwMjEvYWRtL3BsYW5vLWRlLWFjYW8iO31zOjM6ImFubyI7czo0OiIyMDIxIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiNzM2YTlhNTQtMmE1NC00MTMyLWE2M2YtN2Y5OTRmYzFjMWZkIjtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJE4xeWZ4cnJKSHhiZ1NCLzYyRXhPOWVpWnliS2lZa3VrODQ2N3NpU0tNdHNwSkQ3cW5TMzFXIjt9', 1638481192);


--
-- Data for Name: tab_organizacoes; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, deleted_at, created_at, updated_at) VALUES ('3834910f-66f7-46d8-9104-2904d59e1241', 'MDR', 'Ministério do Desenvolvimento Regional', '3834910f-66f7-46d8-9104-2904d59e1241', NULL, '2021-10-21 10:38:09', '2021-10-21 13:20:45');
INSERT INTO public.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, deleted_at, created_at, updated_at) VALUES ('aaf1cfa7-f4da-44c7-994b-141349e5d0dd', 'SE', 'Secretaria-Executiva', '3834910f-66f7-46d8-9104-2904d59e1241', NULL, '2021-11-24 15:21:46', '2021-11-24 15:21:46');
INSERT INTO public.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, deleted_at, created_at, updated_at) VALUES ('17f4ad22-8bd5-41f8-a385-49818562d736', 'SECOG', 'Secretaria de Coordenação Estrutural e Gestão Corporativa', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', NULL, '2021-11-24 15:23:08', '2021-11-24 15:23:08');
INSERT INTO public.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, deleted_at, created_at, updated_at) VALUES ('ae20f504-4452-4a7a-9cae-84a464bbc02d', 'DIGEC', 'Diretoria de Gestão Estratégica e Coordenação Estrutural', '17f4ad22-8bd5-41f8-a385-49818562d736', NULL, '2021-11-24 15:24:04', '2021-11-24 15:24:04');


--
-- Data for Name: tab_perfil_acesso; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, deleted_at, created_at, updated_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff2a', 'Super Administrador', 'Servidor(a) com todos os privilégios de administração do sistema', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');
INSERT INTO public.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, deleted_at, created_at, updated_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff3b', 'Administrador da Unidade', 'Servidor(a) com todos os privilégios de administração do sistema somente dentro da Unidade que está cadastrado', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');
INSERT INTO public.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, deleted_at, created_at, updated_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff4c', 'Gestor(a) Responsável', 'Servidor(a) que tem como responsabilidade manter a atualização do Plano de Ação ao qual está como responsável', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');
INSERT INTO public.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, deleted_at, created_at, updated_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff5d', 'Gestor(a) Substituto(a)', 'Servidor(a) que tem como responsabilidade manter a atualização do Plano de Ação ao qual está como substituto(a)', NULL, '2021-11-14 23:21:21', '2021-11-14 23:21:21');


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('736a9a54-2a54-4132-a63f-7f994fc1c1fd', NULL, 'Marcio Alessandro Xavier Neto', 'marcio.xavierneto@gmail.com', 1, '2021-12-02 11:28:47', '$2y$10$N1yfxrrJHxbgSB/62ExO9eiZybKiYkuk8467siSKMtspJD7qnS31W', 0, NULL, NULL, 'profile-photos/D4wS77M4g7tHGvttbAzuwAZkc5xEBQEOjbVargFh.jpg', '2021-11-24 15:21:20', '2021-12-02 11:28:47', NULL, NULL);
INSERT INTO public.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('336d20a8-a9fb-41ad-82b2-a002dfd0cbaf', NULL, 'Prof. Vivien Macejkovic Jr.', 'katheryn69@example.net', 1, '2021-12-01 18:57:51', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'THnDDKgqkr', NULL, NULL, '2021-12-01 18:57:51', '2021-12-01 18:57:51', NULL, NULL);
INSERT INTO public.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('61cf9640-8ec6-48ab-947f-dc6731f8d1de', NULL, 'Mr. Floyd Gerhold', 'destany43@example.com', 1, '2021-12-01 18:57:51', '$2y$10$Fli21A2jk8z60YS4qcaaROsguZyje92mZQOs87srzHoh5m1oquETS', 0, 'SlAeQTduJhJIhoCwXLD8rWAyfPS38G8f2VpjY0YUpA9KMQu2R9fnvo1R5Cvd', NULL, 'profile-photos/p3PHNNg8h4KEAzBoWo8X6UaEDo9OA8FxYsui0p6u.jpg', '2021-12-01 18:57:51', '2021-12-02 14:05:02', NULL, NULL);
INSERT INTO public.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('a5bb753b-1242-476b-b6b4-13eb57e06d58', NULL, 'Hassie Hane', 'pkilback@example.com', 1, '2021-12-01 18:57:51', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'g3h4VD09uq', NULL, NULL, '2021-12-01 18:57:51', '2021-12-01 18:57:51', NULL, NULL);
INSERT INTO public.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('b0e9a3a9-8c33-4eb6-bb55-bb4e4925d959', NULL, 'Kyler Fritsch', 'krussel@example.net', 1, '2021-12-01 18:57:51', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'rd4hPKaZql', NULL, NULL, '2021-12-01 18:57:51', '2021-12-01 18:57:51', NULL, NULL);
INSERT INTO public.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('ccf35e84-3efb-483c-93fe-889c4bb8d155', NULL, 'Mr. Freddie Stroman', 'bzulauf@example.com', 1, '2021-12-01 18:57:51', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'o7MHhYwYxm', NULL, NULL, '2021-12-01 18:57:51', '2021-12-01 18:57:51', NULL, NULL);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: marcio
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: marcio
--

SELECT pg_catalog.setval('public.migrations_id_seq', 18, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: marcio
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: tab_missao_visao_valores tab_missao_visao_valores_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_missao_visao_valores
    ADD CONSTRAINT tab_missao_visao_valores_pkey PRIMARY KEY (cod_missao_visao_valores);


--
-- Name: tab_nivel_hierarquico tab_nivel_hierarquico_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_nivel_hierarquico
    ADD CONSTRAINT tab_nivel_hierarquico_pkey PRIMARY KEY (num_nivel_hierarquico_apresentacao);


--
-- Name: tab_objetivo_estrategico tab_objetivo_estrategico_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_objetivo_estrategico
    ADD CONSTRAINT tab_objetivo_estrategico_pkey PRIMARY KEY (cod_objetivo_estrategico);


--
-- Name: tab_pei tab_pei_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_pei
    ADD CONSTRAINT tab_pei_pkey PRIMARY KEY (cod_pei);


--
-- Name: tab_perspectiva tab_perspectiva_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_perspectiva
    ADD CONSTRAINT tab_perspectiva_pkey PRIMARY KEY (cod_perspectiva);


--
-- Name: tab_plano_de_acao tab_plano_de_acao_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_plano_de_acao
    ADD CONSTRAINT tab_plano_de_acao_pkey PRIMARY KEY (cod_plano_de_acao);


--
-- Name: tab_tipo_execucao tab_tipo_execucao_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_tipo_execucao
    ADD CONSTRAINT tab_tipo_execucao_pkey PRIMARY KEY (cod_tipo_execucao);


--
-- Name: acoes acoes_pkey; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.acoes
    ADD CONSTRAINT acoes_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: rel_organizacao rel_organizacao_pkey; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.rel_organizacao
    ADD CONSTRAINT rel_organizacao_pkey PRIMARY KEY (id);


--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso rel_users_tab_organizacoes_tab_perfil_acesso_pkey; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso
    ADD CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: tab_organizacoes tab_organizacoes_pkey; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.tab_organizacoes
    ADD CONSTRAINT tab_organizacoes_pkey PRIMARY KEY (cod_organizacao);


--
-- Name: tab_perfil_acesso tab_perfil_acesso_pkey; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.tab_perfil_acesso
    ADD CONSTRAINT tab_perfil_acesso_pkey PRIMARY KEY (cod_perfil);


--
-- Name: users users_cpf_unique; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_cpf_unique UNIQUE (cpf);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: password_resets_email_index; Type: INDEX; Schema: public; Owner: marcio
--

CREATE INDEX password_resets_email_index ON public.password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: public; Owner: marcio
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON public.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: public; Owner: marcio
--

CREATE INDEX sessions_last_activity_index ON public.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: public; Owner: marcio
--

CREATE INDEX sessions_user_id_index ON public.sessions USING btree (user_id);


--
-- Name: tab_missao_visao_valores pei_tab_missao_visao_valores_cod_organizacao_foreign; Type: FK CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_missao_visao_valores
    ADD CONSTRAINT pei_tab_missao_visao_valores_cod_organizacao_foreign FOREIGN KEY (cod_organizacao) REFERENCES public.tab_organizacoes(cod_organizacao);


--
-- Name: tab_missao_visao_valores pei_tab_missao_visao_valores_cod_pei_foreign; Type: FK CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_missao_visao_valores
    ADD CONSTRAINT pei_tab_missao_visao_valores_cod_pei_foreign FOREIGN KEY (cod_pei) REFERENCES pei.tab_pei(cod_pei);


--
-- Name: tab_objetivo_estrategico pei_tab_objetivo_estrategico_cod_perspectiva_foreign; Type: FK CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_objetivo_estrategico
    ADD CONSTRAINT pei_tab_objetivo_estrategico_cod_perspectiva_foreign FOREIGN KEY (cod_perspectiva) REFERENCES pei.tab_perspectiva(cod_perspectiva);


--
-- Name: tab_perspectiva pei_tab_perspectiva_cod_pei_foreign; Type: FK CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_perspectiva
    ADD CONSTRAINT pei_tab_perspectiva_cod_pei_foreign FOREIGN KEY (cod_pei) REFERENCES pei.tab_pei(cod_pei);


--
-- Name: tab_plano_de_acao pei_tab_plano_de_acao_cod_objetivo_estrategico_foreign; Type: FK CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_plano_de_acao
    ADD CONSTRAINT pei_tab_plano_de_acao_cod_objetivo_estrategico_foreign FOREIGN KEY (cod_objetivo_estrategico) REFERENCES pei.tab_objetivo_estrategico(cod_objetivo_estrategico);


--
-- Name: tab_plano_de_acao pei_tab_plano_de_acao_cod_organizacao_foreign; Type: FK CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_plano_de_acao
    ADD CONSTRAINT pei_tab_plano_de_acao_cod_organizacao_foreign FOREIGN KEY (cod_organizacao) REFERENCES public.tab_organizacoes(cod_organizacao);


--
-- Name: tab_plano_de_acao pei_tab_plano_de_acao_cod_tipo_execucao_foreign; Type: FK CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_plano_de_acao
    ADD CONSTRAINT pei_tab_plano_de_acao_cod_tipo_execucao_foreign FOREIGN KEY (cod_tipo_execucao) REFERENCES pei.tab_tipo_execucao(cod_tipo_execucao);


--
-- Name: acoes acoes_id_user_foreign; Type: FK CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.acoes
    ADD CONSTRAINT acoes_id_user_foreign FOREIGN KEY (id_user) REFERENCES public.users(id);


--
-- Name: rel_organizacao rel_organizacao_cod_organizacao_foreign; Type: FK CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.rel_organizacao
    ADD CONSTRAINT rel_organizacao_cod_organizacao_foreign FOREIGN KEY (cod_organizacao) REFERENCES public.tab_organizacoes(cod_organizacao);


--
-- Name: rel_organizacao rel_organizacao_rel_cod_organizacao_foreign; Type: FK CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.rel_organizacao
    ADD CONSTRAINT rel_organizacao_rel_cod_organizacao_foreign FOREIGN KEY (rel_cod_organizacao) REFERENCES public.tab_organizacoes(cod_organizacao);


--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso rel_users_tab_organizacoes_tab_perfil_acesso_cod_organizacao_fo; Type: FK CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso
    ADD CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_organizacao_fo FOREIGN KEY (cod_organizacao) REFERENCES public.tab_organizacoes(cod_organizacao);


--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso rel_users_tab_organizacoes_tab_perfil_acesso_cod_perfil_foreign; Type: FK CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso
    ADD CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_perfil_foreign FOREIGN KEY (cod_perfil) REFERENCES public.tab_perfil_acesso(cod_perfil);


--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso rel_users_tab_organizacoes_tab_perfil_acesso_id_user_foreign; Type: FK CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso
    ADD CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_id_user_foreign FOREIGN KEY (id_user) REFERENCES public.users(id);


--
-- PostgreSQL database dump complete
--

