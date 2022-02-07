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

ALTER TABLE ONLY public.tab_audit DROP CONSTRAINT tab_audit_user_id_foreign;
ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_user_id_foreign;
ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_plano_de_acao_;
ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_perfil_foreign;
ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_organizacao_fo;
ALTER TABLE ONLY public.rel_organizacao DROP CONSTRAINT rel_organizacao_rel_cod_organizacao_foreign;
ALTER TABLE ONLY public.rel_organizacao DROP CONSTRAINT rel_organizacao_cod_organizacao_foreign;
ALTER TABLE ONLY public.acoes DROP CONSTRAINT acoes_user_id_foreign;
ALTER TABLE ONLY pei.tab_plano_de_acao DROP CONSTRAINT pei_tab_plano_de_acao_cod_tipo_execucao_foreign;
ALTER TABLE ONLY pei.tab_plano_de_acao DROP CONSTRAINT pei_tab_plano_de_acao_cod_organizacao_foreign;
ALTER TABLE ONLY pei.tab_plano_de_acao DROP CONSTRAINT pei_tab_plano_de_acao_cod_objetivo_estrategico_foreign;
ALTER TABLE ONLY pei.tab_perspectiva DROP CONSTRAINT pei_tab_perspectiva_cod_pei_foreign;
ALTER TABLE ONLY pei.tab_objetivo_estrategico DROP CONSTRAINT pei_tab_objetivo_estrategico_cod_perspectiva_foreign;
ALTER TABLE ONLY pei.tab_missao_visao_valores DROP CONSTRAINT pei_tab_missao_visao_valores_cod_pei_foreign;
ALTER TABLE ONLY pei.tab_missao_visao_valores DROP CONSTRAINT pei_tab_missao_visao_valores_cod_organizacao_foreign;
ALTER TABLE ONLY pei.tab_meta_por_ano DROP CONSTRAINT pei_tab_meta_por_ano_cod_indicador_foreign;
ALTER TABLE ONLY pei.tab_linha_base_indicador DROP CONSTRAINT pei_tab_linha_base_indicador_cod_indicador_foreign;
ALTER TABLE ONLY pei.tab_indicador DROP CONSTRAINT pei_tab_indicador_cod_plano_de_acao_foreign;
ALTER TABLE ONLY pei.tab_evolucao_indicador DROP CONSTRAINT pei_tab_evolucao_indicador_cod_indicador_foreign;
ALTER TABLE ONLY governanca.tab_audit DROP CONSTRAINT tab_audit_user_id_foreign;
ALTER TABLE ONLY governanca.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_user_id_foreign;
ALTER TABLE ONLY governanca.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_plano_de_acao_;
ALTER TABLE ONLY governanca.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_perfil_foreign;
ALTER TABLE ONLY governanca.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_organizacao_fo;
ALTER TABLE ONLY governanca.rel_organizacao DROP CONSTRAINT rel_organizacao_rel_cod_organizacao_foreign;
ALTER TABLE ONLY governanca.rel_organizacao DROP CONSTRAINT rel_organizacao_cod_organizacao_foreign;
ALTER TABLE ONLY governanca.acoes DROP CONSTRAINT acoes_user_id_foreign;
DROP INDEX public.sessions_user_id_index;
DROP INDEX public.sessions_last_activity_index;
DROP INDEX public.personal_access_tokens_tokenable_type_tokenable_id_index;
DROP INDEX public.password_resets_email_index;
DROP INDEX governanca.sessions_user_id_index;
DROP INDEX governanca.sessions_last_activity_index;
DROP INDEX governanca.personal_access_tokens_tokenable_type_tokenable_id_index;
DROP INDEX governanca.password_resets_email_index;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_email_unique;
ALTER TABLE ONLY public.users DROP CONSTRAINT users_cpf_unique;
ALTER TABLE ONLY public.tab_perfil_acesso DROP CONSTRAINT tab_perfil_acesso_pkey;
ALTER TABLE ONLY public.tab_organizacoes DROP CONSTRAINT tab_organizacoes_pkey;
ALTER TABLE ONLY public.tab_audit DROP CONSTRAINT tab_audit_pkey;
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
ALTER TABLE ONLY pei.tab_meta_por_ano DROP CONSTRAINT tab_meta_por_ano_pkey;
ALTER TABLE ONLY pei.tab_linha_base_indicador DROP CONSTRAINT tab_linha_base_indicador_pkey;
ALTER TABLE ONLY pei.tab_indicador DROP CONSTRAINT tab_indicador_pkey;
ALTER TABLE ONLY pei.tab_grau_satisfcao DROP CONSTRAINT tab_grau_satisfcao_pkey;
ALTER TABLE ONLY pei.tab_evolucao_indicador DROP CONSTRAINT tab_evolucao_indicador_pkey;
ALTER TABLE ONLY governanca.users DROP CONSTRAINT users_pkey;
ALTER TABLE ONLY governanca.users DROP CONSTRAINT users_email_unique;
ALTER TABLE ONLY governanca.users DROP CONSTRAINT users_cpf_unique;
ALTER TABLE ONLY governanca.tab_perfil_acesso DROP CONSTRAINT tab_perfil_acesso_pkey;
ALTER TABLE ONLY governanca.tab_organizacoes DROP CONSTRAINT tab_organizacoes_pkey;
ALTER TABLE ONLY governanca.tab_audit DROP CONSTRAINT tab_audit_pkey;
ALTER TABLE ONLY governanca.sessions DROP CONSTRAINT sessions_pkey;
ALTER TABLE ONLY governanca.rel_users_tab_organizacoes_tab_perfil_acesso DROP CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_pkey;
ALTER TABLE ONLY governanca.rel_organizacao DROP CONSTRAINT rel_organizacao_pkey;
ALTER TABLE ONLY governanca.personal_access_tokens DROP CONSTRAINT personal_access_tokens_token_unique;
ALTER TABLE ONLY governanca.personal_access_tokens DROP CONSTRAINT personal_access_tokens_pkey;
ALTER TABLE ONLY governanca.migrations DROP CONSTRAINT migrations_pkey;
ALTER TABLE ONLY governanca.failed_jobs DROP CONSTRAINT failed_jobs_uuid_unique;
ALTER TABLE ONLY governanca.failed_jobs DROP CONSTRAINT failed_jobs_pkey;
ALTER TABLE ONLY governanca.acoes DROP CONSTRAINT acoes_pkey;
ALTER TABLE public.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.migrations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE public.failed_jobs ALTER COLUMN id DROP DEFAULT;
ALTER TABLE governanca.personal_access_tokens ALTER COLUMN id DROP DEFAULT;
ALTER TABLE governanca.migrations ALTER COLUMN id DROP DEFAULT;
ALTER TABLE governanca.failed_jobs ALTER COLUMN id DROP DEFAULT;
DROP TABLE public.users;
DROP TABLE public.tab_perfil_acesso;
DROP TABLE public.tab_organizacoes;
DROP TABLE public.tab_audit;
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
DROP TABLE pei.tab_meta_por_ano;
DROP TABLE pei.tab_linha_base_indicador;
DROP TABLE pei.tab_indicador;
DROP TABLE pei.tab_grau_satisfcao;
DROP TABLE pei.tab_evolucao_indicador;
DROP TABLE governanca.users;
DROP TABLE governanca.tab_perfil_acesso;
DROP TABLE governanca.tab_organizacoes;
DROP TABLE governanca.tab_audit;
DROP TABLE governanca.sessions;
DROP TABLE governanca.rel_users_tab_organizacoes_tab_perfil_acesso;
DROP TABLE governanca.rel_organizacao;
DROP SEQUENCE governanca.personal_access_tokens_id_seq;
DROP TABLE governanca.personal_access_tokens;
DROP TABLE governanca.password_resets;
DROP SEQUENCE governanca.migrations_id_seq;
DROP TABLE governanca.migrations;
DROP SEQUENCE governanca.failed_jobs_id_seq;
DROP TABLE governanca.failed_jobs;
DROP TABLE governanca.acoes;
DROP SCHEMA pei;
DROP SCHEMA governanca;
--
-- Name: governanca; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA governanca;


ALTER SCHEMA governanca OWNER TO postgres;

--
-- Name: pei; Type: SCHEMA; Schema: -; Owner: postgres
--

CREATE SCHEMA pei;


ALTER SCHEMA pei OWNER TO postgres;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: acoes; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.acoes (
    id uuid NOT NULL,
    table_id character varying(255) NOT NULL,
    user_id uuid NOT NULL,
    "table" character varying(255) NOT NULL,
    acao text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE governanca.acoes OWNER TO marcio;

--
-- Name: failed_jobs; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.failed_jobs (
    id bigint NOT NULL,
    uuid character varying(255) NOT NULL,
    connection text NOT NULL,
    queue text NOT NULL,
    payload text NOT NULL,
    exception text NOT NULL,
    failed_at timestamp(0) without time zone DEFAULT CURRENT_TIMESTAMP NOT NULL
);


ALTER TABLE governanca.failed_jobs OWNER TO marcio;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE; Schema: governanca; Owner: marcio
--

CREATE SEQUENCE governanca.failed_jobs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE governanca.failed_jobs_id_seq OWNER TO marcio;

--
-- Name: failed_jobs_id_seq; Type: SEQUENCE OWNED BY; Schema: governanca; Owner: marcio
--

ALTER SEQUENCE governanca.failed_jobs_id_seq OWNED BY governanca.failed_jobs.id;


--
-- Name: migrations; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE governanca.migrations OWNER TO marcio;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: governanca; Owner: marcio
--

CREATE SEQUENCE governanca.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE governanca.migrations_id_seq OWNER TO marcio;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: governanca; Owner: marcio
--

ALTER SEQUENCE governanca.migrations_id_seq OWNED BY governanca.migrations.id;


--
-- Name: password_resets; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.password_resets (
    email character varying(255) NOT NULL,
    token character varying(255) NOT NULL,
    created_at timestamp(0) without time zone
);


ALTER TABLE governanca.password_resets OWNER TO marcio;

--
-- Name: personal_access_tokens; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.personal_access_tokens (
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


ALTER TABLE governanca.personal_access_tokens OWNER TO marcio;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE; Schema: governanca; Owner: marcio
--

CREATE SEQUENCE governanca.personal_access_tokens_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE governanca.personal_access_tokens_id_seq OWNER TO marcio;

--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE OWNED BY; Schema: governanca; Owner: marcio
--

ALTER SEQUENCE governanca.personal_access_tokens_id_seq OWNED BY governanca.personal_access_tokens.id;


--
-- Name: rel_organizacao; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.rel_organizacao (
    id uuid NOT NULL,
    cod_organizacao uuid NOT NULL,
    rel_cod_organizacao uuid NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE governanca.rel_organizacao OWNER TO marcio;

--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.rel_users_tab_organizacoes_tab_perfil_acesso (
    id uuid NOT NULL,
    user_id uuid NOT NULL,
    cod_organizacao uuid NOT NULL,
    cod_plano_de_acao uuid NOT NULL,
    cod_perfil uuid NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE governanca.rel_users_tab_organizacoes_tab_perfil_acesso OWNER TO marcio;

--
-- Name: sessions; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.sessions (
    id character varying(255) NOT NULL,
    user_id uuid,
    ip_address character varying(45),
    user_agent text,
    payload text NOT NULL,
    last_activity integer NOT NULL
);


ALTER TABLE governanca.sessions OWNER TO marcio;

--
-- Name: tab_audit; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.tab_audit (
    id uuid NOT NULL,
    acao character varying(255) NOT NULL,
    antes text,
    depois text,
    "table" character varying(255) NOT NULL,
    column_name character varying(255) NOT NULL,
    data_type character varying(255) NOT NULL,
    table_id character varying(255) NOT NULL,
    ip character varying(255) NOT NULL,
    user_id uuid NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE governanca.tab_audit OWNER TO marcio;

--
-- Name: tab_organizacoes; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.tab_organizacoes (
    cod_organizacao uuid NOT NULL,
    sgl_organizacao character varying(255) NOT NULL,
    nom_organizacao text NOT NULL,
    rel_cod_organizacao uuid,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE governanca.tab_organizacoes OWNER TO marcio;

--
-- Name: tab_perfil_acesso; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.tab_perfil_acesso (
    cod_perfil uuid NOT NULL,
    dsc_perfil text NOT NULL,
    dsc_permissao text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE governanca.tab_perfil_acesso OWNER TO marcio;

--
-- Name: users; Type: TABLE; Schema: governanca; Owner: marcio
--

CREATE TABLE governanca.users (
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


ALTER TABLE governanca.users OWNER TO marcio;

--
-- Name: tab_evolucao_indicador; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_evolucao_indicador (
    cod_evolucao_indicador uuid NOT NULL,
    cod_indicador uuid NOT NULL,
    num_ano smallint NOT NULL,
    num_mes smallint NOT NULL,
    vlr_previsto numeric(1000,2),
    vlr_realizado numeric(1000,2),
    txt_avaliacao text,
    bln_atualizado character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_evolucao_indicador OWNER TO marcio;

--
-- Name: tab_grau_satisfcao; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_grau_satisfcao (
    cod_grau_satisfcao uuid NOT NULL,
    dsc_grau_satisfcao text NOT NULL,
    cor character varying(255) NOT NULL,
    vlr_minimo numeric(1000,2) NOT NULL,
    vlr_maximo numeric(1000,2) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_grau_satisfcao OWNER TO marcio;

--
-- Name: tab_indicador; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_indicador (
    cod_indicador uuid NOT NULL,
    cod_plano_de_acao uuid NOT NULL,
    dsc_tipo text NOT NULL,
    dsc_indicador text NOT NULL,
    dsc_unidade_medida text NOT NULL,
    num_peso smallint,
    bln_acumulado character varying(255) NOT NULL,
    dsc_formula text,
    dsc_fonte character varying(255) NOT NULL,
    dsc_periodo_medicao character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_indicador OWNER TO marcio;

--
-- Name: tab_linha_base_indicador; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_linha_base_indicador (
    cod_linha_base uuid NOT NULL,
    cod_indicador uuid NOT NULL,
    num_linha_base numeric(1000,2) NOT NULL,
    num_ano smallint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_linha_base_indicador OWNER TO marcio;

--
-- Name: tab_meta_por_ano; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_meta_por_ano (
    cod_meta_por_ano uuid NOT NULL,
    cod_indicador uuid NOT NULL,
    num_ano smallint NOT NULL,
    meta numeric(1000,2),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_meta_por_ano OWNER TO marcio;

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
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_missao_visao_valores OWNER TO marcio;

--
-- Name: tab_nivel_hierarquico; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_nivel_hierarquico (
    num_nivel_hierarquico_apresentacao smallint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
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
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
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
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
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
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
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
    vlr_orcamento_previsto numeric(1000,2),
    bln_status character varying(255) NOT NULL,
    cod_ppa character varying(255),
    cod_loa character varying(255),
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_plano_de_acao OWNER TO marcio;

--
-- Name: tab_tipo_execucao; Type: TABLE; Schema: pei; Owner: marcio
--

CREATE TABLE pei.tab_tipo_execucao (
    cod_tipo_execucao uuid NOT NULL,
    dsc_tipo_execucao character varying(255) NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE pei.tab_tipo_execucao OWNER TO marcio;

--
-- Name: acoes; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.acoes (
    id uuid NOT NULL,
    table_id character varying(255) NOT NULL,
    user_id uuid NOT NULL,
    "table" character varying(255) NOT NULL,
    acao text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
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
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.rel_organizacao OWNER TO marcio;

--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.rel_users_tab_organizacoes_tab_perfil_acesso (
    id uuid NOT NULL,
    user_id uuid NOT NULL,
    cod_organizacao uuid NOT NULL,
    cod_plano_de_acao uuid NOT NULL,
    cod_perfil uuid NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
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
-- Name: tab_audit; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.tab_audit (
    id uuid NOT NULL,
    acao character varying(255) NOT NULL,
    antes text,
    depois text,
    "table" character varying(255) NOT NULL,
    column_name character varying(255) NOT NULL,
    data_type character varying(255) NOT NULL,
    table_id character varying(255) NOT NULL,
    ip character varying(255) NOT NULL,
    user_id uuid NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.tab_audit OWNER TO marcio;

--
-- Name: tab_organizacoes; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.tab_organizacoes (
    cod_organizacao uuid NOT NULL,
    sgl_organizacao character varying(255) NOT NULL,
    nom_organizacao text NOT NULL,
    rel_cod_organizacao uuid,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
);


ALTER TABLE public.tab_organizacoes OWNER TO marcio;

--
-- Name: tab_perfil_acesso; Type: TABLE; Schema: public; Owner: marcio
--

CREATE TABLE public.tab_perfil_acesso (
    cod_perfil uuid NOT NULL,
    dsc_perfil text NOT NULL,
    dsc_permissao text NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    deleted_at timestamp(0) without time zone
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
-- Name: failed_jobs id; Type: DEFAULT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.failed_jobs ALTER COLUMN id SET DEFAULT nextval('governanca.failed_jobs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.migrations ALTER COLUMN id SET DEFAULT nextval('governanca.migrations_id_seq'::regclass);


--
-- Name: personal_access_tokens id; Type: DEFAULT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.personal_access_tokens ALTER COLUMN id SET DEFAULT nextval('governanca.personal_access_tokens_id_seq'::regclass);


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
-- Data for Name: acoes; Type: TABLE DATA; Schema: governanca; Owner: marcio
--

INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('72eeba54-0688-4ac1-9df8-237b3857bc1d', '8c7965f3-08bf-4aa6-a020-5c9a74d794e3', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Inseriu os seguintes dados em relação ao Grau de Satisfação:<br><br>Descrição do Grau de Satisfação: <span class=''text-green-800''>Satisfatório</span><br>Cor para representar o Grau de Satisfação, conforme a framework CSS: <span class=''text-green-800''>green</span><br>Percentual mínimo aceitável: <span class=''text-green-800''>90,00</span><br>Percentual máximo aceitável: <span class=''text-green-800''>100,00</span><br>', '2022-01-26 18:23:39', '2022-01-26 18:23:39', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('4e6f5b6b-76d9-4696-a697-44453082567a', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Inseriu os seguintes dados em relação ao Grau de Satisfação:<br><br>Descrição do Grau de Satisfação: <span class=''text-green-800''>Merece atenção</span><br>Cor para representar o Grau de Satisfação: <span class=''text-green-800''>yellow</span><br>Percentual mínimo aceitável: <span class=''text-green-800''>55,00</span><br>Percentual máximo aceitável: <span class=''text-green-800''>89,99</span><br>', '2022-01-26 18:28:31', '2022-01-26 18:28:31', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('dc2572a1-0ae6-4b1d-9b0e-063aee882803', 'fc063af5-761c-49a8-ba9f-e6999b080fa8', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Inseriu os seguintes dados em relação ao Grau de Satisfação:<br><br>Descrição do Grau de Satisfação: <span class=''text-green-800''>Insatisfatório</span><br>Cor para representar o Grau de Satisfação: <span class=''text-green-800''>red</span><br>Percentual mínimo aceitável: <span class=''text-green-800''>0,00</span><br>Percentual máximo aceitável: <span class=''text-green-800''>54,99</span><br>', '2022-01-26 18:29:30', '2022-01-26 18:29:30', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('e03efd9e-e844-4826-9b3c-0de37d513d14', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellow )</span> para <span style="color:#28a745;">( yellows )</span>;<br>Alterou o(a) <b>Percentual mínimo aceitável</b> de <span style="color:#CD3333;">( 55,00 )</span> para <span style="color:#28a745;">( 5.500,00 )</span>;<br>Alterou o(a) <b>Percentual máximo aceitável</b> de <span style="color:#CD3333;">( 89,99 )</span> para <span style="color:#28a745;">( 8.999,00 )</span>;<br>', '2022-01-26 18:30:01', '2022-01-26 18:30:01', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('5762798e-0609-46fa-8ec5-1ae93e95a70b', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellows )</span> para <span style="color:#28a745;">( yellow )</span>;<br>Alterou o(a) <b>Percentual mínimo aceitável</b> de <span style="color:#CD3333;">( 5.500,00 )</span> para <span style="color:#28a745;">( 55,00 )</span>;<br>Alterou o(a) <b>Percentual máximo aceitável</b> de <span style="color:#CD3333;">( 8.999,00 )</span> para <span style="color:#28a745;">( 89,99 )</span>;<br>', '2022-01-26 18:33:06', '2022-01-26 18:33:06', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('81646e5a-b569-4bb5-9b83-8c3be93773b4', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellow )</span> para <span style="color:#28a745;">( yellows )</span>;<br>Alterou o(a) <b>Percentual mínimo aceitável</b> de <span style="color:#CD3333;">( 55,00 )</span> para <span style="color:#28a745;">( 5.500,00 )</span>;<br>Alterou o(a) <b>Percentual máximo aceitável</b> de <span style="color:#CD3333;">( 89,99 )</span> para <span style="color:#28a745;">( 8.999,00 )</span>;<br>', '2022-01-26 18:33:23', '2022-01-26 18:33:23', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('e5ae390e-248e-4fca-9d65-9e1c0ddef70b', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellows )</span> para <span style="color:#28a745;">( yellow )</span>;<br>Alterou o(a) <b>Percentual mínimo aceitável</b> de <span style="color:#CD3333;">( 5.500,00 )</span> para <span style="color:#28a745;">( 55,00 )</span>;<br>Alterou o(a) <b>Percentual máximo aceitável</b> de <span style="color:#CD3333;">( 8.999,00 )</span> para <span style="color:#28a745;">( 89,99 )</span>;<br>', '2022-01-26 18:44:45', '2022-01-26 18:44:45', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('b106a70d-f3ca-478c-badc-6022f91ea794', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellow )</span> para <span style="color:#28a745;">( yellows )</span>;<br>', '2022-01-26 18:44:54', '2022-01-26 18:44:54', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('5a9ca80d-cae1-430f-a425-d9cab6568d91', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellows )</span> para <span style="color:#28a745;">( yellow )</span>;<br>', '2022-01-26 18:45:01', '2022-01-26 18:45:01', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('28d2f744-a85c-4983-b13b-082cbd925c5e', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Inseriu os seguintes dados em relação ao novo Indicador:<br><br>Plano de Ação relacionado: <span class=''text-green-800''>1. Potencialize-se</span><br>Descrição: <strong><span class=''text-green-800''>Tempo Médio de Concessão em Dias</span></strong><br>Unidade de Medida do Indicador: <span class=''text-green-800''>Quantidade</span><br>Esse indicador terá o resultado acumulado? <span class=''text-green-800''>Não</span><br>Tipo de Análise do Indicador (Polaridade): <span class=''text-green-800''>Quanto menor for o resultado melhor</span><br>Fonte: <span class=''text-green-800''>Secretaria de Gestão Estratégica</span><br>Período de medição: <span class=''text-green-800''>Mensal</span><br>Linha de Base: <span class=''text-green-800''>2021 - 39</span><br><span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>36</strong></span> para a <strong>Meta Prevista Anual de 2020</strong></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jan/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Fev/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mar/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Abr/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mai/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jun/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jul/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Ago/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Set/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Out/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Nov/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Dez/2020 - 36</span></span><br>', '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('0bd867f4-829a-4555-8f34-c5c306f42ba2', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Inseriu os seguintes dados em relação ao novo Indicador:<br><br>Plano de Ação relacionado: <span class=''text-green-800''>1. Talento, texto alterado</span><br>Descrição: <strong><span class=''text-green-800''>Quantidade de serviços públicos acessíveis em meio digital</span></strong><br>Fórmula do Indicador: <span class=''text-green-800''>Teste</span><br>Unidade de Medida do Indicador: <span class=''text-green-800''>Quantidade</span><br>Esse indicador terá o resultado acumulado? <span class=''text-green-800''>Sim</span><br>Tipo de Análise do Indicador (Polaridade): <span class=''text-green-800''>Quanto maior for o resultado melhor</span><br>Fonte: <span class=''text-green-800''>Secretaria de Governo Digital do Ministério da Economia</span><br>Período de medição: <span class=''text-green-800''>Mensal</span><br>Linha de Base: <span class=''text-green-800''>2021 - 17</span><br><span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>33</strong></span> para a <strong>Meta Prevista Anual de 2020</strong></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mar/2020 - 3</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Abr/2020 - 9</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mai/2020 - 6</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jun/2020 - 1</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jul/2020 - 1</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Ago/2020 - 2</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Set/2020 - 3</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Out/2020 - 3</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Nov/2020 - 1</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Dez/2020 - 4</span></span><br>', '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('60806f52-8767-4881-b41f-381a3163d153', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', '<span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>39</strong></span> para a <strong>Meta Prevista Anual de 2021</strong></span><br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Janeiro/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Fevereiro/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Março/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Abril/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Maio/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Junho/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Julho/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Agosto/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Setembro/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Outubro/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Novembro/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Dezembro/2021</b>;<br>', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('a06d2e7b-c2ee-4d80-8ae7-36f51a2f71c1', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', '<span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>33</strong></span> para a <strong>Meta Prevista Anual de 2022</strong></span><br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Janeiro/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Fevereiro/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Março/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Abril/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Maio/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Junho/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Julho/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Agosto/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Setembro/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Outubro/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Novembro/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Dezembro/2022</b>;<br>', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('362391c8-d876-466c-8f35-591f05a7c16a', '96b7907c-8e39-4361-9ef2-0094b8dfe176', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Inseriu os seguintes dados em relação ao novo Plano de Ação:<br><br>Objetivo Estratégico: <span class=''text-green-800''>1. Fortalecer a capacidade institucional</span><br>Tipo: <span class=''text-green-800''>Ação</span><br>Unidade Responsável: <span class=''text-green-800''>UnidCent - Unidade Central</span><br>Descrição: <span class=''text-green-800''>1. Ação para unidade central</span><br>Principais entregas: <span class=''text-green-800''>Teste</span><br>Data de Início: <span class=''text-green-800''>01/07/2021</span><br>Data de Conclusão: <span class=''text-green-800''>29/07/2022</span><br>Status: <span class=''text-green-800''>Em andamento</span><br>Servidor(a) Responsável: <span class=''text-green-800''>Kyler Fritsch</span><br>Servidor(a) Substituto: <span class=''text-green-800''>Prof. Vivien Macejkovic Jr.</span><br>', '2022-01-29 02:15:53', '2022-01-29 02:15:53', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('b14fe0d7-dc0b-41b0-b587-dfa8c4497502', '7095d452-ea88-43db-a733-3538f9a103b9', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Inseriu os seguintes dados em relação ao novo Plano de Ação:<br><br>Objetivo Estratégico: <span class=''text-green-800''>1. Fortalecer a capacidade institucional</span><br>Tipo: <span class=''text-green-800''>Ação</span><br>Unidade Responsável: <span class=''text-green-800''>UnidCent - Unidade Central</span><br>Descrição: <span class=''text-green-800''>1. Ação para unidade central</span><br>Principais entregas: <span class=''text-green-800''>Teste</span><br>Data de Início: <span class=''text-green-800''>01/07/2021</span><br>Data de Conclusão: <span class=''text-green-800''>29/07/2022</span><br>Status: <span class=''text-green-800''>Em andamento</span><br>Servidor(a) Responsável: <span class=''text-green-800''>Kyler Fritsch</span><br>Servidor(a) Substituto: <span class=''text-green-800''>Prof. Vivien Macejkovic Jr.</span><br>', '2022-01-29 02:17:05', '2022-01-29 02:17:05', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('fd714982-ef7e-4bde-b4f8-dee6656312d7', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Inseriu os seguintes dados em relação ao novo Indicador:<br><br>Plano de Ação relacionado: <span class=''text-green-800''>1. Ação para unidade central</span><br>Descrição: <strong><span class=''text-green-800''>Teste</span></strong><br>Fórmula do Indicador: <span class=''text-green-800''>Teste</span><br>Unidade de Medida do Indicador: <span class=''text-green-800''>Quantidade</span><br>Esse indicador terá o resultado acumulado? <span class=''text-green-800''>Sim</span><br>Tipo de Análise do Indicador (Polaridade): <span class=''text-green-800''>Quanto maior for o resultado melhor</span><br>Fonte: <span class=''text-green-800''>Teste</span><br>Período de medição: <span class=''text-green-800''>Mensal</span><br>Linha de Base: <span class=''text-green-800''>2021 - 1.000</span><br><span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>900</strong></span> para a <strong>Meta Prevista Anual de 2021</strong></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jan/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Fev/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mar/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Abr/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mai/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jun/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jul/2021 - 150</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Ago/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Set/2021 - 150</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Out/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Nov/2021 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Dez/2021 - 100</span></span><br><span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>1.000</strong></span> para a <strong>Meta Prevista Anual de 2022</strong></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jan/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Fev/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mar/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Abr/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mai/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jun/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jul/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Ago/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Set/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Out/2022 - 100</span></span><br>', '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('5078b133-4a81-44d5-827b-03f87938b0a4', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Inseriu os seguintes dados em relação ao novo Indicador:<br><br>Plano de Ação relacionado: <span class=''text-green-800''>1. Ação para unidade central</span><br>Descrição: <strong><span class=''text-green-800''>Indicador 2</span></strong><br>Unidade de Medida do Indicador: <span class=''text-green-800''>Porcentagem</span><br>Esse indicador terá o resultado acumulado? <span class=''text-green-800''>Sim</span><br>Tipo de Análise do Indicador (Polaridade): <span class=''text-green-800''>Quanto maior for o resultado melhor</span><br>Fonte: <span class=''text-green-800''>Teste</span><br>Período de medição: <span class=''text-green-800''>Mensal</span><br>Linha de Base: <span class=''text-green-800''>2021 - 100,00</span><br><span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>33,00</strong></span> para a <strong>Meta Prevista Anual de 2022</strong></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jan/2022 - 10,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Fev/2022 - 10,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mar/2022 - 10,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Abr/2022 - 3,00</span></span><br>', '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('2fdd7be2-f796-4417-8aea-b1c80194658a', '7095d452-ea88-43db-a733-3538f9a103b9', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Alterou o(a) <b>Descrição do Indicador</b> de <span style="color:#CD3333;">( Teste )</span> para <span style="color:#28a745;">( Indicador A )</span>;<br>', '2022-01-31 20:39:10', '2022-01-31 20:39:10', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('5c8cd863-29bb-4bc0-adf8-c93bdf0966d6', '7095d452-ea88-43db-a733-3538f9a103b9', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Alterou o(a) <b>Descrição do Indicador</b> de <span style="color:#CD3333;">( Indicador 2 )</span> para <span style="color:#28a745;">( Indicador B )</span>;<br>', '2022-01-31 20:40:18', '2022-01-31 20:40:18', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('78e3fd22-a7ef-407f-b12e-e21c3334f93b', 'd70ef48a-1e38-4d31-b76c-87d84649fa9a', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Inseriu os seguintes dados em relação ao novo Plano de Ação:<br><br>Objetivo Estratégico: <span class=''text-green-800''>1. Fortalecer a capacidade institucional</span><br>Tipo: <span class=''text-green-800''>Projeto</span><br>Unidade Responsável: <span class=''text-green-800''>SE - Secretaria-Executiva</span><br>Descrição: <span class=''text-green-800''>2. Fomentar e fortalecer a qualidade como um dos aspectos na entrega do serviço público prestado.</span><br>Principais entregas: <span class=''text-green-800''>Indicadores de qualidade; plano de qualificação;</span><br>Data de Início: <span class=''text-green-800''>03/01/2022</span><br>Data de Conclusão: <span class=''text-green-800''>30/12/2022</span><br>Status: <span class=''text-green-800''>Em andamento</span><br>Servidor(a) Responsável: <span class=''text-green-800''>Prof. Vivien Macejkovic Jr.</span><br>Servidor(a) Substituto: <span class=''text-green-800''>Kyler Fritsch</span><br>', '2022-01-31 23:16:47', '2022-01-31 23:16:47', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('0c73bc70-1057-423e-96ee-e446cc28505e', '7095d452-ea88-43db-a733-3538f9a103b9', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Alterou o(a) <b>Servidor(a) Responsável</b> de <span style="color:#CD3333;">( Kyler Fritsch )</span> para <span style="color:#28a745;">( Marcio Alessandro Xavier Neto )</span>;<br>', '2022-02-02 15:41:55', '2022-02-02 15:41:55', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('450cd7ba-c4f7-4503-9389-1fa2d7d288d4', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Alterou o(a) <b>Servidor(a) Substituto(a)</b> de <span style="color:#CD3333;">( Mr. Freddie Stroman )</span> para <span style="color:#28a745;">( Marcio Alessandro Xavier Neto )</span>;<br>', '2022-02-02 21:37:48', '2022-02-02 21:37:48', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('0a6c26ce-5963-4a45-a576-c38792c947a4', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>75</strong></span> para <span class=''text-green-800''><strong>79</strong></span> no mês de Janeiro/2022<br /><br />Inseriu a seguinte Avaliação Qualitativa ( <span class=''text-green-800''>When a new file is selected, Livewire''s JavaScript makes an initial request to the component on the server to get a temporary "signed" upload URL.<br />
Once the url is received, JavaScript then does the actual "upload" to the signed URL, storing the upload in a temporary directory designated by Livewire and returning the new temporary file''s unique hash ID.<br />
Once the file is uploaded and the unique hash ID is generated, Livewire''s JavaScript makes a final request to the component on the server telling it to "set" the desired public property to the new temporary file.</span> ) para Janeiro/2022<br /><br />', '2022-02-02 23:47:40', '2022-02-02 23:47:40', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('daf69127-2a17-442b-95ad-ef1bd4d6f5dc', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>79</strong></span> para <span class=''text-green-800''><strong>75</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 00:11:20', '2022-02-03 00:11:20', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('a3a5075d-0d1d-4e72-9a3b-7475164904ef', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>75</strong></span> para <span class=''text-green-800''><strong>95</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 00:11:32', '2022-02-03 00:11:32', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('bceb9712-053a-4ea3-8144-2f3e61ce0d16', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>95</strong></span> para <span class=''text-green-800''><strong>75</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 00:12:00', '2022-02-03 00:12:00', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('6800b506-c793-40af-9026-aae9023a38a7', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou a Avaliação Qualitativa de <span class=''text-green-800''><strong>When a new file is selected, Livewire''s JavaScript makes an initial request to the component on the server to get a temporary "signed" upload URL.<br />
Once the url is received, JavaScript then does the actual "upload" to the signed URL, storing the upload in a temporary directory designated by Livewire and returning the new temporary file''s unique hash ID.<br />
Once the file is uploaded and the unique hash ID is generated, Livewire''s JavaScript makes a final request to the component on the server telling it to "set" the desired public property to the new temporary file.</strong></span> para <span class=''text-green-800''><strong></strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 00:30:20', '2022-02-03 00:30:20', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('674429a2-56f8-4580-b17c-398875e77fcc', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou a Avaliação Qualitativa de <span class=''text-green-800''><strong></strong></span> para <span class=''text-green-800''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 00:31:53', '2022-02-03 00:31:53', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('17aa8efb-46bb-4ef5-b739-17060d813285', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou a Avaliação Qualitativa de <span class=''text-green-800''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.</strong></span> para <span class=''text-green-800''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. teste.</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 10:18:37', '2022-02-03 10:18:37', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('1a095f2f-91d2-45bf-bc97-29dae84633ed', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou a Avaliação Qualitativa do mês de Janeiro/2022<br />De <span class=''text-green-800''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. teste.</strong></span><br />Para <span class=''text-green-800''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.</strong></span><br /><br />', '2022-02-03 10:21:18', '2022-02-03 10:21:18', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('3f19f22d-e034-4740-add7-a6b1ac0554a1', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou a Avaliação Qualitativa do mês de Janeiro/2022<br /><br />De <span class=''text-red-600''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.</strong></span><br /><br />Para <span class=''text-green-600''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. Teste.</strong></span><br /><br />', '2022-02-03 10:22:31', '2022-02-03 10:22:31', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('64ad31b5-30a9-4e01-98df-e81d7d3a8bd9', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>75</strong></span> para <span class=''text-green-800''><strong>29</strong></span> no mês de Janeiro/2022<br /><br />Alterou a Avaliação Qualitativa do mês de Janeiro/2022<br /><br />De <span class=''text-red-600''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. Teste.</strong></span><br /><br />Para <span class=''text-green-600''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.</strong></span><br /><br />', '2022-02-03 10:23:15', '2022-02-03 10:23:15', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('43927561-4ae5-4aab-b585-5082c403f536', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>29</strong></span> para <span class=''text-green-800''><strong>75</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 10:28:02', '2022-02-03 10:28:02', NULL);
INSERT INTO governanca.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('6d132e3f-a463-4b7b-8f5c-75fc10380669', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado dee <span class=''text-green-800''><strong>75</strong></span> para <span class=''text-green-800''><strong>79</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 10:30:25', '2022-02-03 10:30:25', NULL);


--
-- Data for Name: failed_jobs; Type: TABLE DATA; Schema: governanca; Owner: marcio
--



--
-- Data for Name: migrations; Type: TABLE DATA; Schema: governanca; Owner: marcio
--

INSERT INTO governanca.migrations (id, migration, batch) VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (4, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (5, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (6, '2021_08_20_230616_create_organizacaos_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (7, '2021_09_20_230616_create_rel_organizacao_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (8, '2021_10_06_140542_create_sessions_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (9, '2021_10_20_230616_create_acoes_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (10, '2021_10_31_171917_create_tab_pei_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (11, '2021_11_01_212118_create_tab_missao_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (12, '2021_11_08_185623_create_tab_perspectiva_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (13, '2021_11_09_094804_create_tab_objetivo_estrategico_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (14, '2021_11_09_095359_create_tab_nivel_hierarquico_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (15, '2021_11_14_221355_create_tab_tipo_execucao_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (16, '2021_11_14_221613_create_tab_plano_de_acao_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (17, '2021_11_25_080128_create_tab_perfil_acesso_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (18, '2021_11_25_081914_create_rel_users_tab_organizacoes_tab_perfil_acesso_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (19, '2021_12_28_232711_create_tab_indicador_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (20, '2021_12_28_234715_create_tab_evolucao_indicador_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (21, '2021_12_28_235603_create_tab_linha_base_indicador_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (22, '2022_01_03_105544_create_tab_meta_por_ano_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (23, '2022_01_18_133729_create_tab_audit_table', 1);
INSERT INTO governanca.migrations (id, migration, batch) VALUES (24, '2022_01_26_152500_create_tab_grau_satisfcao_table', 1);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: governanca; Owner: marcio
--



--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: governanca; Owner: marcio
--



--
-- Data for Name: rel_organizacao; Type: TABLE DATA; Schema: governanca; Owner: marcio
--

INSERT INTO governanca.rel_organizacao (id, cod_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('9e4bca96-8b11-4c7f-b2c3-4040e8d52d44', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', '3834910f-66f7-46d8-9104-2904d59e1241', '2021-11-24 15:21:46', '2021-11-24 15:21:46', NULL);
INSERT INTO governanca.rel_organizacao (id, cod_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('2cdfa312-a9e0-44f9-b71c-c97092679443', '17f4ad22-8bd5-41f8-a385-49818562d736', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', '2021-11-24 15:23:08', '2021-11-24 15:23:08', NULL);
INSERT INTO governanca.rel_organizacao (id, cod_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('41d2ff5b-29a8-4662-be3a-f7dab38321a4', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', '17f4ad22-8bd5-41f8-a385-49818562d736', '2021-11-24 15:24:04', '2021-11-24 15:24:04', NULL);


--
-- Data for Name: rel_users_tab_organizacoes_tab_perfil_acesso; Type: TABLE DATA; Schema: governanca; Owner: marcio
--

INSERT INTO governanca.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('41ca70a5-8af5-476d-afb3-4efa3092f409', 'b0e9a3a9-8c33-4eb6-bb55-bb4e4925d959', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', 'e147c06f-a319-4f72-ae88-a9e08b4ed66c', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2021-12-03 23:03:33', '2021-12-03 23:03:33', NULL);
INSERT INTO governanca.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('cfea2bdd-89c5-458f-b5fb-f4956f3280c0', '336d20a8-a9fb-41ad-82b2-a002dfd0cbaf', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', 'e147c06f-a319-4f72-ae88-a9e08b4ed66c', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c', '2021-12-03 23:03:33', '2021-12-03 23:03:33', NULL);
INSERT INTO governanca.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('c7bc1e1f-85ef-4457-819c-440a0dceabfb', '336d20a8-a9fb-41ad-82b2-a002dfd0cbaf', '3834910f-66f7-46d8-9104-2904d59e1241', '7095d452-ea88-43db-a733-3538f9a103b9', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-01-29 02:17:05', '2022-01-29 02:17:05', NULL);
INSERT INTO governanca.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('3877ce1e-87c1-426b-87c2-f8da4d4eb8d6', '336d20a8-a9fb-41ad-82b2-a002dfd0cbaf', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', 'd70ef48a-1e38-4d31-b76c-87d84649fa9a', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c', '2022-01-31 23:16:47', '2022-01-31 23:16:47', NULL);
INSERT INTO governanca.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('59af4d49-72d9-4392-8dd8-f38f12889ede', 'b0e9a3a9-8c33-4eb6-bb55-bb4e4925d959', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', 'd70ef48a-1e38-4d31-b76c-87d84649fa9a', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-01-31 23:16:47', '2022-01-31 23:16:47', NULL);
INSERT INTO governanca.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('0ef2759e-20ba-47d5-8f7d-cb8b91b49cbb', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '3834910f-66f7-46d8-9104-2904d59e1241', '7095d452-ea88-43db-a733-3538f9a103b9', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c', '2022-02-02 15:41:55', '2022-02-02 15:41:55', NULL);
INSERT INTO governanca.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('22ff7909-089f-4570-ae1b-91b7d59c7ae2', 'b0e9a3a9-8c33-4eb6-bb55-bb4e4925d959', '3834910f-66f7-46d8-9104-2904d59e1241', '3bbb949f-b430-44bb-bbd9-85e895d8e273', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c', '2022-01-29 02:17:05', '2022-02-02 15:41:55', NULL);
INSERT INTO governanca.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('e23cc31f-5b32-4e46-8054-a9d958c1a79d', 'ccf35e84-3efb-483c-93fe-889c4bb8d155', '17f4ad22-8bd5-41f8-a385-49818562d736', '3bbb949f-b430-44bb-bbd9-85e895d8e273', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-02-02 21:37:29', '2022-02-02 21:37:48', '2022-02-02 21:37:48');
INSERT INTO governanca.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('500bd8c7-ac56-4335-bd52-3662dba774e4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '17f4ad22-8bd5-41f8-a385-49818562d736', '3bbb949f-b430-44bb-bbd9-85e895d8e273', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-02-02 21:37:48', '2022-02-02 21:43:08', '2022-02-02 21:43:08');
INSERT INTO governanca.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('bb011802-db03-4eff-b291-119f69e5612b', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '17f4ad22-8bd5-41f8-a385-49818562d736', '3bbb949f-b430-44bb-bbd9-85e895d8e273', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-02-02 21:43:41', '2022-02-02 21:44:02', '2022-02-02 21:44:02');


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: governanca; Owner: marcio
--

INSERT INTO governanca.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('vtfGmwLsuXVw9wPL0LUSeTBMOUBEYNryBMJ6b5bP', NULL, '10.213.24.192', 'Mozilla/5.0 (Linux; Android 11; SM-A307GT) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.98 Mobile Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidHRLNUFibTFBNzFNTVRqelBXQ1AxTU5OcEIyRzhoQzRLbmdUbVc4diI7czozOiJhbm8iO3M6NDoiMjAyMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY2OiJodHRwOi8vMTAuMjE2LjQuMTQ4L2dvdmVybmFuY2EtcHIvcHVibGljLzIwMjIvcGVyc3BlY3RpdmEvN2U1OGRjM2ItMWM3Ni00ZmE1LWJmYjUtNzJkMDRmZTQwNjJjL29iamV0aXZvLWVzdHJhdGVnaWNvLzViYjZhYjI3LTQwYTYtNGFmOS1iNzQyLTA2YTY2NmE0NGZjMy9wbGFuby1kZS1hY2FvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNDoiYW5vU2VsZWNpb25hZG8iO3M6NDoiMjAyMiI7fQ==', 1643909056);
INSERT INTO governanca.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('3JeoJeCLKudDoUfQLwIX0xUjjNIzngxsilbC45Vm', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiNDFZQUtMS3l3MmlLam5IODd0THZ5S1dPVEVISEdndmNRWGNuNkdBTiI7czozOiJhbm8iO3M6NDoiMjAyMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTYzOiJodHRwOi8vMTI3LjAuMC4xL2dvdmVybmFuY2EtcHIvcHVibGljLzIwMjIvcGVyc3BlY3RpdmEvN2U1OGRjM2ItMWM3Ni00ZmE1LWJmYjUtNzJkMDRmZTQwNjJjL29iamV0aXZvLWVzdHJhdGVnaWNvLzViYjZhYjI3LTQwYTYtNGFmOS1iNzQyLTA2YTY2NmE0NGZjMy9wbGFuby1kZS1hY2FvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNToiY29kX29yZ2FuaXphY2FvIjthOjQ6e3M6MzY6IjM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MSI7czozNjoiMzgzNDkxMGYtNjZmNy00NmQ4LTkxMDQtMjkwNGQ1OWUxMjQxIjtzOjM2OiJhYWYxY2ZhNy1mNGRhLTQ0YzctOTk0Yi0xNDEzNDllNWQwZGQiO3M6MzY6ImFhZjFjZmE3LWY0ZGEtNDRjNy05OTRiLTE0MTM0OWU1ZDBkZCI7czozNjoiMTdmNGFkMjItOGJkNS00MWY4LWEzODUtNDk4MTg1NjJkNzM2IjtzOjM2OiIxN2Y0YWQyMi04YmQ1LTQxZjgtYTM4NS00OTgxODU2MmQ3MzYiO3M6MzY6ImFlMjBmNTA0LTQ0NTItNGE3YS05Y2FlLTg0YTQ2NGJiYzAyZCI7czozNjoiYWUyMGY1MDQtNDQ1Mi00YTdhLTljYWUtODRhNDY0YmJjMDJkIjt9czoxNDoiYW5vU2VsZWNpb25hZG8iO3M6NDoiMjAyMiI7fQ==', 1643910428);
INSERT INTO governanca.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('JIO2vpkrQ4HDviwBwwHSAKqzk1O7XIRnvP1hcmyc', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '10.216.4.66', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36', 'YTo4OntzOjY6Il90b2tlbiI7czo0MDoibnZFd3RRdzhid1N3UnR4cWRORDJkWkNMSGhrbVVyWk9QeVlDeUlXVCI7czozOiJhbm8iO3M6NDoiMjAyMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY2OiJodHRwOi8vMTAuMjE2LjQuMTQ4L2dvdmVybmFuY2EtcHIvcHVibGljLzIwMjIvcGVyc3BlY3RpdmEvN2U1OGRjM2ItMWM3Ni00ZmE1LWJmYjUtNzJkMDRmZTQwNjJjL29iamV0aXZvLWVzdHJhdGVnaWNvLzViYjZhYjI3LTQwYTYtNGFmOS1iNzQyLTA2YTY2NmE0NGZjMy9wbGFuby1kZS1hY2FvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6MzY6IjczNmE5YTU0LTJhNTQtNDEzMi1hNjNmLTdmOTk0ZmMxYzFmZCI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCROMXlmeHJySkh4YmdTQi82MkV4TzllaVp5YktpWWt1azg0NjdzaVNLTXRzcEpEN3FuUzMxVyI7czoxNToiY29kX29yZ2FuaXphY2FvIjthOjQ6e3M6MzY6IjM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MSI7czozNjoiMzgzNDkxMGYtNjZmNy00NmQ4LTkxMDQtMjkwNGQ1OWUxMjQxIjtzOjM2OiJhYWYxY2ZhNy1mNGRhLTQ0YzctOTk0Yi0xNDEzNDllNWQwZGQiO3M6MzY6ImFhZjFjZmE3LWY0ZGEtNDRjNy05OTRiLTE0MTM0OWU1ZDBkZCI7czozNjoiMTdmNGFkMjItOGJkNS00MWY4LWEzODUtNDk4MTg1NjJkNzM2IjtzOjM2OiIxN2Y0YWQyMi04YmQ1LTQxZjgtYTM4NS00OTgxODU2MmQ3MzYiO3M6MzY6ImFlMjBmNTA0LTQ0NTItNGE3YS05Y2FlLTg0YTQ2NGJiYzAyZCI7czozNjoiYWUyMGY1MDQtNDQ1Mi00YTdhLTljYWUtODRhNDY0YmJjMDJkIjt9czoxNDoiYW5vU2VsZWNpb25hZG8iO3M6NDoiMjAyMiI7fQ==', 1643914521);
INSERT INTO governanca.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('7uJSHwOpQflOYwv7Hwd0wZ77lVGzfZohHPro8JaV', NULL, '10.216.4.148', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiTlB2NmRGQzF1VEpzdXZhNmNtQ3FIVTBJREdKajJTWm82TjdmUDEydyI7czozOiJhbm8iO3M6NDoiMjAyMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTY2OiJodHRwOi8vMTAuMjE2LjQuMTQ4L2dvdmVybmFuY2EtcHIvcHVibGljLzIwMjIvcGVyc3BlY3RpdmEvMWM4ZDM0NDAtY2E2Ny00OWVjLWJiNDktMjI2NGIyZDUwOWE4L29iamV0aXZvLWVzdHJhdGVnaWNvLzVmNmQ3OTY3LWQzYmEtNGFiZC05YjQyLWU1OTZjZDAyOTgyMS9wbGFuby1kZS1hY2FvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNToiY29kX29yZ2FuaXphY2FvIjthOjQ6e3M6MzY6IjM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MSI7czozNjoiMzgzNDkxMGYtNjZmNy00NmQ4LTkxMDQtMjkwNGQ1OWUxMjQxIjtzOjM2OiJhYWYxY2ZhNy1mNGRhLTQ0YzctOTk0Yi0xNDEzNDllNWQwZGQiO3M6MzY6ImFhZjFjZmE3LWY0ZGEtNDRjNy05OTRiLTE0MTM0OWU1ZDBkZCI7czozNjoiMTdmNGFkMjItOGJkNS00MWY4LWEzODUtNDk4MTg1NjJkNzM2IjtzOjM2OiIxN2Y0YWQyMi04YmQ1LTQxZjgtYTM4NS00OTgxODU2MmQ3MzYiO3M6MzY6ImFlMjBmNTA0LTQ0NTItNGE3YS05Y2FlLTg0YTQ2NGJiYzAyZCI7czozNjoiYWUyMGY1MDQtNDQ1Mi00YTdhLTljYWUtODRhNDY0YmJjMDJkIjt9czoxNDoiYW5vU2VsZWNpb25hZG8iO3M6NDoiMjAyMiI7fQ==', 1643914139);


--
-- Data for Name: tab_audit; Type: TABLE DATA; Schema: governanca; Owner: marcio
--

INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c51aa7ed-f829-4797-bd22-ea984efc0f3c', 'Editou', 'yellow', 'yellows', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:01', '2022-01-26 18:30:01', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('66a633d6-f722-4b13-82cf-99d99b60b14f', 'Editou', '55.00', '5.500,00', 'tab_grau_satisfcao', 'vlr_minimo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:01', '2022-01-26 18:30:01', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c67819b5-5c64-42d2-8e75-31ea3e3c18a8', 'Editou', '89.99', '8.999,00', 'tab_grau_satisfcao', 'vlr_maximo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:01', '2022-01-26 18:30:01', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('28bc9277-39d5-4742-a904-c5f9c46bb3aa', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:54', '2022-01-26 18:30:54', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b2e66176-2d1a-465c-b100-afb720d2b6ec', 'Editou', '5500.00', '55,00', 'tab_grau_satisfcao', 'vlr_minimo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:54', '2022-01-26 18:30:54', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('9d353685-458d-4297-8e6e-2aa2d3d7b570', 'Editou', '8999.00', '89,99', 'tab_grau_satisfcao', 'vlr_maximo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:54', '2022-01-26 18:30:54', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('1c6d2a49-96b3-4526-a8b4-fc20b6e8c6bc', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:32:19', '2022-01-26 18:32:19', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('bf2bc9cf-a27a-451f-9ac1-e5cb644ec6d1', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:32:33', '2022-01-26 18:32:33', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b5e7210f-9a88-445d-9f0d-13741ab07924', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:06', '2022-01-26 18:33:06', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('0fbffac4-e63c-4928-9468-529c2cdd8c1c', 'Editou', '5500.00', '55,00', 'tab_grau_satisfcao', 'vlr_minimo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:06', '2022-01-26 18:33:06', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('68120a72-5015-4e26-aa35-61d3e1b68338', 'Editou', '8999.00', '89,99', 'tab_grau_satisfcao', 'vlr_maximo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:06', '2022-01-26 18:33:06', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('6c8e8fe3-e904-4a62-94ba-44afa523c0ca', 'Editou', 'yellow', 'yellows', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:23', '2022-01-26 18:33:23', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('a70ded86-9abc-4dfc-8aa6-1c2071116a0d', 'Editou', '55.00', '5.500,00', 'tab_grau_satisfcao', 'vlr_minimo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:23', '2022-01-26 18:33:23', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('242b44aa-6c1c-4952-95d2-0d12b74265df', 'Editou', '89.99', '8.999,00', 'tab_grau_satisfcao', 'vlr_maximo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:23', '2022-01-26 18:33:23', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('8f6b4022-a38d-45bd-b330-0406896a6797', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:44:45', '2022-01-26 18:44:45', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('03eeb112-02b6-408b-926d-a36f27c7a02a', 'Editou', '5500.00', '55,00', 'tab_grau_satisfcao', 'vlr_minimo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:44:45', '2022-01-26 18:44:45', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('d028db9e-f018-4b36-ab2b-e2016b451bfc', 'Editou', '8999.00', '89,99', 'tab_grau_satisfcao', 'vlr_maximo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:44:45', '2022-01-26 18:44:45', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('bf78aacf-b959-4060-8cd5-57919cc0a0e9', 'Editou', 'yellow', 'yellows', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:44:54', '2022-01-26 18:44:54', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('21ee757a-7560-4a0c-8de0-5d5ffced4517', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:45:01', '2022-01-26 18:45:01', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('bcbc0fdb-1fbf-4d48-be7d-ed361f3069a2', 'Editou', '', '39', 'tab_meta_por_ano', 'meta', 'numeric', '1c7ab97b-9774-49d9-ab2a-a5bcd279a1ce', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('940a0293-2f3b-4a9d-a938-5e79dc32108c', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '821021a2-5f03-48c7-8172-65aba9421ec3', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('2ad1446e-6bf8-4499-8153-ede7eb3d92c9', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', 'fa2693cc-449d-427c-8c95-e860ee5dc974', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('2926a2c4-87bf-4634-9772-65e855a55374', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', 'b3560e5a-2518-4ea0-b458-1ec8f770d8ab', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('58ddbd8e-7a0d-40a2-920d-10853b160cba', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '8685c985-e7a6-4e16-a426-7403e5ef5f76', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('70813e9c-0e2a-4606-9998-6f7419110ba7', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '5bfa1f45-a121-4462-85a9-34f203f2eb25', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('7acf4625-9d9b-4763-a849-0ae53e1f1650', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '01257081-1134-4bb8-a8b4-a64cfb896a45', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('7235e48c-6d9a-4a05-9bd7-3b6ed8f77d2e', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '3630df52-8c42-4acc-86f7-42ddb3eaedac', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('3d12dbfa-95c2-45fd-8725-99ac2c1b2011', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '398172db-7505-428f-ab16-3294c36af726', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b15bced5-bf8c-4a90-97f5-707bc46d44c8', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '9fda8be6-7fa6-4ec5-a8a7-0fadac339669', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('25b71e7c-016f-4d85-9d28-568d0b5401f1', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', 'aca1c41a-f048-43e9-b721-f810f0d7602b', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('70c037b9-5da0-4258-9657-5ec9598fa6f6', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '78bad0e3-67c7-4017-827e-6f7aefa2a169', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('2aad5a5f-bcd2-47c3-9c6d-6e17decab7e1', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '8ca8b75f-e0a6-4750-825f-d072c4d866b2', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('4f2a0f26-9473-409c-8e43-72ad1745ac1c', 'Editou', '', '33', 'tab_meta_por_ano', 'meta', 'numeric', 'bd8cc26a-fa84-4753-b068-c22e467b1f5b', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('33169289-6488-440d-acda-841983f32044', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '469f38cd-a93c-487a-9dcd-7fd2625fc0de', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('ffb25159-45df-4c01-9fd2-b5ea33d9a76f', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '72e62ce6-e53f-4a62-9ec4-58f04b47c1e2', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b4f9a42b-7579-471b-8780-40529c9cc605', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '55a3bd20-8e5a-49e3-b696-fc88223eee4b', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('461e70c9-1feb-4945-9e1f-109ee86b581b', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '7fa2dc64-47eb-4924-be30-e6094b857716', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('fffa21b1-d262-43ac-9b7e-a5574775ad1b', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '1e691fbd-0ced-4250-80d4-0ab2b5904b06', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('ad84064b-615a-4670-bbc7-2518a58b18bf', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '74e65053-1617-42c0-bfe9-7c72b3088419', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('122b24d2-9604-4766-bda2-3b39fa5b4ed5', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '401d598a-f573-4b08-9657-886b6c834ba8', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('8fcb282b-bc78-4ff7-b16a-eaaa5e82de20', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '4c868967-bedd-48c6-bd6d-5dee957c5cf8', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('92311fec-3d18-4c12-81a3-99a102512474', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '92dcd54f-8e3e-440a-965a-02b1c01caf1c', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c872bf30-eb1b-4ac0-a9fe-412a46b2aa81', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '80058c1e-2011-4a50-8c99-56361a89af48', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b78d9cc5-f7f9-4a4a-aab5-d6b38dfaac01', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '6a6b243c-651c-48b1-9607-a06fb67786e3', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('190bc974-3d02-4741-880e-f22881fc8d90', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '1b6e972f-d8e3-410d-a8e3-eb53fd69b404', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('4bcc141d-77b3-41b1-a9f5-82d529b9b972', 'Editou', 'Teste', 'Indicador A', 'tab_indicador', 'dsc_indicador', 'text', '7095d452-ea88-43db-a733-3538f9a103b9', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-31 20:39:09', '2022-01-31 20:39:09', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('a2ad40c5-d4b0-4802-853d-8462e5bdfd2c', 'Editou', 'Indicador 2', 'Indicador B', 'tab_indicador', 'dsc_indicador', 'text', '7095d452-ea88-43db-a733-3538f9a103b9', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-31 20:40:18', '2022-01-31 20:40:18', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('6360aebd-92ca-45a1-886b-d566ecf79be4', 'Editou o(a) servidor(a) responsável', 'Kyler Fritsch', 'Marcio Alessandro Xavier Neto', 'tab_plano_de_acao', 'user_id_responsavel', 'uuid', '7095d452-ea88-43db-a733-3538f9a103b9', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 15:41:55', '2022-02-02 15:41:55', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('36564a05-195d-47a6-aa00-c135fd551880', 'Editou o(a) servidor(a) responsável', '', 'Prof. Vivien Macejkovic Jr.', 'tab_plano_de_acao', 'user_id_responsavel', 'uuid', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 15:43:20', '2022-02-02 15:43:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('64a99692-200a-4086-9c4f-f3e04025c384', 'Editou o(a) servidor(a) responsável', '', 'Kyler Fritsch', 'tab_plano_de_acao', 'user_id_responsavel', 'uuid', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 15:43:56', '2022-02-02 15:43:56', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('dac9307d-0571-4196-902d-3e6c6531aa22', 'Editou o(a) servidor(a) substituo', '', 'Mr. Freddie Stroman', 'tab_plano_de_acao', 'user_id_substituto', 'uuid', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 21:21:53', '2022-02-02 21:21:53', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c98ffcc7-c6d3-4454-9d86-70f51c6074cd', 'Editou o(a) servidor(a) substituo', 'Mr. Freddie Stroman', 'Marcio Alessandro Xavier Neto', 'tab_plano_de_acao', 'user_id_substituto', 'uuid', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 21:37:48', '2022-02-02 21:37:48', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('5faa9bb3-c1ec-41ab-9e13-f252e3757262', 'Editou', '75', '79', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 23:47:40', '2022-02-02 23:47:40', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('38f9311f-ad4b-4260-9aa8-26e6c76e0698', 'Editou', '79', '', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 23:58:20', '2022-02-02 23:58:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('f8b066a6-9cf4-42ba-a9cc-3118a7effd47', 'Editou', '79', '', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:00:08', '2022-02-03 00:00:08', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('715bb483-20c8-4a57-90cf-5d04f1b5a018', 'Editou', '79', '', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:01:51', '2022-02-03 00:01:51', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('86a14a98-c7c3-4f72-9c57-a34be7fb18a1', 'Editou', '79', '75', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:11:20', '2022-02-03 00:11:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('a5ab1b58-2499-4652-984f-5390017179d8', 'Editou', '75', '95', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:11:32', '2022-02-03 00:11:32', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('5d30485a-aa0c-4004-be27-e4325efc5736', 'Editou', '95', '75', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:12:00', '2022-02-03 00:12:00', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('f2233fc7-5e9d-464d-9810-1bf8ad15ad10', 'Editou', 'When a new file is selected, Livewire''s JavaScript makes an initial request to the component on the server to get a temporary "signed" upload URL.
Once the url is received, JavaScript then does the actual "upload" to the signed URL, storing the upload in a temporary directory designated by Livewire and returning the new temporary file''s unique hash ID.
Once the file is uploaded and the unique hash ID is generated, Livewire''s JavaScript makes a final request to the component on the server telling it to "set" the desired public property to the new temporary file.', '', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:30:20', '2022-02-03 00:30:20', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c0818353-dd90-4b39-9259-ec45c08b68e0', 'Editou', '', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:31:53', '2022-02-03 00:31:53', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('3ed53b25-6ed5-42f0-a101-c275dddcf883', 'Editou', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. teste.', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:18:37', '2022-02-03 10:18:37', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('0eb968f4-64ba-4844-aabd-8cc2b3898161', 'Editou', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. teste.', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:21:18', '2022-02-03 10:21:18', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b9da9f45-72d3-4da0-be47-85e9916d41fa', 'Editou', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. Teste.', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:22:31', '2022-02-03 10:22:31', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b097891b-71aa-4917-ae57-b83fe2617ed5', 'Editou', '75', '29', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:23:15', '2022-02-03 10:23:15', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('2271cb5b-2d54-49a9-8cb3-b7f9d785cd6f', 'Editou', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. Teste.', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:23:15', '2022-02-03 10:23:15', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c2bca0e4-ee66-4408-a37c-3a92fe88e037', 'Editou', '29', '75', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:28:02', '2022-02-03 10:28:02', NULL);
INSERT INTO governanca.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('1d8f21a9-27d7-483e-9ec6-3aad07df7170', 'Editou', '75', '79', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:30:25', '2022-02-03 10:30:25', NULL);


--
-- Data for Name: tab_organizacoes; Type: TABLE DATA; Schema: governanca; Owner: marcio
--

INSERT INTO governanca.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('3834910f-66f7-46d8-9104-2904d59e1241', 'UnidCent', 'Unidade Central', '3834910f-66f7-46d8-9104-2904d59e1241', '2021-10-21 10:38:09', '2021-10-21 13:20:45', NULL);
INSERT INTO governanca.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('aaf1cfa7-f4da-44c7-994b-141349e5d0dd', 'SE', 'Secretaria-Executiva', '3834910f-66f7-46d8-9104-2904d59e1241', '2021-11-24 15:21:46', '2021-11-24 15:21:46', NULL);
INSERT INTO governanca.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('17f4ad22-8bd5-41f8-a385-49818562d736', 'SECOG', 'Secretaria de Coordenação Estrutural e Gestão Corporativa', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', '2021-11-24 15:23:08', '2021-11-24 15:23:08', NULL);
INSERT INTO governanca.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('ae20f504-4452-4a7a-9cae-84a464bbc02d', 'DIGEC', 'Diretoria de Gestão Estratégica e Coordenação Estrutural', '17f4ad22-8bd5-41f8-a385-49818562d736', '2021-11-24 15:24:04', '2021-11-24 15:24:04', NULL);


--
-- Data for Name: tab_perfil_acesso; Type: TABLE DATA; Schema: governanca; Owner: marcio
--

INSERT INTO governanca.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, created_at, updated_at, deleted_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff2a', 'Super Administrador', 'Servidor(a) com todos os privilégios de administração do sistema', '2021-11-14 23:21:21', '2021-11-14 23:21:21', NULL);
INSERT INTO governanca.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, created_at, updated_at, deleted_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff3b', 'Administrador da Unidade', 'Servidor(a) com todos os privilégios de administração do sistema somente dentro da Unidade que está cadastrado', '2021-11-14 23:21:21', '2021-11-14 23:21:21', NULL);
INSERT INTO governanca.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, created_at, updated_at, deleted_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff4c', 'Gestor(a) Responsável', 'Servidor(a) que tem como responsabilidade manter a atualização do Plano de Ação ao qual está como responsável', '2021-11-14 23:21:21', '2021-11-14 23:21:21', NULL);
INSERT INTO governanca.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, created_at, updated_at, deleted_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff5d', 'Gestor(a) Substituto(a)', 'Servidor(a) que tem como responsabilidade manter a atualização do Plano de Ação ao qual está como substituto(a)', '2021-11-14 23:21:21', '2021-11-14 23:21:21', NULL);


--
-- Data for Name: users; Type: TABLE DATA; Schema: governanca; Owner: marcio
--

INSERT INTO governanca.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('736a9a54-2a54-4132-a63f-7f994fc1c1fd', NULL, 'Marcio Alessandro Xavier Neto', 'marcio.xavierneto@gmail.com', 1, '2021-12-02 11:28:47', '$2y$10$N1yfxrrJHxbgSB/62ExO9eiZybKiYkuk8467siSKMtspJD7qnS31W', 0, NULL, NULL, 'profile-photos/D4wS77M4g7tHGvttbAzuwAZkc5xEBQEOjbVargFh.jpg', '2021-11-24 15:21:20', '2021-12-02 11:28:47', NULL, NULL);
INSERT INTO governanca.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('336d20a8-a9fb-41ad-82b2-a002dfd0cbaf', NULL, 'Prof. Vivien Macejkovic Jr.', 'katheryn69@example.net', 1, '2021-12-01 18:57:51', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'THnDDKgqkr', NULL, NULL, '2021-12-01 18:57:51', '2021-12-01 18:57:51', NULL, NULL);
INSERT INTO governanca.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('61cf9640-8ec6-48ab-947f-dc6731f8d1de', NULL, 'Mr. Floyd Gerhold', 'destany43@example.com', 1, '2021-12-01 18:57:51', '$2y$10$Fli21A2jk8z60YS4qcaaROsguZyje92mZQOs87srzHoh5m1oquETS', 0, 'SlAeQTduJhJIhoCwXLD8rWAyfPS38G8f2VpjY0YUpA9KMQu2R9fnvo1R5Cvd', NULL, 'profile-photos/p3PHNNg8h4KEAzBoWo8X6UaEDo9OA8FxYsui0p6u.jpg', '2021-12-01 18:57:51', '2021-12-02 14:05:02', NULL, NULL);
INSERT INTO governanca.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('a5bb753b-1242-476b-b6b4-13eb57e06d58', NULL, 'Hassie Hane', 'pkilback@example.com', 1, '2021-12-01 18:57:51', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'g3h4VD09uq', NULL, NULL, '2021-12-01 18:57:51', '2021-12-01 18:57:51', NULL, NULL);
INSERT INTO governanca.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('b0e9a3a9-8c33-4eb6-bb55-bb4e4925d959', NULL, 'Kyler Fritsch', 'krussel@example.net', 1, '2021-12-01 18:57:51', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'rd4hPKaZql', NULL, NULL, '2021-12-01 18:57:51', '2021-12-01 18:57:51', NULL, NULL);
INSERT INTO governanca.users (id, cpf, name, email, ativo, email_verified_at, password, trocarsenha, remember_token, current_team_id, profile_photo_path, created_at, updated_at, two_factor_secret, two_factor_recovery_codes) VALUES ('ccf35e84-3efb-483c-93fe-889c4bb8d155', NULL, 'Mr. Freddie Stroman', 'bzulauf@example.com', 1, '2021-12-01 18:57:51', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 0, 'o7MHhYwYxm', NULL, NULL, '2021-12-01 18:57:51', '2021-12-01 18:57:51', NULL, NULL);


--
-- Data for Name: tab_evolucao_indicador; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('f3407b46-bcb6-4e82-b999-eef6038aab73', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 2, 36.00, NULL, NULL, NULL, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('adb3505c-d535-48cf-b14b-f494b19bfc37', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 3, 36.00, NULL, NULL, NULL, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('5bdbba80-103a-405c-a5e1-a8ad5ee802d0', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 4, 36.00, NULL, NULL, NULL, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('d782c047-653d-45e3-bc9c-3508ef16f846', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 5, 36.00, NULL, NULL, NULL, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('d8c0d832-1e7a-4a39-8834-5f5936258867', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 6, 36.00, NULL, NULL, NULL, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('1b4be21d-3096-4b75-94db-26d37e5796d0', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 7, 36.00, NULL, NULL, NULL, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('e8727ff9-7559-4e5c-80a6-d92dc622ab9d', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 8, 36.00, NULL, NULL, NULL, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('0bd0d0d6-947c-491a-9dfa-33ef31f387c4', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 9, 36.00, NULL, NULL, NULL, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('3f92bcc9-aca8-4e60-92e0-8a53d7657f31', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 10, 36.00, NULL, NULL, NULL, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('a3d6aed9-327d-4859-9726-3029dd2f9515', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 11, 36.00, NULL, NULL, NULL, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('60cbfd06-9acd-48c8-93d7-4c0bdc7d4255', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 12, 36.00, NULL, NULL, NULL, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('fc75dafb-1ed2-4f1d-8441-74656b2b40af', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 1, NULL, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('bbb08596-1373-44c3-bf56-d21d993299bc', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 2, NULL, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('50146942-4ab9-439b-a4e4-b7383f9a4a52', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 3, 3.00, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('8bf513e8-4bee-4ad6-93cb-57507a97521b', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 4, 9.00, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('85172f94-5495-4f8b-a4cb-37d0b05b2021', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 5, 6.00, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('d4d3591a-11b0-4279-a20e-05d7fb39bb7a', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 6, 1.00, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('dca24ae5-0d8d-483b-8c3f-eb85e511f388', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 7, 1.00, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('4f79ffb8-3062-4eff-89dc-f0094ef7b53f', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 8, 2.00, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('210d96a8-8e10-4255-913a-96e06b46cdf2', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 9, 3.00, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('38311fd1-710d-4c6d-8c11-3584b7207e75', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 10, 3.00, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('2c2881e0-c47a-42de-9a7a-38d554f13bf4', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 11, 1.00, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('76a68ae2-0a31-4b0b-a010-c748b7195726', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 12, 4.00, NULL, NULL, NULL, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('821021a2-5f03-48c7-8172-65aba9421ec3', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 1, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('fa2693cc-449d-427c-8c95-e860ee5dc974', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 2, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('b3560e5a-2518-4ea0-b458-1ec8f770d8ab', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 3, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('8685c985-e7a6-4e16-a426-7403e5ef5f76', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 4, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('5bfa1f45-a121-4462-85a9-34f203f2eb25', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 5, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('01257081-1134-4bb8-a8b4-a64cfb896a45', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 6, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('3630df52-8c42-4acc-86f7-42ddb3eaedac', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 7, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('398172db-7505-428f-ab16-3294c36af726', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 8, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('9fda8be6-7fa6-4ec5-a8a7-0fadac339669', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 9, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('aca1c41a-f048-43e9-b721-f810f0d7602b', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 10, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('78bad0e3-67c7-4017-827e-6f7aefa2a169', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 11, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('8ca8b75f-e0a6-4750-825f-d072c4d866b2', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 12, 39.00, NULL, NULL, NULL, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('72e62ce6-e53f-4a62-9ec4-58f04b47c1e2', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 2, 33.00, NULL, NULL, NULL, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('55a3bd20-8e5a-49e3-b696-fc88223eee4b', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 3, 33.00, NULL, NULL, NULL, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('7fa2dc64-47eb-4924-be30-e6094b857716', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 4, 33.00, NULL, NULL, NULL, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('1e691fbd-0ced-4250-80d4-0ab2b5904b06', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 5, 33.00, NULL, NULL, NULL, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('74e65053-1617-42c0-bfe9-7c72b3088419', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 6, 33.00, NULL, NULL, NULL, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('401d598a-f573-4b08-9657-886b6c834ba8', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 7, 33.00, NULL, NULL, NULL, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('4c868967-bedd-48c6-bd6d-5dee957c5cf8', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 8, 33.00, NULL, NULL, NULL, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('92dcd54f-8e3e-440a-965a-02b1c01caf1c', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 9, 33.00, NULL, NULL, NULL, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('80058c1e-2011-4a50-8c99-56361a89af48', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 10, 33.00, NULL, NULL, NULL, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('6a6b243c-651c-48b1-9607-a06fb67786e3', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 11, 33.00, NULL, NULL, NULL, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('1b6e972f-d8e3-410d-a8e3-eb53fd69b404', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 12, 33.00, NULL, NULL, NULL, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('647f4a79-d05f-43af-9748-09fb5dd1cf3b', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 1, 50.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('7f51822e-5d66-4a44-a076-1475a1e21e12', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 2, 50.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('9fd99e9c-f5ce-4cbb-9446-35d589666926', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 4, 50.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('c6ba428d-1f0b-4ccd-aa17-703e1ca15020', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 5, 50.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('10926e44-66b4-44fd-93a8-ef151e5a1754', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 6, 50.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('8c75cbc9-f93f-4bc5-a9ae-1e4ce0908991', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 7, 150.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('ac545599-9666-4527-b706-e596eb72b352', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 8, 50.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('8da0b256-5c52-4362-82c1-fc1f4601d5af', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 9, 150.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('5ffe241d-3b47-4be4-a53a-cdbcad5586e1', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 10, 50.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('64782d6f-9f3d-4a60-a1f3-a8efc2026e51', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 11, 100.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('5d708b13-c38e-4f0b-92e2-86b766071eb4', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 12, 100.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('a6a15e2e-d033-47dd-a531-ad01d7185fe7', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 3, 100.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('4f0444af-e627-4de6-8681-54784dbca0d2', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 4, 100.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('80630586-f474-422e-99b1-acdee8846b10', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 5, 100.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('78ad28d9-f851-4b5e-a528-5d11acae56d5', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 6, 100.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('e9e0a298-2280-4953-bb88-7a7612fbf2fc', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 7, 100.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('dce8c2db-c79e-4909-8201-f52a3c32cfbf', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 8, 100.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('b56f245e-aca3-4082-8274-8186d72e088d', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 9, 100.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('2ab1ba21-4b24-4461-a24b-4981a37b3a7b', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 10, 100.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('f9dd9ea7-0030-4e79-9695-672ceed9faa5', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 11, NULL, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('121d704d-4d00-4c63-9770-5406292ebe8a', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 12, NULL, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('76acb486-e45b-41ad-847c-4f1ef5fe654a', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 2, 10.00, NULL, NULL, NULL, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('bcd8365e-4704-456b-8479-230a0feccd35', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 3, 10.00, NULL, NULL, NULL, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('3379c092-3fc6-49e6-82be-9e114c10501f', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 4, 3.00, NULL, NULL, NULL, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('53bc130d-1669-4175-8944-8827142b7765', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 5, NULL, NULL, NULL, NULL, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('71c28909-e660-48b0-9301-9f8eb8154573', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 6, NULL, NULL, NULL, NULL, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('718cccce-5bed-45de-a816-db6f65ad5fbf', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 7, NULL, NULL, NULL, NULL, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('d3151dd0-4736-41dc-8e7e-689d97fe0d79', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 8, NULL, NULL, NULL, NULL, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('0caff1b9-2560-43a7-b0df-abba76e817e7', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 9, NULL, NULL, NULL, NULL, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('2715709f-f628-4114-a6ca-336b2eb2fa53', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 1, 36.00, 33.00, NULL, '1', '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('469f38cd-a93c-487a-9dcd-7fd2625fc0de', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 1, 33.00, 3.00, NULL, '1', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('4b0a693e-d67a-4eb5-bab8-b92f4ff38ac8', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 3, 50.00, 39.00, NULL, '1', '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('addb2cce-26ab-46fd-bdaa-ef4a282fa6a8', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 10, NULL, NULL, NULL, NULL, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('601e2288-10a7-4ddf-8c1e-c5f5df454c18', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 11, NULL, NULL, NULL, NULL, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('a08dc849-60bb-4819-a578-5261f6fe9657', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 12, NULL, NULL, NULL, NULL, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('18af0d00-4316-4cad-a1d6-726da4b8ca31', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 1, 10.00, 10.00, NULL, '1', '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('fd568c85-f295-4a29-bfac-ef1565e308bb', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 2, 600000.00, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('01fb90bf-db50-4611-a457-6ca51ae1721c', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 3, 600000.00, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('f0c86157-c54c-4870-9664-af2182a43aad', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 4, 600000.00, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('ab0ecfdf-7974-4580-bf55-65d85b345ef5', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 5, 600000.00, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('85557e94-7f42-482e-9564-551da728f069', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 6, 600000.00, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('e35bac9d-209b-4fe0-919e-3b1544ea8443', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 7, 600000.00, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('b3274785-a207-41af-852a-691e3e648b2f', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 8, 600000.00, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('85f6dc33-a6f9-440a-8b10-64bd98f05ee0', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 9, 600000.00, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('b4799cb8-4217-4b32-810b-6fae023bc965', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 10, 600000.00, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('06e57f05-6e59-49d9-a2b4-5624cd0f189e', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 11, 600000.00, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('2a9bec51-1b90-40a6-aedd-eb747057a9de', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 12, NULL, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('11bad8ec-f64c-48dd-8794-996c5ccf199d', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 1, 100.00, 75.00, 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.', '1', '2022-01-30 21:59:46', '2022-02-05 00:06:01', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('1eff4bb7-917c-4de8-8ef0-190524d5f8da', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 1, 600000.00, NULL, NULL, NULL, '2022-02-04 18:41:50', '2022-02-05 01:19:39', NULL);
INSERT INTO pei.tab_evolucao_indicador (cod_evolucao_indicador, cod_indicador, num_ano, num_mes, vlr_previsto, vlr_realizado, txt_avaliacao, bln_atualizado, created_at, updated_at, deleted_at) VALUES ('23426c39-a118-4288-b603-49b9cce418d5', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 2, 100.00, NULL, NULL, NULL, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);


--
-- Data for Name: tab_grau_satisfcao; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_grau_satisfcao (cod_grau_satisfcao, dsc_grau_satisfcao, cor, vlr_minimo, vlr_maximo, created_at, updated_at, deleted_at) VALUES ('8c7965f3-08bf-4aa6-a020-5c9a74d794e3', 'Satisfatório', 'green', 90.00, 100.00, '2022-01-26 18:23:38', '2022-01-26 18:23:38', NULL);
INSERT INTO pei.tab_grau_satisfcao (cod_grau_satisfcao, dsc_grau_satisfcao, cor, vlr_minimo, vlr_maximo, created_at, updated_at, deleted_at) VALUES ('fc063af5-761c-49a8-ba9f-e6999b080fa8', 'Insatisfatório', 'red', 0.00, 54.99, '2022-01-26 18:29:30', '2022-01-26 18:29:30', NULL);
INSERT INTO pei.tab_grau_satisfcao (cod_grau_satisfcao, dsc_grau_satisfcao, cor, vlr_minimo, vlr_maximo, created_at, updated_at, deleted_at) VALUES ('54c65973-0a1a-4f56-a300-77a46ab29db4', 'Merece atenção', 'yellow', 55.00, 89.99, '2022-01-26 18:28:31', '2022-01-26 18:45:01', NULL);


--
-- Data for Name: tab_indicador; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_indicador (cod_indicador, cod_plano_de_acao, dsc_tipo, dsc_indicador, dsc_unidade_medida, num_peso, bln_acumulado, dsc_formula, dsc_fonte, dsc_periodo_medicao, created_at, updated_at, deleted_at) VALUES ('aaaaae04-31f6-492c-9c66-a554a7bb529e', 'e147c06f-a319-4f72-ae88-a9e08b4ed66c', '+', 'Quantidade de serviços públicos acessíveis em meio digital', 'Quantidade', NULL, 'Sim', 'Teste', 'Secretaria de Governo Digital do Ministério da Economia', 'Mensal', '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_indicador (cod_indicador, cod_plano_de_acao, dsc_tipo, dsc_indicador, dsc_unidade_medida, num_peso, bln_acumulado, dsc_formula, dsc_fonte, dsc_periodo_medicao, created_at, updated_at, deleted_at) VALUES ('b013818e-a2e1-473b-930e-a0a82b3dc2cf', '7095d452-ea88-43db-a733-3538f9a103b9', '+', 'Indicador A', 'Quantidade', NULL, 'Sim', 'Teste', 'Teste', 'Mensal', '2022-01-30 21:59:46', '2022-01-31 20:39:10', NULL);
INSERT INTO pei.tab_indicador (cod_indicador, cod_plano_de_acao, dsc_tipo, dsc_indicador, dsc_unidade_medida, num_peso, bln_acumulado, dsc_formula, dsc_fonte, dsc_periodo_medicao, created_at, updated_at, deleted_at) VALUES ('0350f8e6-5469-4865-bdad-cc0dbdb824d1', '7095d452-ea88-43db-a733-3538f9a103b9', '+', 'Indicador B', 'Porcentagem', NULL, 'Sim', NULL, 'Teste', 'Mensal', '2022-01-31 15:13:58', '2022-01-31 20:40:18', NULL);
INSERT INTO pei.tab_indicador (cod_indicador, cod_plano_de_acao, dsc_tipo, dsc_indicador, dsc_unidade_medida, num_peso, bln_acumulado, dsc_formula, dsc_fonte, dsc_periodo_medicao, created_at, updated_at, deleted_at) VALUES ('a942c7e0-7948-4e87-aadb-6e7cfaedc286', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '-', 'Tempo Médio de Concessão em Dias', 'Quantidade', NULL, 'Não', NULL, 'Secretaria de Gestão Estratégica', 'Mensal', '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_indicador (cod_indicador, cod_plano_de_acao, dsc_tipo, dsc_indicador, dsc_unidade_medida, num_peso, bln_acumulado, dsc_formula, dsc_fonte, dsc_periodo_medicao, created_at, updated_at, deleted_at) VALUES ('8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', '2f3ec0c7-c404-451f-b8b0-8bfa7b3dfbc4', '-', 'Indicador W', 'Dinheiro', NULL, 'Não', 'Sem fórmula', 'Sem fonte', 'Mensal', '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);


--
-- Data for Name: tab_linha_base_indicador; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_linha_base_indicador (cod_linha_base, cod_indicador, num_linha_base, num_ano, created_at, updated_at, deleted_at) VALUES ('2208e131-1b25-4001-9eed-1db44b454558', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 39.00, 2021, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_linha_base_indicador (cod_linha_base, cod_indicador, num_linha_base, num_ano, created_at, updated_at, deleted_at) VALUES ('e5aa5e0d-f1ce-4449-9188-d7ab528414f3', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 17.00, 2021, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_linha_base_indicador (cod_linha_base, cod_indicador, num_linha_base, num_ano, created_at, updated_at, deleted_at) VALUES ('56764c97-a72c-4d96-b1b1-fdded7518cf7', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 1000.00, 2021, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_linha_base_indicador (cod_linha_base, cod_indicador, num_linha_base, num_ano, created_at, updated_at, deleted_at) VALUES ('bf220586-7918-46fa-bb74-b5828cd20270', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 100.00, 2021, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_linha_base_indicador (cod_linha_base, cod_indicador, num_linha_base, num_ano, created_at, updated_at, deleted_at) VALUES ('2872a444-4ee2-40b3-95c1-88ef73e21c45', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 1000000.00, 2021, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);


--
-- Data for Name: tab_meta_por_ano; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_meta_por_ano (cod_meta_por_ano, cod_indicador, num_ano, meta, created_at, updated_at, deleted_at) VALUES ('14325c6e-6cab-469a-a2e7-21072a1a0f17', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2020, 36.00, '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO pei.tab_meta_por_ano (cod_meta_por_ano, cod_indicador, num_ano, meta, created_at, updated_at, deleted_at) VALUES ('50e81349-1c91-4a7d-9794-0806fd355e38', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', 2020, 33.00, '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO pei.tab_meta_por_ano (cod_meta_por_ano, cod_indicador, num_ano, meta, created_at, updated_at, deleted_at) VALUES ('1c7ab97b-9774-49d9-ab2a-a5bcd279a1ce', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2021, 39.00, '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO pei.tab_meta_por_ano (cod_meta_por_ano, cod_indicador, num_ano, meta, created_at, updated_at, deleted_at) VALUES ('bd8cc26a-fa84-4753-b068-c22e467b1f5b', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', 2022, 33.00, '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO pei.tab_meta_por_ano (cod_meta_por_ano, cod_indicador, num_ano, meta, created_at, updated_at, deleted_at) VALUES ('2b7d55bd-46cd-484b-a08e-d7328ddab718', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2021, 900.00, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_meta_por_ano (cod_meta_por_ano, cod_indicador, num_ano, meta, created_at, updated_at, deleted_at) VALUES ('0f2ea9dc-1293-4eff-a8c5-158948228755', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', 2022, 1000.00, '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO pei.tab_meta_por_ano (cod_meta_por_ano, cod_indicador, num_ano, meta, created_at, updated_at, deleted_at) VALUES ('d440b83f-f3a6-4ad1-8dbd-376a8e4dc5d3', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', 2022, 33.00, '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO pei.tab_meta_por_ano (cod_meta_por_ano, cod_indicador, num_ano, meta, created_at, updated_at, deleted_at) VALUES ('5a3d0ff3-4661-4b5c-b28d-9239e5e93716', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', 2022, 600000.00, '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);


--
-- Data for Name: tab_missao_visao_valores; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_missao_visao_valores (cod_missao_visao_valores, dsc_missao, dsc_visao, dsc_valores, cod_pei, cod_organizacao, created_at, updated_at, deleted_at) VALUES ('f8337876-53a2-466c-b203-082f7b56d037', 'Assistir o Ministro de Estado na condução estratégica de governo e prover o suporte para o alcance dos objetivos institucionais do Ministério.', 'Ser referência na consolidação da estratégia nacional para um Estado moderno e na gestão institucional.', 'Inovação, Proatividade, Cooperação, Foco no Resultado, Ética.', 'c64ca4bb-8f87-47e3-97b9-b3eb87b40deb', '3834910f-66f7-46d8-9104-2904d59e1241', '2021-11-24 15:28:42', '2021-11-24 15:28:42', NULL);


--
-- Data for Name: tab_nivel_hierarquico; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (1, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (2, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (3, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (4, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (5, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (6, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (7, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (8, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (9, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (10, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (11, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (12, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (13, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (14, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (15, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (16, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (17, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (18, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (19, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (20, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (21, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (22, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (23, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (24, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (25, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (26, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (27, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (28, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (29, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (30, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (31, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (32, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (33, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (34, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (35, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (36, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (37, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (38, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (39, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (40, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (41, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (42, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (43, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (44, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (45, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (46, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (47, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (48, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (49, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (50, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (51, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (52, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (53, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (54, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (55, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (56, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (57, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (58, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (59, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (60, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (61, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (62, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (63, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (64, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (65, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (66, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (67, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (68, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (69, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (70, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (71, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (72, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (73, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (74, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (75, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (76, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (77, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (78, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (79, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (80, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (81, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (82, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (83, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (84, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (85, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (86, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (87, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (88, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (89, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (90, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (91, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (92, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (93, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (94, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (95, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (96, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (97, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (98, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (99, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);
INSERT INTO pei.tab_nivel_hierarquico (num_nivel_hierarquico_apresentacao, created_at, updated_at, deleted_at) VALUES (100, '2021-11-09 09:59:21', '2021-11-09 09:59:21', NULL);


--
-- Data for Name: tab_objetivo_estrategico; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('5bb6ab27-40a6-4af9-b742-06a666a44fc3', 'Fortalecer a capacidade institucional', 1, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', '2021-11-24 15:49:32', '2021-11-24 15:49:32', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('f771e066-9e0f-4526-82d7-87bd68b92b55', 'Fortalecer as ações do Centro de Governo', 3, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', '2021-11-24 15:59:39', '2021-11-24 15:59:39', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('51bc941d-706d-4a20-a424-1830e2beb6b2', 'Aperfeiçoar a análise, articulação e monitoramento das ações governamentais', 4, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', '2021-11-24 16:00:54', '2021-11-24 16:00:54', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('a0cf9c57-1508-45d7-b4c9-60314530e061', 'Assegurar o alinhamento das políticas públicas à estratégia Nacional para a modernização do Estado', 2, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', '2021-11-24 15:58:57', '2021-11-24 16:01:04', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('892a7b22-e6a1-43ba-acf9-5f6467d63198', 'Fortalecer o Pacto Federativo', 5, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', '2021-11-24 16:01:56', '2021-11-24 16:01:56', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('05908aba-69b3-41f7-984a-b8a828b013d4', 'Fortalecer o relacionamento institucional', 6, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', '2021-11-24 16:02:41', '2021-11-24 16:02:41', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('1120f3d5-d34c-472e-af77-6cb0873d57ff', 'Comunicar ações de governo', 7, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', '2021-11-24 16:03:10', '2021-11-24 16:03:10', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('3c195b29-6522-44ce-a689-899b818ba71f', 'Alinhar as necessidades da sociedade e as políticas de governo', 8, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', '2021-11-24 16:03:58', '2021-11-24 16:03:58', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('a990b3a8-853f-40ec-ac3f-5903bbc65bcf', 'Proteção do Estado e Salvaguarda dos Interesses Nacionais', 9, '7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', '2021-11-24 16:04:52', '2021-11-24 16:04:52', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('a5235280-2d9c-43a0-a118-82d4c0c7204e', 'Assegurar a implementação da Política Nacional de Modernização do Estado', 10, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:01:00', '2021-11-25 13:01:39', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('34ee4c9e-244e-40b0-ba3b-91bbad68e348', 'Fortalecer o sistema de Governança da Presidência da República', 11, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:02:21', '2021-11-25 13:02:21', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('340bf6d5-7a56-4150-8f49-46e5932a195c', 'Assegurar a universalização do acesso aos atos oficiais e acesso à informação', 12, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:02:42', '2021-11-25 13:02:42', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('0c4bf513-0003-403b-a82b-e08a42b4380e', 'Garantir a segurança jurídica dos atos do Presidente da República', 13, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:02:58', '2021-11-25 13:02:58', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('b1afe341-f1e2-4dc2-9214-e29b4b5a8344', 'Fortalecer a promoção do voluntariado e a inclusão de pessoas em situação de vulnerabilidade', 14, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:03:21', '2021-11-25 13:03:21', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('60bc20fd-61a8-4221-af07-9b87b3e2b075', 'Integrar políticas públicas nacionais aos padrões da OCDE', 15, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:03:38', '2021-11-25 13:03:38', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('8a173bf1-3e88-4235-9825-46b768127475', 'Monitorar os programas, projetos e ações prioritárias da Presidência da República', 16, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:03:57', '2021-11-25 13:03:57', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('6e99715b-965b-4401-a8e1-c70ed1342336', 'Fortalecer a análise de mérito das propostas e posicionamentos legislativos', 17, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:04:17', '2021-11-25 13:04:17', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('7298d6e4-5dc5-46f8-b4b2-db68225c61ff', 'Fortalecer a articulação institucional e a representatividade internacional', 18, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:04:34', '2021-11-25 13:04:34', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('296d1655-334a-4e44-89f4-7c8079a4a7da', 'Aperfeiçoar a gestão dos processos, rotinas e procedimentos', 19, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:04:52', '2021-11-25 13:04:52', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('07d218d3-6a23-48cf-abce-ce2b37961eff', 'Gerar inteligência dos dados políticos do Governo Federal', 20, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:05:08', '2021-11-25 13:05:08', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('22d5475b-450b-4ef9-a6db-599c175007c3', 'Potencializar ações de assuntos estratégicos de defesa e segurança nacional', 21, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-25 13:05:30', '2021-11-25 13:05:30', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('3af137c7-d8a4-47e4-9bfd-ce0dc2b63938', 'Aperfeiçoar a gestão do conhecimento e inovação', 22, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-26 18:46:54', '2021-11-26 18:46:54', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('b0ee3b23-76aa-4969-9964-f05cab1ec6a0', 'Aperfeiçoar a gestão de inteligência do Estado', 23, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-26 18:47:13', '2021-11-26 18:47:13', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('aa0df061-c193-48af-885c-40e5c64ec414', 'Intensificar os mecanismos de proteção da PR e de outras instituições de Estado', 24, '4cf54ed4-4d02-4395-aeb2-43d5314a2301', '2021-11-26 18:47:40', '2021-11-26 18:47:40', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('5f6d7967-d3ba-4abd-9b42-e596cd029821', 'Aprimorar a gestão de pessoas com foco nas competências necessárias à Presidência da República', 25, '1c8d3440-ca67-49ec-bb49-2264b2d509a8', '2021-11-26 18:51:32', '2021-11-26 18:51:48', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('cd783c8b-6ee0-463e-afb5-25200eaf2637', 'Aperfeiçoar os serviços logísticos e a infraestrutura física da Presidência da República', 26, '1c8d3440-ca67-49ec-bb49-2264b2d509a8', '2021-11-26 18:52:07', '2021-11-26 18:52:07', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('e8cae4e5-0ad5-4acd-8d4b-8e3d20da9ed3', 'Aperfeiçoar os serviços e infraestrutura de tecnologia de informação e comunicação da Presidência da República', 27, '1c8d3440-ca67-49ec-bb49-2264b2d509a8', '2021-11-26 18:52:24', '2021-11-26 18:52:24', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('b881376a-8d57-4c02-84db-63b6e4e76576', 'Aprimorar a gestão orçamentária e financeira com foco em resultados da Presidência da República', 28, '1c8d3440-ca67-49ec-bb49-2264b2d509a8', '2021-11-26 18:52:40', '2021-11-26 18:52:40', NULL);
INSERT INTO pei.tab_objetivo_estrategico (cod_objetivo_estrategico, dsc_objetivo_estrategico, num_nivel_hierarquico_apresentacao, cod_perspectiva, created_at, updated_at, deleted_at) VALUES ('d6cd668e-333b-4a5e-9430-fc5528ebd232', 'Fortalecer os mecanismos de controle interno, comunicação e  Gestão da Presidência da República', 29, '1c8d3440-ca67-49ec-bb49-2264b2d509a8', '2021-11-26 18:52:57', '2021-11-26 18:52:57', NULL);


--
-- Data for Name: tab_pei; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_pei (cod_pei, dsc_pei, num_ano_inicio_pei, num_ano_fim_pei, created_at, updated_at, deleted_at) VALUES ('c64ca4bb-8f87-47e3-97b9-b3eb87b40deb', 'Planejamento Estratégico Integrado da Presidência da República', 2020, 2023, '2021-11-24 15:24:49', '2021-11-24 15:24:49', NULL);
INSERT INTO pei.tab_pei (cod_pei, dsc_pei, num_ano_inicio_pei, num_ano_fim_pei, created_at, updated_at, deleted_at) VALUES ('3424b284-1fcc-4dc0-8adf-adcf61f0b055', 'Planejamento Estratégico Integrado da Presidência da República', 2024, 2027, '2021-11-24 15:25:03', '2021-11-24 15:25:03', NULL);


--
-- Data for Name: tab_perspectiva; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_perspectiva (cod_perspectiva, dsc_perspectiva, num_nivel_hierarquico_apresentacao, cod_pei, created_at, updated_at, deleted_at) VALUES ('1c8d3440-ca67-49ec-bb49-2264b2d509a8', 'Suporte', 1, 'c64ca4bb-8f87-47e3-97b9-b3eb87b40deb', '2021-11-24 15:29:26', '2021-11-24 15:29:26', NULL);
INSERT INTO pei.tab_perspectiva (cod_perspectiva, dsc_perspectiva, num_nivel_hierarquico_apresentacao, cod_pei, created_at, updated_at, deleted_at) VALUES ('4cf54ed4-4d02-4395-aeb2-43d5314a2301', 'Processos Estruturantes', 2, 'c64ca4bb-8f87-47e3-97b9-b3eb87b40deb', '2021-11-24 15:30:27', '2021-11-24 15:30:27', NULL);
INSERT INTO pei.tab_perspectiva (cod_perspectiva, dsc_perspectiva, num_nivel_hierarquico_apresentacao, cod_pei, created_at, updated_at, deleted_at) VALUES ('7e58dc3b-1c76-4fa5-bfb5-72d04fe4062c', 'Resultados', 3, 'c64ca4bb-8f87-47e3-97b9-b3eb87b40deb', '2021-11-24 15:30:48', '2021-11-24 15:30:48', NULL);


--
-- Data for Name: tab_plano_de_acao; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_plano_de_acao (cod_plano_de_acao, cod_objetivo_estrategico, cod_tipo_execucao, cod_organizacao, num_nivel_hierarquico_apresentacao, dsc_plano_de_acao, txt_principais_entregas, dte_inicio, dte_fim, vlr_orcamento_previsto, bln_status, cod_ppa, cod_loa, created_at, updated_at, deleted_at) VALUES ('e147c06f-a319-4f72-ae88-a9e08b4ed66c', 'cd783c8b-6ee0-463e-afb5-25200eaf2637', 'c00b9ebc-7014-4d37-97dc-7875e55fff1b', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', 1, 'Talento, texto alterado', 'Texto das principais entregas 33 a', '2021-09-01', '2023-09-17', 3903973.21, 'Não iniciada', NULL, NULL, '2021-12-03 23:03:33', '2021-12-28 21:10:29', NULL);
INSERT INTO pei.tab_plano_de_acao (cod_plano_de_acao, cod_objetivo_estrategico, cod_tipo_execucao, cod_organizacao, num_nivel_hierarquico_apresentacao, dsc_plano_de_acao, txt_principais_entregas, dte_inicio, dte_fim, vlr_orcamento_previsto, bln_status, cod_ppa, cod_loa, created_at, updated_at, deleted_at) VALUES ('3bbb949f-b430-44bb-bbd9-85e895d8e273', '5f6d7967-d3ba-4abd-9b42-e596cd029821', '57518c30-3bc5-4305-a998-8ce8b11550ed', '17f4ad22-8bd5-41f8-a385-49818562d736', 1, 'Potencialize-se', '-', '2021-12-08', '2023-12-21', 37384.79, 'Não iniciada', NULL, NULL, '2021-12-08 18:47:33', '2021-12-28 21:12:05', NULL);
INSERT INTO pei.tab_plano_de_acao (cod_plano_de_acao, cod_objetivo_estrategico, cod_tipo_execucao, cod_organizacao, num_nivel_hierarquico_apresentacao, dsc_plano_de_acao, txt_principais_entregas, dte_inicio, dte_fim, vlr_orcamento_previsto, bln_status, cod_ppa, cod_loa, created_at, updated_at, deleted_at) VALUES ('7095d452-ea88-43db-a733-3538f9a103b9', '5bb6ab27-40a6-4af9-b742-06a666a44fc3', 'c00b9ebc-7014-4d37-97dc-7875e55fff1b', '3834910f-66f7-46d8-9104-2904d59e1241', 1, 'Ação para unidade central', 'Teste', '2021-07-01', '2022-07-29', NULL, 'Em andamento', NULL, NULL, '2022-01-29 02:17:05', '2022-01-29 02:17:05', NULL);
INSERT INTO pei.tab_plano_de_acao (cod_plano_de_acao, cod_objetivo_estrategico, cod_tipo_execucao, cod_organizacao, num_nivel_hierarquico_apresentacao, dsc_plano_de_acao, txt_principais_entregas, dte_inicio, dte_fim, vlr_orcamento_previsto, bln_status, cod_ppa, cod_loa, created_at, updated_at, deleted_at) VALUES ('d70ef48a-1e38-4d31-b76c-87d84649fa9a', '5bb6ab27-40a6-4af9-b742-06a666a44fc3', '57518c30-3bc5-4305-a998-8ce8b11550ed', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', 2, 'Fomentar e fortalecer a qualidade como um dos aspectos na entrega do serviço público prestado.', 'Indicadores de qualidade; plano de qualificação;', '2022-01-03', '2022-12-30', NULL, 'Em andamento', NULL, NULL, '2022-01-31 23:16:47', '2022-01-31 23:16:47', NULL);
INSERT INTO pei.tab_plano_de_acao (cod_plano_de_acao, cod_objetivo_estrategico, cod_tipo_execucao, cod_organizacao, num_nivel_hierarquico_apresentacao, dsc_plano_de_acao, txt_principais_entregas, dte_inicio, dte_fim, vlr_orcamento_previsto, bln_status, cod_ppa, cod_loa, created_at, updated_at, deleted_at) VALUES ('db5881ee-8a92-4bcb-bd4f-4ac788f4aeae', 'a5235280-2d9c-43a0-a118-82d4c0c7204e', 'ecef6a50-c010-4cda-afc3-cbda245b55b0', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', 1, 'Gerir o processo de planejamento', 'Relatório de Gestão anul', '2021-01-02', '2022-09-30', 234523.29, 'Em andamento', NULL, NULL, '2022-02-04 10:48:35', '2022-02-04 11:55:40', NULL);
INSERT INTO pei.tab_plano_de_acao (cod_plano_de_acao, cod_objetivo_estrategico, cod_tipo_execucao, cod_organizacao, num_nivel_hierarquico_apresentacao, dsc_plano_de_acao, txt_principais_entregas, dte_inicio, dte_fim, vlr_orcamento_previsto, bln_status, cod_ppa, cod_loa, created_at, updated_at, deleted_at) VALUES ('2f3ec0c7-c404-451f-b8b0-8bfa7b3dfbc4', '5bb6ab27-40a6-4af9-b742-06a666a44fc3', 'ecef6a50-c010-4cda-afc3-cbda245b55b0', '3834910f-66f7-46d8-9104-2904d59e1241', 3, 'Novo plano para testar vários planos num OE', 'Teste', '2022-01-03', '2022-11-30', NULL, 'Em andamento', NULL, NULL, '2022-02-04 18:37:03', '2022-02-04 18:37:03', NULL);


--
-- Data for Name: tab_tipo_execucao; Type: TABLE DATA; Schema: pei; Owner: marcio
--

INSERT INTO pei.tab_tipo_execucao (cod_tipo_execucao, dsc_tipo_execucao, created_at, updated_at, deleted_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff1b', 'Ação', '2021-11-14 23:21:21', '2021-11-14 23:21:21', NULL);
INSERT INTO pei.tab_tipo_execucao (cod_tipo_execucao, dsc_tipo_execucao, created_at, updated_at, deleted_at) VALUES ('ecef6a50-c010-4cda-afc3-cbda245b55b0', 'Iniciativa', '2021-11-14 23:21:21', '2021-11-14 23:21:21', NULL);
INSERT INTO pei.tab_tipo_execucao (cod_tipo_execucao, dsc_tipo_execucao, created_at, updated_at, deleted_at) VALUES ('57518c30-3bc5-4305-a998-8ce8b11550ed', 'Projeto', '2021-11-14 23:21:21', '2021-11-14 23:21:21', NULL);


--
-- Data for Name: acoes; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('72eeba54-0688-4ac1-9df8-237b3857bc1d', '8c7965f3-08bf-4aa6-a020-5c9a74d794e3', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Inseriu os seguintes dados em relação ao Grau de Satisfação:<br><br>Descrição do Grau de Satisfação: <span class=''text-green-800''>Satisfatório</span><br>Cor para representar o Grau de Satisfação, conforme a framework CSS: <span class=''text-green-800''>green</span><br>Percentual mínimo aceitável: <span class=''text-green-800''>90,00</span><br>Percentual máximo aceitável: <span class=''text-green-800''>100,00</span><br>', '2022-01-26 18:23:39', '2022-01-26 18:23:39', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('4e6f5b6b-76d9-4696-a697-44453082567a', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Inseriu os seguintes dados em relação ao Grau de Satisfação:<br><br>Descrição do Grau de Satisfação: <span class=''text-green-800''>Merece atenção</span><br>Cor para representar o Grau de Satisfação: <span class=''text-green-800''>yellow</span><br>Percentual mínimo aceitável: <span class=''text-green-800''>55,00</span><br>Percentual máximo aceitável: <span class=''text-green-800''>89,99</span><br>', '2022-01-26 18:28:31', '2022-01-26 18:28:31', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('dc2572a1-0ae6-4b1d-9b0e-063aee882803', 'fc063af5-761c-49a8-ba9f-e6999b080fa8', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Inseriu os seguintes dados em relação ao Grau de Satisfação:<br><br>Descrição do Grau de Satisfação: <span class=''text-green-800''>Insatisfatório</span><br>Cor para representar o Grau de Satisfação: <span class=''text-green-800''>red</span><br>Percentual mínimo aceitável: <span class=''text-green-800''>0,00</span><br>Percentual máximo aceitável: <span class=''text-green-800''>54,99</span><br>', '2022-01-26 18:29:30', '2022-01-26 18:29:30', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('e03efd9e-e844-4826-9b3c-0de37d513d14', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellow )</span> para <span style="color:#28a745;">( yellows )</span>;<br>Alterou o(a) <b>Percentual mínimo aceitável</b> de <span style="color:#CD3333;">( 55,00 )</span> para <span style="color:#28a745;">( 5.500,00 )</span>;<br>Alterou o(a) <b>Percentual máximo aceitável</b> de <span style="color:#CD3333;">( 89,99 )</span> para <span style="color:#28a745;">( 8.999,00 )</span>;<br>', '2022-01-26 18:30:01', '2022-01-26 18:30:01', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('5762798e-0609-46fa-8ec5-1ae93e95a70b', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellows )</span> para <span style="color:#28a745;">( yellow )</span>;<br>Alterou o(a) <b>Percentual mínimo aceitável</b> de <span style="color:#CD3333;">( 5.500,00 )</span> para <span style="color:#28a745;">( 55,00 )</span>;<br>Alterou o(a) <b>Percentual máximo aceitável</b> de <span style="color:#CD3333;">( 8.999,00 )</span> para <span style="color:#28a745;">( 89,99 )</span>;<br>', '2022-01-26 18:33:06', '2022-01-26 18:33:06', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('81646e5a-b569-4bb5-9b83-8c3be93773b4', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellow )</span> para <span style="color:#28a745;">( yellows )</span>;<br>Alterou o(a) <b>Percentual mínimo aceitável</b> de <span style="color:#CD3333;">( 55,00 )</span> para <span style="color:#28a745;">( 5.500,00 )</span>;<br>Alterou o(a) <b>Percentual máximo aceitável</b> de <span style="color:#CD3333;">( 89,99 )</span> para <span style="color:#28a745;">( 8.999,00 )</span>;<br>', '2022-01-26 18:33:23', '2022-01-26 18:33:23', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('e5ae390e-248e-4fca-9d65-9e1c0ddef70b', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellows )</span> para <span style="color:#28a745;">( yellow )</span>;<br>Alterou o(a) <b>Percentual mínimo aceitável</b> de <span style="color:#CD3333;">( 5.500,00 )</span> para <span style="color:#28a745;">( 55,00 )</span>;<br>Alterou o(a) <b>Percentual máximo aceitável</b> de <span style="color:#CD3333;">( 8.999,00 )</span> para <span style="color:#28a745;">( 89,99 )</span>;<br>', '2022-01-26 18:44:45', '2022-01-26 18:44:45', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('b106a70d-f3ca-478c-badc-6022f91ea794', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellow )</span> para <span style="color:#28a745;">( yellows )</span>;<br>', '2022-01-26 18:44:54', '2022-01-26 18:44:54', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('5a9ca80d-cae1-430f-a425-d9cab6568d91', '54c65973-0a1a-4f56-a300-77a46ab29db4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_grau_satisfcao', 'Alterou o(a) <b>Cor para representar o Grau de Satisfação</b> de <span style="color:#CD3333;">( yellows )</span> para <span style="color:#28a745;">( yellow )</span>;<br>', '2022-01-26 18:45:01', '2022-01-26 18:45:01', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('28d2f744-a85c-4983-b13b-082cbd925c5e', 'a942c7e0-7948-4e87-aadb-6e7cfaedc286', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Inseriu os seguintes dados em relação ao novo Indicador:<br><br>Plano de Ação relacionado: <span class=''text-green-800''>1. Potencialize-se</span><br>Descrição: <strong><span class=''text-green-800''>Tempo Médio de Concessão em Dias</span></strong><br>Unidade de Medida do Indicador: <span class=''text-green-800''>Quantidade</span><br>Esse indicador terá o resultado acumulado? <span class=''text-green-800''>Não</span><br>Tipo de Análise do Indicador (Polaridade): <span class=''text-green-800''>Quanto menor for o resultado melhor</span><br>Fonte: <span class=''text-green-800''>Secretaria de Gestão Estratégica</span><br>Período de medição: <span class=''text-green-800''>Mensal</span><br>Linha de Base: <span class=''text-green-800''>2021 - 39</span><br><span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>36</strong></span> para a <strong>Meta Prevista Anual de 2020</strong></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jan/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Fev/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mar/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Abr/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mai/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jun/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jul/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Ago/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Set/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Out/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Nov/2020 - 36</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Dez/2020 - 36</span></span><br>', '2022-01-26 19:36:15', '2022-01-26 19:36:15', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('0bd867f4-829a-4555-8f34-c5c306f42ba2', 'aaaaae04-31f6-492c-9c66-a554a7bb529e', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Inseriu os seguintes dados em relação ao novo Indicador:<br><br>Plano de Ação relacionado: <span class=''text-green-800''>1. Talento, texto alterado</span><br>Descrição: <strong><span class=''text-green-800''>Quantidade de serviços públicos acessíveis em meio digital</span></strong><br>Fórmula do Indicador: <span class=''text-green-800''>Teste</span><br>Unidade de Medida do Indicador: <span class=''text-green-800''>Quantidade</span><br>Esse indicador terá o resultado acumulado? <span class=''text-green-800''>Sim</span><br>Tipo de Análise do Indicador (Polaridade): <span class=''text-green-800''>Quanto maior for o resultado melhor</span><br>Fonte: <span class=''text-green-800''>Secretaria de Governo Digital do Ministério da Economia</span><br>Período de medição: <span class=''text-green-800''>Mensal</span><br>Linha de Base: <span class=''text-green-800''>2021 - 17</span><br><span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>33</strong></span> para a <strong>Meta Prevista Anual de 2020</strong></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mar/2020 - 3</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Abr/2020 - 9</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mai/2020 - 6</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jun/2020 - 1</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jul/2020 - 1</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Ago/2020 - 2</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Set/2020 - 3</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Out/2020 - 3</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Nov/2020 - 1</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Dez/2020 - 4</span></span><br>', '2022-01-26 19:40:28', '2022-01-26 19:40:28', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('60806f52-8767-4881-b41f-381a3163d153', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', '<span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>39</strong></span> para a <strong>Meta Prevista Anual de 2021</strong></span><br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Janeiro/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Fevereiro/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Março/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Abril/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Maio/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Junho/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Julho/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Agosto/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Setembro/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Outubro/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Novembro/2021</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 39 )</span> para o(a) <b>Meta prevista de Dezembro/2021</b>;<br>', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('a06d2e7b-c2ee-4d80-8ae7-36f51a2f71c1', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', '<span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>33</strong></span> para a <strong>Meta Prevista Anual de 2022</strong></span><br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Janeiro/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Fevereiro/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Março/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Abril/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Maio/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Junho/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Julho/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Agosto/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Setembro/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Outubro/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Novembro/2022</b>;<br>Inseriu o valor de <span style="color:#28a745;">( 33 )</span> para o(a) <b>Meta prevista de Dezembro/2022</b>;<br>', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('362391c8-d876-466c-8f35-591f05a7c16a', '96b7907c-8e39-4361-9ef2-0094b8dfe176', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Inseriu os seguintes dados em relação ao novo Plano de Ação:<br><br>Objetivo Estratégico: <span class=''text-green-800''>1. Fortalecer a capacidade institucional</span><br>Tipo: <span class=''text-green-800''>Ação</span><br>Unidade Responsável: <span class=''text-green-800''>UnidCent - Unidade Central</span><br>Descrição: <span class=''text-green-800''>1. Ação para unidade central</span><br>Principais entregas: <span class=''text-green-800''>Teste</span><br>Data de Início: <span class=''text-green-800''>01/07/2021</span><br>Data de Conclusão: <span class=''text-green-800''>29/07/2022</span><br>Status: <span class=''text-green-800''>Em andamento</span><br>Servidor(a) Responsável: <span class=''text-green-800''>Kyler Fritsch</span><br>Servidor(a) Substituto: <span class=''text-green-800''>Prof. Vivien Macejkovic Jr.</span><br>', '2022-01-29 02:15:53', '2022-01-29 02:15:53', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('b14fe0d7-dc0b-41b0-b587-dfa8c4497502', '7095d452-ea88-43db-a733-3538f9a103b9', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Inseriu os seguintes dados em relação ao novo Plano de Ação:<br><br>Objetivo Estratégico: <span class=''text-green-800''>1. Fortalecer a capacidade institucional</span><br>Tipo: <span class=''text-green-800''>Ação</span><br>Unidade Responsável: <span class=''text-green-800''>UnidCent - Unidade Central</span><br>Descrição: <span class=''text-green-800''>1. Ação para unidade central</span><br>Principais entregas: <span class=''text-green-800''>Teste</span><br>Data de Início: <span class=''text-green-800''>01/07/2021</span><br>Data de Conclusão: <span class=''text-green-800''>29/07/2022</span><br>Status: <span class=''text-green-800''>Em andamento</span><br>Servidor(a) Responsável: <span class=''text-green-800''>Kyler Fritsch</span><br>Servidor(a) Substituto: <span class=''text-green-800''>Prof. Vivien Macejkovic Jr.</span><br>', '2022-01-29 02:17:05', '2022-01-29 02:17:05', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('fd714982-ef7e-4bde-b4f8-dee6656312d7', 'b013818e-a2e1-473b-930e-a0a82b3dc2cf', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Inseriu os seguintes dados em relação ao novo Indicador:<br><br>Plano de Ação relacionado: <span class=''text-green-800''>1. Ação para unidade central</span><br>Descrição: <strong><span class=''text-green-800''>Teste</span></strong><br>Fórmula do Indicador: <span class=''text-green-800''>Teste</span><br>Unidade de Medida do Indicador: <span class=''text-green-800''>Quantidade</span><br>Esse indicador terá o resultado acumulado? <span class=''text-green-800''>Sim</span><br>Tipo de Análise do Indicador (Polaridade): <span class=''text-green-800''>Quanto maior for o resultado melhor</span><br>Fonte: <span class=''text-green-800''>Teste</span><br>Período de medição: <span class=''text-green-800''>Mensal</span><br>Linha de Base: <span class=''text-green-800''>2021 - 1.000</span><br><span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>900</strong></span> para a <strong>Meta Prevista Anual de 2021</strong></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jan/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Fev/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mar/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Abr/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mai/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jun/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jul/2021 - 150</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Ago/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Set/2021 - 150</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Out/2021 - 50</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Nov/2021 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Dez/2021 - 100</span></span><br><span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>1.000</strong></span> para a <strong>Meta Prevista Anual de 2022</strong></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jan/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Fev/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mar/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Abr/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mai/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jun/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jul/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Ago/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Set/2022 - 100</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Out/2022 - 100</span></span><br>', '2022-01-30 21:59:46', '2022-01-30 21:59:46', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('5078b133-4a81-44d5-827b-03f87938b0a4', '0350f8e6-5469-4865-bdad-cc0dbdb824d1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Inseriu os seguintes dados em relação ao novo Indicador:<br><br>Plano de Ação relacionado: <span class=''text-green-800''>1. Ação para unidade central</span><br>Descrição: <strong><span class=''text-green-800''>Indicador 2</span></strong><br>Unidade de Medida do Indicador: <span class=''text-green-800''>Porcentagem</span><br>Esse indicador terá o resultado acumulado? <span class=''text-green-800''>Sim</span><br>Tipo de Análise do Indicador (Polaridade): <span class=''text-green-800''>Quanto maior for o resultado melhor</span><br>Fonte: <span class=''text-green-800''>Teste</span><br>Período de medição: <span class=''text-green-800''>Mensal</span><br>Linha de Base: <span class=''text-green-800''>2021 - 100,00</span><br><span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>33,00</strong></span> para a <strong>Meta Prevista Anual de 2022</strong></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jan/2022 - 10,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Fev/2022 - 10,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mar/2022 - 10,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Abr/2022 - 3,00</span></span><br>', '2022-01-31 15:13:58', '2022-01-31 15:13:58', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('2fdd7be2-f796-4417-8aea-b1c80194658a', '7095d452-ea88-43db-a733-3538f9a103b9', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Alterou o(a) <b>Descrição do Indicador</b> de <span style="color:#CD3333;">( Teste )</span> para <span style="color:#28a745;">( Indicador A )</span>;<br>', '2022-01-31 20:39:10', '2022-01-31 20:39:10', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('5c8cd863-29bb-4bc0-adf8-c93bdf0966d6', '7095d452-ea88-43db-a733-3538f9a103b9', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Alterou o(a) <b>Descrição do Indicador</b> de <span style="color:#CD3333;">( Indicador 2 )</span> para <span style="color:#28a745;">( Indicador B )</span>;<br>', '2022-01-31 20:40:18', '2022-01-31 20:40:18', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('78e3fd22-a7ef-407f-b12e-e21c3334f93b', 'd70ef48a-1e38-4d31-b76c-87d84649fa9a', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Inseriu os seguintes dados em relação ao novo Plano de Ação:<br><br>Objetivo Estratégico: <span class=''text-green-800''>1. Fortalecer a capacidade institucional</span><br>Tipo: <span class=''text-green-800''>Projeto</span><br>Unidade Responsável: <span class=''text-green-800''>SE - Secretaria-Executiva</span><br>Descrição: <span class=''text-green-800''>2. Fomentar e fortalecer a qualidade como um dos aspectos na entrega do serviço público prestado.</span><br>Principais entregas: <span class=''text-green-800''>Indicadores de qualidade; plano de qualificação;</span><br>Data de Início: <span class=''text-green-800''>03/01/2022</span><br>Data de Conclusão: <span class=''text-green-800''>30/12/2022</span><br>Status: <span class=''text-green-800''>Em andamento</span><br>Servidor(a) Responsável: <span class=''text-green-800''>Prof. Vivien Macejkovic Jr.</span><br>Servidor(a) Substituto: <span class=''text-green-800''>Kyler Fritsch</span><br>', '2022-01-31 23:16:47', '2022-01-31 23:16:47', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('0c73bc70-1057-423e-96ee-e446cc28505e', '7095d452-ea88-43db-a733-3538f9a103b9', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Alterou o(a) <b>Servidor(a) Responsável</b> de <span style="color:#CD3333;">( Kyler Fritsch )</span> para <span style="color:#28a745;">( Marcio Alessandro Xavier Neto )</span>;<br>', '2022-02-02 15:41:55', '2022-02-02 15:41:55', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('450cd7ba-c4f7-4503-9389-1fa2d7d288d4', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Alterou o(a) <b>Servidor(a) Substituto(a)</b> de <span style="color:#CD3333;">( Mr. Freddie Stroman )</span> para <span style="color:#28a745;">( Marcio Alessandro Xavier Neto )</span>;<br>', '2022-02-02 21:37:48', '2022-02-02 21:37:48', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('0a6c26ce-5963-4a45-a576-c38792c947a4', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>75</strong></span> para <span class=''text-green-800''><strong>79</strong></span> no mês de Janeiro/2022<br /><br />Inseriu a seguinte Avaliação Qualitativa ( <span class=''text-green-800''>When a new file is selected, Livewire''s JavaScript makes an initial request to the component on the server to get a temporary "signed" upload URL.<br />
Once the url is received, JavaScript then does the actual "upload" to the signed URL, storing the upload in a temporary directory designated by Livewire and returning the new temporary file''s unique hash ID.<br />
Once the file is uploaded and the unique hash ID is generated, Livewire''s JavaScript makes a final request to the component on the server telling it to "set" the desired public property to the new temporary file.</span> ) para Janeiro/2022<br /><br />', '2022-02-02 23:47:40', '2022-02-02 23:47:40', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('daf69127-2a17-442b-95ad-ef1bd4d6f5dc', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>79</strong></span> para <span class=''text-green-800''><strong>75</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 00:11:20', '2022-02-03 00:11:20', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('a3a5075d-0d1d-4e72-9a3b-7475164904ef', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>75</strong></span> para <span class=''text-green-800''><strong>95</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 00:11:32', '2022-02-03 00:11:32', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('bceb9712-053a-4ea3-8144-2f3e61ce0d16', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>95</strong></span> para <span class=''text-green-800''><strong>75</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 00:12:00', '2022-02-03 00:12:00', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('6800b506-c793-40af-9026-aae9023a38a7', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou a Avaliação Qualitativa de <span class=''text-green-800''><strong>When a new file is selected, Livewire''s JavaScript makes an initial request to the component on the server to get a temporary "signed" upload URL.<br />
Once the url is received, JavaScript then does the actual "upload" to the signed URL, storing the upload in a temporary directory designated by Livewire and returning the new temporary file''s unique hash ID.<br />
Once the file is uploaded and the unique hash ID is generated, Livewire''s JavaScript makes a final request to the component on the server telling it to "set" the desired public property to the new temporary file.</strong></span> para <span class=''text-green-800''><strong></strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 00:30:20', '2022-02-03 00:30:20', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('674429a2-56f8-4580-b17c-398875e77fcc', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou a Avaliação Qualitativa de <span class=''text-green-800''><strong></strong></span> para <span class=''text-green-800''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 00:31:53', '2022-02-03 00:31:53', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('17aa8efb-46bb-4ef5-b739-17060d813285', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou a Avaliação Qualitativa de <span class=''text-green-800''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.</strong></span> para <span class=''text-green-800''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. teste.</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 10:18:37', '2022-02-03 10:18:37', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('1a095f2f-91d2-45bf-bc97-29dae84633ed', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou a Avaliação Qualitativa do mês de Janeiro/2022<br />De <span class=''text-green-800''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. teste.</strong></span><br />Para <span class=''text-green-800''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.</strong></span><br /><br />', '2022-02-03 10:21:18', '2022-02-03 10:21:18', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('3f19f22d-e034-4740-add7-a6b1ac0554a1', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou a Avaliação Qualitativa do mês de Janeiro/2022<br /><br />De <span class=''text-red-600''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.</strong></span><br /><br />Para <span class=''text-green-600''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. Teste.</strong></span><br /><br />', '2022-02-03 10:22:31', '2022-02-03 10:22:31', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('64ad31b5-30a9-4e01-98df-e81d7d3a8bd9', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>75</strong></span> para <span class=''text-green-800''><strong>29</strong></span> no mês de Janeiro/2022<br /><br />Alterou a Avaliação Qualitativa do mês de Janeiro/2022<br /><br />De <span class=''text-red-600''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. Teste.</strong></span><br /><br />Para <span class=''text-green-600''><strong>You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.</strong></span><br /><br />', '2022-02-03 10:23:15', '2022-02-03 10:23:15', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('43927561-4ae5-4aab-b585-5082c403f536', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>29</strong></span> para <span class=''text-green-800''><strong>75</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 10:28:02', '2022-02-03 10:28:02', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('6d132e3f-a463-4b7b-8f5c-75fc10380669', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado dee <span class=''text-green-800''><strong>75</strong></span> para <span class=''text-green-800''><strong>79</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-03 10:30:25', '2022-02-03 10:30:25', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('238e5082-7c8f-4568-ade8-65fa7524ea9e', 'db5881ee-8a92-4bcb-bd4f-4ac788f4aeae', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Inseriu os seguintes dados em relação ao novo Plano de Ação:<br><br>Objetivo Estratégico: <span class=''text-green-800''>10. Assegurar a implementação da Política Nacional de Modernização do Estado</span><br>Tipo: <span class=''text-green-800''>Iniciativa</span><br>Unidade Responsável: <span class=''text-green-800''>DIGEC - Diretoria de Gestão Estratégica e Coordenação Estrutural</span><br>Descrição: <span class=''text-green-800''>1. Gerir o processo de planejamento</span><br>Principais entregas: <span class=''text-green-800''>Relatório de Gestão anul</span><br>Data de Início: <span class=''text-green-800''>02/01/2022</span><br>Data de Conclusão: <span class=''text-green-800''>21/12/2022</span><br>Status: <span class=''text-green-800''>Em andamento</span><br>Orçamento Previsto: <span class=''text-green-800''>234.523,29</span><br>Servidor(a) Responsável: <span class=''text-green-800''>Marcio Alessandro Xavier Neto</span><br>Servidor(a) Substituto: <span class=''text-green-800''>Prof. Vivien Macejkovic Jr.</span><br>', '2022-02-04 10:48:35', '2022-02-04 10:48:35', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('7a470bcd-67af-41e7-b000-f12781cc1048', 'db5881ee-8a92-4bcb-bd4f-4ac788f4aeae', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Alterou o(a) <b>Data de Conclusão</b> de <span style="color:#CD3333;">( 21/12/2022 )</span> para <span style="color:#28a745;">( 30/09/2022 )</span>;<br>', '2022-02-04 11:44:27', '2022-02-04 11:44:27', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('1de9bd87-7ffd-40e7-b525-8c85e69e638c', 'db5881ee-8a92-4bcb-bd4f-4ac788f4aeae', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Alterou o(a) <b>Data de Início</b> de <span style="color:#CD3333;">( 02/01/2022 )</span> para <span style="color:#28a745;">( 02/01/2021 )</span>;<br>', '2022-02-04 11:55:40', '2022-02-04 11:55:40', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('e94f6ef0-6809-4b00-9a48-23e3dcc652bb', '2f3ec0c7-c404-451f-b8b0-8bfa7b3dfbc4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_plano_de_acao', 'Inseriu os seguintes dados em relação ao novo Plano de Ação:<br><br>Objetivo Estratégico: <span class=''text-green-800''>1. Fortalecer a capacidade institucional</span><br>Tipo: <span class=''text-green-800''>Iniciativa</span><br>Unidade Responsável: <span class=''text-green-800''>UnidCent - Unidade Central</span><br>Descrição: <span class=''text-green-800''>3. Novo plano para testar vários planos num OE</span><br>Principais entregas: <span class=''text-green-800''>Teste</span><br>Data de Início: <span class=''text-green-800''>03/01/2022</span><br>Data de Conclusão: <span class=''text-green-800''>30/11/2022</span><br>Status: <span class=''text-green-800''>Em andamento</span><br>Servidor(a) Responsável: <span class=''text-green-800''>Marcio Alessandro Xavier Neto</span><br>Servidor(a) Substituto: <span class=''text-green-800''>Kyler Fritsch</span><br>', '2022-02-04 18:37:03', '2022-02-04 18:37:03', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('8c616204-6338-4573-86cf-5099b0cd6c77', '8ca62aa5-92d1-4a5d-83b9-a03417bdbee4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_indicador', 'Inseriu os seguintes dados em relação ao novo Indicador:<br><br>Plano de Ação relacionado: <span class=''text-green-800''>3. Novo plano para testar vários planos num OE</span><br>Descrição: <strong><span class=''text-green-800''>Indicador W</span></strong><br>Fórmula do Indicador: <span class=''text-green-800''>Sem fórmula</span><br>Unidade de Medida do Indicador: <span class=''text-green-800''>Dinheiro R$ 0,00 (real)</span><br>Esse indicador terá o resultado acumulado? <span class=''text-green-800''>Não</span><br>Tipo de Análise do Indicador (Polaridade): <span class=''text-green-800''>Quanto menor for o resultado melhor</span><br>Fonte: <span class=''text-green-800''>Sem fonte</span><br>Período de medição: <span class=''text-green-800''>Mensal</span><br>Linha de Base: <span class=''text-green-800''>2021 - 1.000.000,00</span><br><span class=''mt-4 pt-4''>Inseriu o valor de <span class=''text-green-800''><strong>600.000,00</strong></span> para a <strong>Meta Prevista Anual de 2022</strong></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jan/2022 - 600.000,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Fev/2022 - 600.000,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mar/2022 - 600.000,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Abr/2022 - 600.000,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Mai/2022 - 600.000,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jun/2022 - 600.000,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Jul/2022 - 600.000,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Ago/2022 - 600.000,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Set/2022 - 600.000,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Out/2022 - 600.000,00</span></span><br><span class=''ml-3''>Meta Prevista Mensal: <span class=''text-green-800''>Nov/2022 - 600.000,00</span></span><br>', '2022-02-04 18:41:50', '2022-02-04 18:41:50', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('e5b3ace0-b5fe-47d7-baac-f5c890f1e8a0', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>79</strong></span> para <span class=''text-green-800''><strong>75</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-05 00:06:01', '2022-02-05 00:06:01', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('6948159c-ad82-4822-ba15-d670dabaf15f', '1eff4bb7-917c-4de8-8ef0-190524d5f8da', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Inseriu para Janeiro/2022 o valor realizado de <span class=''text-green-800''>1</span><br /><br />', '2022-02-05 01:06:50', '2022-02-05 01:06:50', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('b778780e-fd97-4854-9ff4-f7a9d17ce440', '1eff4bb7-917c-4de8-8ef0-190524d5f8da', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>1,00</strong></span> para <span class=''text-green-800''><strong>5.000.000,00</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-05 01:14:44', '2022-02-05 01:14:44', NULL);
INSERT INTO public.acoes (id, table_id, user_id, "table", acao, created_at, updated_at, deleted_at) VALUES ('5f4f00f5-58d0-4db5-8018-14bcfa9be484', '1eff4bb7-917c-4de8-8ef0-190524d5f8da', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'tab_evolucao_indicador', 'Alterou o valor realizado de <span class=''text-green-800''><strong>5.000.000,00</strong></span> para <span class=''text-green-800''><strong>500.000,00</strong></span> no mês de Janeiro/2022<br /><br />', '2022-02-05 01:19:39', '2022-02-05 01:19:39', NULL);


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
INSERT INTO public.migrations (id, migration, batch) VALUES (19, '2021_12_28_232711_create_tab_indicador_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (20, '2021_12_28_234715_create_tab_evolucao_indicador_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (21, '2021_12_28_235603_create_tab_linha_base_indicador_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (22, '2022_01_03_105544_create_tab_meta_por_ano_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (23, '2022_01_18_133729_create_tab_audit_table', 1);
INSERT INTO public.migrations (id, migration, batch) VALUES (24, '2022_01_26_152500_create_tab_grau_satisfcao_table', 1);


--
-- Data for Name: password_resets; Type: TABLE DATA; Schema: public; Owner: marcio
--



--
-- Data for Name: personal_access_tokens; Type: TABLE DATA; Schema: public; Owner: marcio
--



--
-- Data for Name: rel_organizacao; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.rel_organizacao (id, cod_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('9e4bca96-8b11-4c7f-b2c3-4040e8d52d44', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', '3834910f-66f7-46d8-9104-2904d59e1241', '2021-11-24 15:21:46', '2021-11-24 15:21:46', NULL);
INSERT INTO public.rel_organizacao (id, cod_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('2cdfa312-a9e0-44f9-b71c-c97092679443', '17f4ad22-8bd5-41f8-a385-49818562d736', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', '2021-11-24 15:23:08', '2021-11-24 15:23:08', NULL);
INSERT INTO public.rel_organizacao (id, cod_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('41d2ff5b-29a8-4662-be3a-f7dab38321a4', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', '17f4ad22-8bd5-41f8-a385-49818562d736', '2021-11-24 15:24:04', '2021-11-24 15:24:04', NULL);


--
-- Data for Name: rel_users_tab_organizacoes_tab_perfil_acesso; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('41ca70a5-8af5-476d-afb3-4efa3092f409', 'b0e9a3a9-8c33-4eb6-bb55-bb4e4925d959', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', 'e147c06f-a319-4f72-ae88-a9e08b4ed66c', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2021-12-03 23:03:33', '2021-12-03 23:03:33', NULL);
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('cfea2bdd-89c5-458f-b5fb-f4956f3280c0', '336d20a8-a9fb-41ad-82b2-a002dfd0cbaf', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', 'e147c06f-a319-4f72-ae88-a9e08b4ed66c', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c', '2021-12-03 23:03:33', '2021-12-03 23:03:33', NULL);
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('c7bc1e1f-85ef-4457-819c-440a0dceabfb', '336d20a8-a9fb-41ad-82b2-a002dfd0cbaf', '3834910f-66f7-46d8-9104-2904d59e1241', '7095d452-ea88-43db-a733-3538f9a103b9', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-01-29 02:17:05', '2022-01-29 02:17:05', NULL);
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('3877ce1e-87c1-426b-87c2-f8da4d4eb8d6', '336d20a8-a9fb-41ad-82b2-a002dfd0cbaf', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', 'd70ef48a-1e38-4d31-b76c-87d84649fa9a', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c', '2022-01-31 23:16:47', '2022-01-31 23:16:47', NULL);
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('59af4d49-72d9-4392-8dd8-f38f12889ede', 'b0e9a3a9-8c33-4eb6-bb55-bb4e4925d959', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', 'd70ef48a-1e38-4d31-b76c-87d84649fa9a', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-01-31 23:16:47', '2022-01-31 23:16:47', NULL);
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('0ef2759e-20ba-47d5-8f7d-cb8b91b49cbb', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '3834910f-66f7-46d8-9104-2904d59e1241', '7095d452-ea88-43db-a733-3538f9a103b9', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c', '2022-02-02 15:41:55', '2022-02-02 15:41:55', NULL);
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('22ff7909-089f-4570-ae1b-91b7d59c7ae2', 'b0e9a3a9-8c33-4eb6-bb55-bb4e4925d959', '3834910f-66f7-46d8-9104-2904d59e1241', '3bbb949f-b430-44bb-bbd9-85e895d8e273', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c', '2022-01-29 02:17:05', '2022-02-02 15:41:55', NULL);
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('e23cc31f-5b32-4e46-8054-a9d958c1a79d', 'ccf35e84-3efb-483c-93fe-889c4bb8d155', '17f4ad22-8bd5-41f8-a385-49818562d736', '3bbb949f-b430-44bb-bbd9-85e895d8e273', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-02-02 21:37:29', '2022-02-02 21:37:48', '2022-02-02 21:37:48');
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('500bd8c7-ac56-4335-bd52-3662dba774e4', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '17f4ad22-8bd5-41f8-a385-49818562d736', '3bbb949f-b430-44bb-bbd9-85e895d8e273', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-02-02 21:37:48', '2022-02-02 21:43:08', '2022-02-02 21:43:08');
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('bb011802-db03-4eff-b291-119f69e5612b', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '17f4ad22-8bd5-41f8-a385-49818562d736', '3bbb949f-b430-44bb-bbd9-85e895d8e273', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-02-02 21:43:41', '2022-02-02 21:44:02', '2022-02-02 21:44:02');
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('8155ac21-bdba-4cfa-8c96-504fd34a5a80', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', 'db5881ee-8a92-4bcb-bd4f-4ac788f4aeae', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c', '2022-02-04 10:48:35', '2022-02-04 10:48:35', NULL);
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('49624d89-d6fd-4cfb-825b-a550f505ef76', '336d20a8-a9fb-41ad-82b2-a002dfd0cbaf', 'ae20f504-4452-4a7a-9cae-84a464bbc02d', 'db5881ee-8a92-4bcb-bd4f-4ac788f4aeae', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-02-04 10:48:35', '2022-02-04 10:48:35', NULL);
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('d175c9d1-ef37-4e12-b830-c2548ff3011b', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '3834910f-66f7-46d8-9104-2904d59e1241', '2f3ec0c7-c404-451f-b8b0-8bfa7b3dfbc4', 'c00b9ebc-7014-4d37-97dc-7875e55fff4c', '2022-02-04 18:37:03', '2022-02-04 18:37:03', NULL);
INSERT INTO public.rel_users_tab_organizacoes_tab_perfil_acesso (id, user_id, cod_organizacao, cod_plano_de_acao, cod_perfil, created_at, updated_at, deleted_at) VALUES ('afc1d0d7-0c09-49a7-b0fd-7b88e048b4e6', 'b0e9a3a9-8c33-4eb6-bb55-bb4e4925d959', '3834910f-66f7-46d8-9104-2904d59e1241', '2f3ec0c7-c404-451f-b8b0-8bfa7b3dfbc4', 'c00b9ebc-7014-4d37-97dc-7875e55fff5d', '2022-02-04 18:37:03', '2022-02-04 18:37:03', NULL);


--
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('BngPfYFWHovEhKZZdqjPlzNjY4vETuqbs8Kol1MT', NULL, '10.216.4.66', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoieWk0aWFxY3BvR1pTRXZVanpaNFFleUFTWEdZbjduWjFKUzIyRDc3WSI7czozOiJhbm8iO3M6NDoiMjAyMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjExOiJodHRwOi8vMTAuMjE2LjQuMTQ4L2dvdmVybmFuY2EtcHIvcHVibGljLzIwMjIvdW5pZGFkZS8zODM0OTEwZi02NmY3LTQ2ZDgtOTEwNC0yOTA0ZDU5ZTEyNDEvcGVyc3BlY3RpdmEvN2U1OGRjM2ItMWM3Ni00ZmE1LWJmYjUtNzJkMDRmZTQwNjJjL29iamV0aXZvLWVzdHJhdGVnaWNvLzViYjZhYjI3LTQwYTYtNGFmOS1iNzQyLTA2YTY2NmE0NGZjMy9wbGFuby1kZS1hY2FvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czoxNToiY29kX29yZ2FuaXphY2FvIjthOjQ6e3M6MzY6IjM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MSI7czozNjoiMzgzNDkxMGYtNjZmNy00NmQ4LTkxMDQtMjkwNGQ1OWUxMjQxIjtzOjM2OiJhYWYxY2ZhNy1mNGRhLTQ0YzctOTk0Yi0xNDEzNDllNWQwZGQiO3M6MzY6ImFhZjFjZmE3LWY0ZGEtNDRjNy05OTRiLTE0MTM0OWU1ZDBkZCI7czozNjoiMTdmNGFkMjItOGJkNS00MWY4LWEzODUtNDk4MTg1NjJkNzM2IjtzOjM2OiIxN2Y0YWQyMi04YmQ1LTQxZjgtYTM4NS00OTgxODU2MmQ3MzYiO3M6MzY6ImFlMjBmNTA0LTQ0NTItNGE3YS05Y2FlLTg0YTQ2NGJiYzAyZCI7czozNjoiYWUyMGY1MDQtNDQ1Mi00YTdhLTljYWUtODRhNDY0YmJjMDJkIjt9czoxNDoiYW5vU2VsZWNpb25hZG8iO3M6NDoiMjAyMiI7czozMDoiY29kX3BsYW5vX2RlX2FjYW9faWRlbnRpZmljYWRvIjtzOjM2OiIyZjNlYzBjNy1jNDA0LTQ1MWYtYjhiMC04YmZhN2IzZGZiYzQiO30=', 1644014990);
INSERT INTO public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('3xNWucBOgYbPoTtqAPujKZVfOMTvxjHKs6nalnqV', NULL, '10.216.4.148', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiN29DbXBuUEJ2RlkxQXN5WHFhSVdSSmRjTHU1ZjZaRG9XbUVURm9nSSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMC4yMTYuNC4xNDgvZ292ZXJuYW5jYS1wci9wdWJsaWMvMjAyMiI7fXM6MzoiYW5vIjtzOjQ6IjIwMjIiO30=', 1643996446);
INSERT INTO public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('6R3f0undYz769UD2JbjZCtnb3qhvWDYz38WBsK9y', NULL, '192.168.15.5', 'Mozilla/5.0 (Linux; Android 11; SM-A115M) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.87 Mobile Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiazVmMWFVV3dRRnROeFd1blJ0YXc1aTJTS25TNkZPMjVTSDRhNmZSbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjEyOiJodHRwOi8vMTkyLjE2OC4xNS4xMC9nb3Zlcm5hbmNhLXByL3B1YmxpYy8yMDIyL3VuaWRhZGUvMzgzNDkxMGYtNjZmNy00NmQ4LTkxMDQtMjkwNGQ1OWUxMjQxL3BlcnNwZWN0aXZhLzdlNThkYzNiLTFjNzYtNGZhNS1iZmI1LTcyZDA0ZmU0MDYyYy9vYmpldGl2by1lc3RyYXRlZ2ljby81YmI2YWIyNy00MGE2LTRhZjktYjc0Mi0wNmE2NjZhNDRmYzMvcGxhbm8tZGUtYWNhbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoiYW5vIjtzOjQ6IjIwMjIiO3M6MTU6ImNvZF9vcmdhbml6YWNhbyI7YTo0OntzOjM2OiIzODM0OTEwZi02NmY3LTQ2ZDgtOTEwNC0yOTA0ZDU5ZTEyNDEiO3M6MzY6IjM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MSI7czozNjoiYWFmMWNmYTctZjRkYS00NGM3LTk5NGItMTQxMzQ5ZTVkMGRkIjtzOjM2OiJhYWYxY2ZhNy1mNGRhLTQ0YzctOTk0Yi0xNDEzNDllNWQwZGQiO3M6MzY6IjE3ZjRhZDIyLThiZDUtNDFmOC1hMzg1LTQ5ODE4NTYyZDczNiI7czozNjoiMTdmNGFkMjItOGJkNS00MWY4LWEzODUtNDk4MTg1NjJkNzM2IjtzOjM2OiJhZTIwZjUwNC00NDUyLTRhN2EtOWNhZS04NGE0NjRiYmMwMmQiO3M6MzY6ImFlMjBmNTA0LTQ0NTItNGE3YS05Y2FlLTg0YTQ2NGJiYzAyZCI7fXM6MTQ6ImFub1NlbGVjaW9uYWRvIjtzOjQ6IjIwMjIiO3M6MzA6ImNvZF9wbGFub19kZV9hY2FvX2lkZW50aWZpY2FkbyI7czozNjoiMmYzZWMwYzctYzQwNC00NTFmLWI4YjAtOGJmYTdiM2RmYmM0Ijt9', 1644196704);
INSERT INTO public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('zXsnilyFLJvCnp0CauPaAZBJeMgzCTyv8hdeAgSb', NULL, '10.216.4.148', 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:96.0) Gecko/20100101 Firefox/96.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiR0J3V3ZPcVpQRTF1Y2RWOURzSjNpN2g5VXB2YTRFNDRNbld3QkFwdSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMC4yMTYuNC4xNDgvZ292ZXJuYW5jYS1wci9wdWJsaWMvMjAyMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoiYW5vIjtzOjQ6IjIwMjIiO30=', 1643997181);
INSERT INTO public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('WF85w9Gtnp1zV2KvogStvnsjX82be0sIp9VDbRxF', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '192.168.15.10', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoienFPYnZGQ2p2dzVndU9sc01LdmN6ejFpQVlWWUhveXBvZkxpUmRPRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjEyOiJodHRwOi8vMTkyLjE2OC4xNS4xMC9nb3Zlcm5hbmNhLXByL3B1YmxpYy8yMDIyL3VuaWRhZGUvMzgzNDkxMGYtNjZmNy00NmQ4LTkxMDQtMjkwNGQ1OWUxMjQxL3BlcnNwZWN0aXZhLzdlNThkYzNiLTFjNzYtNGZhNS1iZmI1LTcyZDA0ZmU0MDYyYy9vYmpldGl2by1lc3RyYXRlZ2ljby81YmI2YWIyNy00MGE2LTRhZjktYjc0Mi0wNmE2NjZhNDRmYzMvcGxhbm8tZGUtYWNhbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoiYW5vIjtzOjQ6IjIwMjIiO3M6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtzOjM2OiI3MzZhOWE1NC0yYTU0LTQxMzItYTYzZi03Zjk5NGZjMWMxZmQiO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkTjF5ZnhyckpIeGJnU0IvNjJFeE85ZWlaeWJLaVlrdWs4NDY3c2lTS010c3BKRDdxblMzMVciO3M6MzA6ImNvZF9wbGFub19kZV9hY2FvX2lkZW50aWZpY2FkbyI7czozNjoiZDcwZWY0OGEtMWUzOC00ZDMxLWI3NmMtODdkODQ2NDlmYTlhIjtzOjE1OiJjb2Rfb3JnYW5pemFjYW8iO2E6NDp7czozNjoiMzgzNDkxMGYtNjZmNy00NmQ4LTkxMDQtMjkwNGQ1OWUxMjQxIjtzOjM2OiIzODM0OTEwZi02NmY3LTQ2ZDgtOTEwNC0yOTA0ZDU5ZTEyNDEiO3M6MzY6ImFhZjFjZmE3LWY0ZGEtNDRjNy05OTRiLTE0MTM0OWU1ZDBkZCI7czozNjoiYWFmMWNmYTctZjRkYS00NGM3LTk5NGItMTQxMzQ5ZTVkMGRkIjtzOjM2OiIxN2Y0YWQyMi04YmQ1LTQxZjgtYTM4NS00OTgxODU2MmQ3MzYiO3M6MzY6IjE3ZjRhZDIyLThiZDUtNDFmOC1hMzg1LTQ5ODE4NTYyZDczNiI7czozNjoiYWUyMGY1MDQtNDQ1Mi00YTdhLTljYWUtODRhNDY0YmJjMDJkIjtzOjM2OiJhZTIwZjUwNC00NDUyLTRhN2EtOWNhZS04NGE0NjRiYmMwMmQiO31zOjE0OiJhbm9TZWxlY2lvbmFkbyI7czo0OiIyMDIyIjt9', 1643949590);
INSERT INTO public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('GVUfPG6c6Wh3P93QIhzwgGhRS84r2bX4TxcEdiyV', NULL, '10.216.4.66', 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.105 Safari/537.36', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiYU9VaFNVMWhYeElCZGM4ZG9UckkyZzJ1cVpaS202WWZSRlFaWHp4UyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDU6Imh0dHA6Ly8xMC4yMTYuNC4xNDgvZ292ZXJuYW5jYS1wci9wdWJsaWMvMjAyMiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoiYW5vIjtzOjQ6IjIwMjIiO3M6MTU6ImNvZF9vcmdhbml6YWNhbyI7YTo0OntzOjM2OiIzODM0OTEwZi02NmY3LTQ2ZDgtOTEwNC0yOTA0ZDU5ZTEyNDEiO3M6MzY6IjM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MSI7czozNjoiYWFmMWNmYTctZjRkYS00NGM3LTk5NGItMTQxMzQ5ZTVkMGRkIjtzOjM2OiJhYWYxY2ZhNy1mNGRhLTQ0YzctOTk0Yi0xNDEzNDllNWQwZGQiO3M6MzY6IjE3ZjRhZDIyLThiZDUtNDFmOC1hMzg1LTQ5ODE4NTYyZDczNiI7czozNjoiMTdmNGFkMjItOGJkNS00MWY4LWEzODUtNDk4MTg1NjJkNzM2IjtzOjM2OiJhZTIwZjUwNC00NDUyLTRhN2EtOWNhZS04NGE0NjRiYmMwMmQiO3M6MzY6ImFlMjBmNTA0LTQ0NTItNGE3YS05Y2FlLTg0YTQ2NGJiYzAyZCI7fXM6MTQ6ImFub1NlbGVjaW9uYWRvIjtpOjIwMjI7fQ==', 1643981663);
INSERT INTO public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('3snT4uX4sySEVozav2gRPZVaxXbsTtsQIYCyCSSA', NULL, '192.168.15.6', 'Mozilla/5.0 (Linux; Android 11; SM-A307GT) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.87 Mobile Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiekVHdTg1WEt0RkExTkw4QWx3bU85R3M0Snd5N2N0RXJ1dWJmNnVBWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjEyOiJodHRwOi8vMTkyLjE2OC4xNS4xMC9nb3Zlcm5hbmNhLXByL3B1YmxpYy8yMDIyL3VuaWRhZGUvMzgzNDkxMGYtNjZmNy00NmQ4LTkxMDQtMjkwNGQ1OWUxMjQxL3BlcnNwZWN0aXZhLzdlNThkYzNiLTFjNzYtNGZhNS1iZmI1LTcyZDA0ZmU0MDYyYy9vYmpldGl2by1lc3RyYXRlZ2ljby81YmI2YWIyNy00MGE2LTRhZjktYjc0Mi0wNmE2NjZhNDRmYzMvcGxhbm8tZGUtYWNhbyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoiYW5vIjtzOjQ6IjIwMjIiO3M6MTU6ImNvZF9vcmdhbml6YWNhbyI7YTo0OntzOjM2OiIzODM0OTEwZi02NmY3LTQ2ZDgtOTEwNC0yOTA0ZDU5ZTEyNDEiO3M6MzY6IjM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MSI7czozNjoiYWFmMWNmYTctZjRkYS00NGM3LTk5NGItMTQxMzQ5ZTVkMGRkIjtzOjM2OiJhYWYxY2ZhNy1mNGRhLTQ0YzctOTk0Yi0xNDEzNDllNWQwZGQiO3M6MzY6IjE3ZjRhZDIyLThiZDUtNDFmOC1hMzg1LTQ5ODE4NTYyZDczNiI7czozNjoiMTdmNGFkMjItOGJkNS00MWY4LWEzODUtNDk4MTg1NjJkNzM2IjtzOjM2OiJhZTIwZjUwNC00NDUyLTRhN2EtOWNhZS04NGE0NjRiYmMwMmQiO3M6MzY6ImFlMjBmNTA0LTQ0NTItNGE3YS05Y2FlLTg0YTQ2NGJiYzAyZCI7fXM6MTQ6ImFub1NlbGVjaW9uYWRvIjtzOjQ6IjIwMjIiO3M6MzA6ImNvZF9wbGFub19kZV9hY2FvX2lkZW50aWZpY2FkbyI7czozNjoiMmYzZWMwYzctYzQwNC00NTFmLWI4YjAtOGJmYTdiM2RmYmM0Ijt9', 1644024284);
INSERT INTO public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('SCSdtx0FUc9Np1fHCqlAKlG5mkslIK0Z9nnGkFkN', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '10.216.4.148', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YTo5OntzOjY6Il90b2tlbiI7czo0MDoiRlZFOUpqa0JrMWw1cnllSVprZHc4QWhPT2ZDTWhUVzN2aENEZVByayI7czozOiJhbm8iO3M6NDoiMjAyMiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjExOiJodHRwOi8vMTAuMjE2LjQuMTQ4L2dvdmVybmFuY2EtcHIvcHVibGljLzIwMjIvdW5pZGFkZS8zODM0OTEwZi02NmY3LTQ2ZDgtOTEwNC0yOTA0ZDU5ZTEyNDEvcGVyc3BlY3RpdmEvN2U1OGRjM2ItMWM3Ni00ZmE1LWJmYjUtNzJkMDRmZTQwNjJjL29iamV0aXZvLWVzdHJhdGVnaWNvLzViYjZhYjI3LTQwYTYtNGFmOS1iNzQyLTA2YTY2NmE0NGZjMy9wbGFuby1kZS1hY2FvIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO3M6MzY6IjczNmE5YTU0LTJhNTQtNDEzMi1hNjNmLTdmOTk0ZmMxYzFmZCI7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCROMXlmeHJySkh4YmdTQi82MkV4TzllaVp5YktpWWt1azg0NjdzaVNLTXRzcEpEN3FuUzMxVyI7czoxNToiY29kX29yZ2FuaXphY2FvIjthOjQ6e3M6MzY6IjM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MSI7czozNjoiMzgzNDkxMGYtNjZmNy00NmQ4LTkxMDQtMjkwNGQ1OWUxMjQxIjtzOjM2OiJhYWYxY2ZhNy1mNGRhLTQ0YzctOTk0Yi0xNDEzNDllNWQwZGQiO3M6MzY6ImFhZjFjZmE3LWY0ZGEtNDRjNy05OTRiLTE0MTM0OWU1ZDBkZCI7czozNjoiMTdmNGFkMjItOGJkNS00MWY4LWEzODUtNDk4MTg1NjJkNzM2IjtzOjM2OiIxN2Y0YWQyMi04YmQ1LTQxZjgtYTM4NS00OTgxODU2MmQ3MzYiO3M6MzY6ImFlMjBmNTA0LTQ0NTItNGE3YS05Y2FlLTg0YTQ2NGJiYzAyZCI7czozNjoiYWUyMGY1MDQtNDQ1Mi00YTdhLTljYWUtODRhNDY0YmJjMDJkIjt9czoxNDoiYW5vU2VsZWNpb25hZG8iO3M6NDoiMjAyMiI7czozMDoiY29kX3BsYW5vX2RlX2FjYW9faWRlbnRpZmljYWRvIjtzOjM2OiIyZjNlYzBjNy1jNDA0LTQ1MWYtYjhiMC04YmZhN2IzZGZiYzQiO30=', 1644014538);
INSERT INTO public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('25NL5X0hIgiBkrecSAZWRntsyBJoOgjMKUG4On7y', NULL, '192.168.15.6', 'Mozilla/5.0 (Linux; Android 11; SM-A307GT) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/98.0.4758.87 Mobile Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiUUxFZldWTEFoNUVKdFBObUJrZU1hUXNJeUc2RHltVWRvY1BSRkxqUCI7czozOiJhbm8iO3M6NDoiMjAyMiI7czoxNToiY29kX29yZ2FuaXphY2FvIjthOjQ6e3M6MzY6IjM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MSI7czozNjoiMzgzNDkxMGYtNjZmNy00NmQ4LTkxMDQtMjkwNGQ1OWUxMjQxIjtzOjM2OiJhYWYxY2ZhNy1mNGRhLTQ0YzctOTk0Yi0xNDEzNDllNWQwZGQiO3M6MzY6ImFhZjFjZmE3LWY0ZGEtNDRjNy05OTRiLTE0MTM0OWU1ZDBkZCI7czozNjoiMTdmNGFkMjItOGJkNS00MWY4LWEzODUtNDk4MTg1NjJkNzM2IjtzOjM2OiIxN2Y0YWQyMi04YmQ1LTQxZjgtYTM4NS00OTgxODU2MmQ3MzYiO3M6MzY6ImFlMjBmNTA0LTQ0NTItNGE3YS05Y2FlLTg0YTQ2NGJiYzAyZCI7czozNjoiYWUyMGY1MDQtNDQ1Mi00YTdhLTljYWUtODRhNDY0YmJjMDJkIjt9czoxNDoiYW5vU2VsZWNpb25hZG8iO3M6NDoiMjAyMiI7czozMDoiY29kX3BsYW5vX2RlX2FjYW9faWRlbnRpZmljYWRvIjtzOjM2OiIyZjNlYzBjNy1jNDA0LTQ1MWYtYjhiMC04YmZhN2IzZGZiYzQiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxMjoiaHR0cDovLzE5Mi4xNjguMTUuMTAvZ292ZXJuYW5jYS1wci9wdWJsaWMvMjAyMi91bmlkYWRlLzM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MS9wZXJzcGVjdGl2YS83ZTU4ZGMzYi0xYzc2LTRmYTUtYmZiNS03MmQwNGZlNDA2MmMvb2JqZXRpdm8tZXN0cmF0ZWdpY28vNWJiNmFiMjctNDBhNi00YWY5LWI3NDItMDZhNjY2YTQ0ZmMzL3BsYW5vLWRlLWFjYW8iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1644100474);
INSERT INTO public.sessions (id, user_id, ip_address, user_agent, payload, last_activity) VALUES ('Xh5xnu9PhQcDdKRZvZZh6QDlfom5vfUNppxTiA0W', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '192.168.15.10', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/97.0.4692.99 Safari/537.36', 'YToxMTp7czo2OiJfdG9rZW4iO3M6NDA6IjJZZzZJS3c4QnZOSXN3Tm44cUtsOXJZUG1VMkpaYVd3eTZaem5UTUgiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjIxMjoiaHR0cDovLzE5Mi4xNjguMTUuMTAvZ292ZXJuYW5jYS1wci9wdWJsaWMvMjAyMi91bmlkYWRlLzM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MS9wZXJzcGVjdGl2YS83ZTU4ZGMzYi0xYzc2LTRmYTUtYmZiNS03MmQwNGZlNDA2MmMvb2JqZXRpdm8tZXN0cmF0ZWdpY28vNWJiNmFiMjctNDBhNi00YWY5LWI3NDItMDZhNjY2YTQ0ZmMzL3BsYW5vLWRlLWFjYW8iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6ImFubyI7czo0OiIyMDIyIjtzOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7czozNjoiNzM2YTlhNTQtMmE1NC00MTMyLWE2M2YtN2Y5OTRmYzFjMWZkIjtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJE4xeWZ4cnJKSHhiZ1NCLzYyRXhPOWVpWnliS2lZa3VrODQ2N3NpU0tNdHNwSkQ3cW5TMzFXIjtzOjE1OiJjb2RfcGVyc3BlY3RpdmEiO3M6MzY6IjFjOGQzNDQwLWNhNjctNDllYy1iYjQ5LTIyNjRiMmQ1MDlhOCI7czoxNzoiY29kX3BsYW5vX2RlX2FjYW8iO3M6MzY6IjNiYmI5NDlmLWI0MzAtNDRiYi1iYmQ5LTg1ZTg5NWQ4ZTI3MyI7czoxNToiY29kX29yZ2FuaXphY2FvIjthOjQ6e3M6MzY6IjM4MzQ5MTBmLTY2ZjctNDZkOC05MTA0LTI5MDRkNTllMTI0MSI7czozNjoiMzgzNDkxMGYtNjZmNy00NmQ4LTkxMDQtMjkwNGQ1OWUxMjQxIjtzOjM2OiJhYWYxY2ZhNy1mNGRhLTQ0YzctOTk0Yi0xNDEzNDllNWQwZGQiO3M6MzY6ImFhZjFjZmE3LWY0ZGEtNDRjNy05OTRiLTE0MTM0OWU1ZDBkZCI7czozNjoiMTdmNGFkMjItOGJkNS00MWY4LWEzODUtNDk4MTg1NjJkNzM2IjtzOjM2OiIxN2Y0YWQyMi04YmQ1LTQxZjgtYTM4NS00OTgxODU2MmQ3MzYiO3M6MzY6ImFlMjBmNTA0LTQ0NTItNGE3YS05Y2FlLTg0YTQ2NGJiYzAyZCI7czozNjoiYWUyMGY1MDQtNDQ1Mi00YTdhLTljYWUtODRhNDY0YmJjMDJkIjt9czoxNDoiYW5vU2VsZWNpb25hZG8iO3M6NDoiMjAyMiI7czozMDoiY29kX3BsYW5vX2RlX2FjYW9faWRlbnRpZmljYWRvIjtzOjM2OiIyZjNlYzBjNy1jNDA0LTQ1MWYtYjhiMC04YmZhN2IzZGZiYzQiO30=', 1644203452);


--
-- Data for Name: tab_audit; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c51aa7ed-f829-4797-bd22-ea984efc0f3c', 'Editou', 'yellow', 'yellows', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:01', '2022-01-26 18:30:01', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('66a633d6-f722-4b13-82cf-99d99b60b14f', 'Editou', '55.00', '5.500,00', 'tab_grau_satisfcao', 'vlr_minimo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:01', '2022-01-26 18:30:01', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c67819b5-5c64-42d2-8e75-31ea3e3c18a8', 'Editou', '89.99', '8.999,00', 'tab_grau_satisfcao', 'vlr_maximo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:01', '2022-01-26 18:30:01', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('28bc9277-39d5-4742-a904-c5f9c46bb3aa', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:54', '2022-01-26 18:30:54', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b2e66176-2d1a-465c-b100-afb720d2b6ec', 'Editou', '5500.00', '55,00', 'tab_grau_satisfcao', 'vlr_minimo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:54', '2022-01-26 18:30:54', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('9d353685-458d-4297-8e6e-2aa2d3d7b570', 'Editou', '8999.00', '89,99', 'tab_grau_satisfcao', 'vlr_maximo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:30:54', '2022-01-26 18:30:54', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('1c6d2a49-96b3-4526-a8b4-fc20b6e8c6bc', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:32:19', '2022-01-26 18:32:19', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('bf2bc9cf-a27a-451f-9ac1-e5cb644ec6d1', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:32:33', '2022-01-26 18:32:33', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b5e7210f-9a88-445d-9f0d-13741ab07924', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:06', '2022-01-26 18:33:06', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('0fbffac4-e63c-4928-9468-529c2cdd8c1c', 'Editou', '5500.00', '55,00', 'tab_grau_satisfcao', 'vlr_minimo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:06', '2022-01-26 18:33:06', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('68120a72-5015-4e26-aa35-61d3e1b68338', 'Editou', '8999.00', '89,99', 'tab_grau_satisfcao', 'vlr_maximo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:06', '2022-01-26 18:33:06', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('6c8e8fe3-e904-4a62-94ba-44afa523c0ca', 'Editou', 'yellow', 'yellows', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:23', '2022-01-26 18:33:23', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('a70ded86-9abc-4dfc-8aa6-1c2071116a0d', 'Editou', '55.00', '5.500,00', 'tab_grau_satisfcao', 'vlr_minimo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:23', '2022-01-26 18:33:23', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('242b44aa-6c1c-4952-95d2-0d12b74265df', 'Editou', '89.99', '8.999,00', 'tab_grau_satisfcao', 'vlr_maximo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:33:23', '2022-01-26 18:33:23', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('8f6b4022-a38d-45bd-b330-0406896a6797', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:44:45', '2022-01-26 18:44:45', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('03eeb112-02b6-408b-926d-a36f27c7a02a', 'Editou', '5500.00', '55,00', 'tab_grau_satisfcao', 'vlr_minimo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:44:45', '2022-01-26 18:44:45', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('d028db9e-f018-4b36-ab2b-e2016b451bfc', 'Editou', '8999.00', '89,99', 'tab_grau_satisfcao', 'vlr_maximo', 'numeric', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:44:45', '2022-01-26 18:44:45', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('bf78aacf-b959-4060-8cd5-57919cc0a0e9', 'Editou', 'yellow', 'yellows', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:44:54', '2022-01-26 18:44:54', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('21ee757a-7560-4a0c-8de0-5d5ffced4517', 'Editou', 'yellows', 'yellow', 'tab_grau_satisfcao', 'cor', 'character varying', '54c65973-0a1a-4f56-a300-77a46ab29db4', '127.0.0.1', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-26 18:45:01', '2022-01-26 18:45:01', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('bcbc0fdb-1fbf-4d48-be7d-ed361f3069a2', 'Editou', '', '39', 'tab_meta_por_ano', 'meta', 'numeric', '1c7ab97b-9774-49d9-ab2a-a5bcd279a1ce', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('940a0293-2f3b-4a9d-a938-5e79dc32108c', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '821021a2-5f03-48c7-8172-65aba9421ec3', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('2ad1446e-6bf8-4499-8153-ede7eb3d92c9', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', 'fa2693cc-449d-427c-8c95-e860ee5dc974', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('2926a2c4-87bf-4634-9772-65e855a55374', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', 'b3560e5a-2518-4ea0-b458-1ec8f770d8ab', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('58ddbd8e-7a0d-40a2-920d-10853b160cba', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '8685c985-e7a6-4e16-a426-7403e5ef5f76', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('70813e9c-0e2a-4606-9998-6f7419110ba7', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '5bfa1f45-a121-4462-85a9-34f203f2eb25', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('7acf4625-9d9b-4763-a849-0ae53e1f1650', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '01257081-1134-4bb8-a8b4-a64cfb896a45', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('7235e48c-6d9a-4a05-9bd7-3b6ed8f77d2e', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '3630df52-8c42-4acc-86f7-42ddb3eaedac', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('3d12dbfa-95c2-45fd-8725-99ac2c1b2011', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '398172db-7505-428f-ab16-3294c36af726', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b15bced5-bf8c-4a90-97f5-707bc46d44c8', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '9fda8be6-7fa6-4ec5-a8a7-0fadac339669', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('25b71e7c-016f-4d85-9d28-568d0b5401f1', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', 'aca1c41a-f048-43e9-b721-f810f0d7602b', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('70c037b9-5da0-4258-9657-5ec9598fa6f6', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '78bad0e3-67c7-4017-827e-6f7aefa2a169', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('2aad5a5f-bcd2-47c3-9c6d-6e17decab7e1', 'Editou', '', '39', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '8ca8b75f-e0a6-4750-825f-d072c4d866b2', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:07:20', '2022-01-29 02:07:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('4f2a0f26-9473-409c-8e43-72ad1745ac1c', 'Editou', '', '33', 'tab_meta_por_ano', 'meta', 'numeric', 'bd8cc26a-fa84-4753-b068-c22e467b1f5b', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('33169289-6488-440d-acda-841983f32044', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '469f38cd-a93c-487a-9dcd-7fd2625fc0de', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('ffb25159-45df-4c01-9fd2-b5ea33d9a76f', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '72e62ce6-e53f-4a62-9ec4-58f04b47c1e2', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b4f9a42b-7579-471b-8780-40529c9cc605', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '55a3bd20-8e5a-49e3-b696-fc88223eee4b', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('461e70c9-1feb-4945-9e1f-109ee86b581b', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '7fa2dc64-47eb-4924-be30-e6094b857716', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('fffa21b1-d262-43ac-9b7e-a5574775ad1b', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '1e691fbd-0ced-4250-80d4-0ab2b5904b06', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('ad84064b-615a-4670-bbc7-2518a58b18bf', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '74e65053-1617-42c0-bfe9-7c72b3088419', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('122b24d2-9604-4766-bda2-3b39fa5b4ed5', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '401d598a-f573-4b08-9657-886b6c834ba8', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('8fcb282b-bc78-4ff7-b16a-eaaa5e82de20', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '4c868967-bedd-48c6-bd6d-5dee957c5cf8', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('92311fec-3d18-4c12-81a3-99a102512474', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '92dcd54f-8e3e-440a-965a-02b1c01caf1c', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c872bf30-eb1b-4ac0-a9fe-412a46b2aa81', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '80058c1e-2011-4a50-8c99-56361a89af48', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b78d9cc5-f7f9-4a4a-aab5-d6b38dfaac01', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '6a6b243c-651c-48b1-9607-a06fb67786e3', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('190bc974-3d02-4741-880e-f22881fc8d90', 'Editou', '', '33', 'tab_evolucao_indicador', 'vlr_previsto', 'numeric', '1b6e972f-d8e3-410d-a8e3-eb53fd69b404', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-29 02:08:12', '2022-01-29 02:08:12', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('4bcc141d-77b3-41b1-a9f5-82d529b9b972', 'Editou', 'Teste', 'Indicador A', 'tab_indicador', 'dsc_indicador', 'text', '7095d452-ea88-43db-a733-3538f9a103b9', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-31 20:39:09', '2022-01-31 20:39:09', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('a2ad40c5-d4b0-4802-853d-8462e5bdfd2c', 'Editou', 'Indicador 2', 'Indicador B', 'tab_indicador', 'dsc_indicador', 'text', '7095d452-ea88-43db-a733-3538f9a103b9', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-01-31 20:40:18', '2022-01-31 20:40:18', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('6360aebd-92ca-45a1-886b-d566ecf79be4', 'Editou o(a) servidor(a) responsável', 'Kyler Fritsch', 'Marcio Alessandro Xavier Neto', 'tab_plano_de_acao', 'user_id_responsavel', 'uuid', '7095d452-ea88-43db-a733-3538f9a103b9', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 15:41:55', '2022-02-02 15:41:55', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('36564a05-195d-47a6-aa00-c135fd551880', 'Editou o(a) servidor(a) responsável', '', 'Prof. Vivien Macejkovic Jr.', 'tab_plano_de_acao', 'user_id_responsavel', 'uuid', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 15:43:20', '2022-02-02 15:43:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('64a99692-200a-4086-9c4f-f3e04025c384', 'Editou o(a) servidor(a) responsável', '', 'Kyler Fritsch', 'tab_plano_de_acao', 'user_id_responsavel', 'uuid', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 15:43:56', '2022-02-02 15:43:56', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('dac9307d-0571-4196-902d-3e6c6531aa22', 'Editou o(a) servidor(a) substituo', '', 'Mr. Freddie Stroman', 'tab_plano_de_acao', 'user_id_substituto', 'uuid', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 21:21:53', '2022-02-02 21:21:53', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c98ffcc7-c6d3-4454-9d86-70f51c6074cd', 'Editou o(a) servidor(a) substituo', 'Mr. Freddie Stroman', 'Marcio Alessandro Xavier Neto', 'tab_plano_de_acao', 'user_id_substituto', 'uuid', '3bbb949f-b430-44bb-bbd9-85e895d8e273', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 21:37:48', '2022-02-02 21:37:48', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('5faa9bb3-c1ec-41ab-9e13-f252e3757262', 'Editou', '75', '79', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 23:47:40', '2022-02-02 23:47:40', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('38f9311f-ad4b-4260-9aa8-26e6c76e0698', 'Editou', '79', '', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-02 23:58:20', '2022-02-02 23:58:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('f8b066a6-9cf4-42ba-a9cc-3118a7effd47', 'Editou', '79', '', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:00:08', '2022-02-03 00:00:08', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('715bb483-20c8-4a57-90cf-5d04f1b5a018', 'Editou', '79', '', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:01:51', '2022-02-03 00:01:51', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('86a14a98-c7c3-4f72-9c57-a34be7fb18a1', 'Editou', '79', '75', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:11:20', '2022-02-03 00:11:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('a5ab1b58-2499-4652-984f-5390017179d8', 'Editou', '75', '95', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:11:32', '2022-02-03 00:11:32', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('5d30485a-aa0c-4004-be27-e4325efc5736', 'Editou', '95', '75', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:12:00', '2022-02-03 00:12:00', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('f2233fc7-5e9d-464d-9810-1bf8ad15ad10', 'Editou', 'When a new file is selected, Livewire''s JavaScript makes an initial request to the component on the server to get a temporary "signed" upload URL.
Once the url is received, JavaScript then does the actual "upload" to the signed URL, storing the upload in a temporary directory designated by Livewire and returning the new temporary file''s unique hash ID.
Once the file is uploaded and the unique hash ID is generated, Livewire''s JavaScript makes a final request to the component on the server telling it to "set" the desired public property to the new temporary file.', '', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:30:20', '2022-02-03 00:30:20', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c0818353-dd90-4b39-9259-ec45c08b68e0', 'Editou', '', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 00:31:53', '2022-02-03 00:31:53', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('3ed53b25-6ed5-42f0-a101-c275dddcf883', 'Editou', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. teste.', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:18:37', '2022-02-03 10:18:37', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('0eb968f4-64ba-4844-aabd-8cc2b3898161', 'Editou', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. teste.', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:21:18', '2022-02-03 10:21:18', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b9da9f45-72d3-4da0-be47-85e9916d41fa', 'Editou', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. Teste.', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:22:31', '2022-02-03 10:22:31', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('b097891b-71aa-4917-ae57-b83fe2617ed5', 'Editou', '75', '29', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:23:15', '2022-02-03 10:23:15', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('2271cb5b-2d54-49a9-8cb3-b7f9d785cd6f', 'Editou', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended. Teste.', 'You might be wondering if you can use Laravel''s "FormRequest"s. Due to the nature of Livewire, hooking into the http request wouldn''t make sense. For now, this functionality is not possible or recommended.', 'tab_evolucao_indicador', 'txt_avaliacao', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:23:15', '2022-02-03 10:23:15', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c2bca0e4-ee66-4408-a37c-3a92fe88e037', 'Editou', '29', '75', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:28:02', '2022-02-03 10:28:02', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('1d8f21a9-27d7-483e-9ec6-3aad07df7170', 'Editou', '75', '79', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '10.216.4.66', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-03 10:30:25', '2022-02-03 10:30:25', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('c19e4a34-1300-44e4-91b8-ff0ed53f35b9', 'Editou', '2022-12-21', '2022-09-30', 'tab_plano_de_acao', 'dte_fim', 'date', 'db5881ee-8a92-4bcb-bd4f-4ac788f4aeae', '10.216.4.148', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-04 11:44:27', '2022-02-04 11:44:27', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('ee3a337e-0cd9-4f52-be32-f07e2aeb4476', 'Editou', '2022-01-02', '2021-01-02', 'tab_plano_de_acao', 'dte_inicio', 'date', 'db5881ee-8a92-4bcb-bd4f-4ac788f4aeae', '10.216.4.148', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-04 11:55:40', '2022-02-04 11:55:40', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('4f91f8c9-a098-461f-88c5-be72557cd547', 'Editou', '79', '75', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '11bad8ec-f64c-48dd-8794-996c5ccf199d', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-05 00:06:01', '2022-02-05 00:06:01', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('98abb6d3-a56d-4e2b-a6dc-ddf6f0b1493d', 'Editou', '1,00', '5.000.000,00', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '1eff4bb7-917c-4de8-8ef0-190524d5f8da', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-05 01:14:44', '2022-02-05 01:14:44', NULL);
INSERT INTO public.tab_audit (id, acao, antes, depois, "table", column_name, data_type, table_id, ip, user_id, created_at, updated_at, deleted_at) VALUES ('e6fbd4db-897f-4ab9-ac39-10168cea10ec', 'Editou', '5.000.000,00', '500.000,00', 'tab_evolucao_indicador', 'vlr_realizado', 'numeric', '1eff4bb7-917c-4de8-8ef0-190524d5f8da', '192.168.15.10', '736a9a54-2a54-4132-a63f-7f994fc1c1fd', '2022-02-05 01:19:39', '2022-02-05 01:19:39', NULL);


--
-- Data for Name: tab_organizacoes; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('3834910f-66f7-46d8-9104-2904d59e1241', 'UnidCent', 'Unidade Central', '3834910f-66f7-46d8-9104-2904d59e1241', '2021-10-21 10:38:09', '2021-10-21 13:20:45', NULL);
INSERT INTO public.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('aaf1cfa7-f4da-44c7-994b-141349e5d0dd', 'SE', 'Secretaria-Executiva', '3834910f-66f7-46d8-9104-2904d59e1241', '2021-11-24 15:21:46', '2021-11-24 15:21:46', NULL);
INSERT INTO public.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('17f4ad22-8bd5-41f8-a385-49818562d736', 'SECOG', 'Secretaria de Coordenação Estrutural e Gestão Corporativa', 'aaf1cfa7-f4da-44c7-994b-141349e5d0dd', '2021-11-24 15:23:08', '2021-11-24 15:23:08', NULL);
INSERT INTO public.tab_organizacoes (cod_organizacao, sgl_organizacao, nom_organizacao, rel_cod_organizacao, created_at, updated_at, deleted_at) VALUES ('ae20f504-4452-4a7a-9cae-84a464bbc02d', 'DIGEC', 'Diretoria de Gestão Estratégica e Coordenação Estrutural', '17f4ad22-8bd5-41f8-a385-49818562d736', '2021-11-24 15:24:04', '2021-11-24 15:24:04', NULL);


--
-- Data for Name: tab_perfil_acesso; Type: TABLE DATA; Schema: public; Owner: marcio
--

INSERT INTO public.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, created_at, updated_at, deleted_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff2a', 'Super Administrador', 'Servidor(a) com todos os privilégios de administração do sistema', '2021-11-14 23:21:21', '2021-11-14 23:21:21', NULL);
INSERT INTO public.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, created_at, updated_at, deleted_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff3b', 'Administrador da Unidade', 'Servidor(a) com todos os privilégios de administração do sistema somente dentro da Unidade que está cadastrado', '2021-11-14 23:21:21', '2021-11-14 23:21:21', NULL);
INSERT INTO public.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, created_at, updated_at, deleted_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff4c', 'Gestor(a) Responsável', 'Servidor(a) que tem como responsabilidade manter a atualização do Plano de Ação ao qual está como responsável', '2021-11-14 23:21:21', '2021-11-14 23:21:21', NULL);
INSERT INTO public.tab_perfil_acesso (cod_perfil, dsc_perfil, dsc_permissao, created_at, updated_at, deleted_at) VALUES ('c00b9ebc-7014-4d37-97dc-7875e55fff5d', 'Gestor(a) Substituto(a)', 'Servidor(a) que tem como responsabilidade manter a atualização do Plano de Ação ao qual está como substituto(a)', '2021-11-14 23:21:21', '2021-11-14 23:21:21', NULL);


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
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: governanca; Owner: marcio
--

SELECT pg_catalog.setval('governanca.failed_jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: governanca; Owner: marcio
--

SELECT pg_catalog.setval('governanca.migrations_id_seq', 24, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: governanca; Owner: marcio
--

SELECT pg_catalog.setval('governanca.personal_access_tokens_id_seq', 1, false);


--
-- Name: failed_jobs_id_seq; Type: SEQUENCE SET; Schema: public; Owner: marcio
--

SELECT pg_catalog.setval('public.failed_jobs_id_seq', 1, false);


--
-- Name: migrations_id_seq; Type: SEQUENCE SET; Schema: public; Owner: marcio
--

SELECT pg_catalog.setval('public.migrations_id_seq', 24, true);


--
-- Name: personal_access_tokens_id_seq; Type: SEQUENCE SET; Schema: public; Owner: marcio
--

SELECT pg_catalog.setval('public.personal_access_tokens_id_seq', 1, false);


--
-- Name: acoes acoes_pkey; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.acoes
    ADD CONSTRAINT acoes_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_pkey; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.failed_jobs
    ADD CONSTRAINT failed_jobs_pkey PRIMARY KEY (id);


--
-- Name: failed_jobs failed_jobs_uuid_unique; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.failed_jobs
    ADD CONSTRAINT failed_jobs_uuid_unique UNIQUE (uuid);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_pkey; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_pkey PRIMARY KEY (id);


--
-- Name: personal_access_tokens personal_access_tokens_token_unique; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.personal_access_tokens
    ADD CONSTRAINT personal_access_tokens_token_unique UNIQUE (token);


--
-- Name: rel_organizacao rel_organizacao_pkey; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.rel_organizacao
    ADD CONSTRAINT rel_organizacao_pkey PRIMARY KEY (id);


--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso rel_users_tab_organizacoes_tab_perfil_acesso_pkey; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.rel_users_tab_organizacoes_tab_perfil_acesso
    ADD CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_pkey PRIMARY KEY (id);


--
-- Name: sessions sessions_pkey; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.sessions
    ADD CONSTRAINT sessions_pkey PRIMARY KEY (id);


--
-- Name: tab_audit tab_audit_pkey; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.tab_audit
    ADD CONSTRAINT tab_audit_pkey PRIMARY KEY (id);


--
-- Name: tab_organizacoes tab_organizacoes_pkey; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.tab_organizacoes
    ADD CONSTRAINT tab_organizacoes_pkey PRIMARY KEY (cod_organizacao);


--
-- Name: tab_perfil_acesso tab_perfil_acesso_pkey; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.tab_perfil_acesso
    ADD CONSTRAINT tab_perfil_acesso_pkey PRIMARY KEY (cod_perfil);


--
-- Name: users users_cpf_unique; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.users
    ADD CONSTRAINT users_cpf_unique UNIQUE (cpf);


--
-- Name: users users_email_unique; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.users
    ADD CONSTRAINT users_email_unique UNIQUE (email);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: tab_evolucao_indicador tab_evolucao_indicador_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_evolucao_indicador
    ADD CONSTRAINT tab_evolucao_indicador_pkey PRIMARY KEY (cod_evolucao_indicador);


--
-- Name: tab_grau_satisfcao tab_grau_satisfcao_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_grau_satisfcao
    ADD CONSTRAINT tab_grau_satisfcao_pkey PRIMARY KEY (cod_grau_satisfcao);


--
-- Name: tab_indicador tab_indicador_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_indicador
    ADD CONSTRAINT tab_indicador_pkey PRIMARY KEY (cod_indicador);


--
-- Name: tab_linha_base_indicador tab_linha_base_indicador_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_linha_base_indicador
    ADD CONSTRAINT tab_linha_base_indicador_pkey PRIMARY KEY (cod_linha_base);


--
-- Name: tab_meta_por_ano tab_meta_por_ano_pkey; Type: CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_meta_por_ano
    ADD CONSTRAINT tab_meta_por_ano_pkey PRIMARY KEY (cod_meta_por_ano);


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
-- Name: tab_audit tab_audit_pkey; Type: CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.tab_audit
    ADD CONSTRAINT tab_audit_pkey PRIMARY KEY (id);


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
-- Name: password_resets_email_index; Type: INDEX; Schema: governanca; Owner: marcio
--

CREATE INDEX password_resets_email_index ON governanca.password_resets USING btree (email);


--
-- Name: personal_access_tokens_tokenable_type_tokenable_id_index; Type: INDEX; Schema: governanca; Owner: marcio
--

CREATE INDEX personal_access_tokens_tokenable_type_tokenable_id_index ON governanca.personal_access_tokens USING btree (tokenable_type, tokenable_id);


--
-- Name: sessions_last_activity_index; Type: INDEX; Schema: governanca; Owner: marcio
--

CREATE INDEX sessions_last_activity_index ON governanca.sessions USING btree (last_activity);


--
-- Name: sessions_user_id_index; Type: INDEX; Schema: governanca; Owner: marcio
--

CREATE INDEX sessions_user_id_index ON governanca.sessions USING btree (user_id);


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
-- Name: acoes acoes_user_id_foreign; Type: FK CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.acoes
    ADD CONSTRAINT acoes_user_id_foreign FOREIGN KEY (user_id) REFERENCES governanca.users(id);


--
-- Name: rel_organizacao rel_organizacao_cod_organizacao_foreign; Type: FK CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.rel_organizacao
    ADD CONSTRAINT rel_organizacao_cod_organizacao_foreign FOREIGN KEY (cod_organizacao) REFERENCES governanca.tab_organizacoes(cod_organizacao);


--
-- Name: rel_organizacao rel_organizacao_rel_cod_organizacao_foreign; Type: FK CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.rel_organizacao
    ADD CONSTRAINT rel_organizacao_rel_cod_organizacao_foreign FOREIGN KEY (rel_cod_organizacao) REFERENCES governanca.tab_organizacoes(cod_organizacao);


--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso rel_users_tab_organizacoes_tab_perfil_acesso_cod_organizacao_fo; Type: FK CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.rel_users_tab_organizacoes_tab_perfil_acesso
    ADD CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_organizacao_fo FOREIGN KEY (cod_organizacao) REFERENCES governanca.tab_organizacoes(cod_organizacao);


--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso rel_users_tab_organizacoes_tab_perfil_acesso_cod_perfil_foreign; Type: FK CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.rel_users_tab_organizacoes_tab_perfil_acesso
    ADD CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_perfil_foreign FOREIGN KEY (cod_perfil) REFERENCES governanca.tab_perfil_acesso(cod_perfil);


--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso rel_users_tab_organizacoes_tab_perfil_acesso_cod_plano_de_acao_; Type: FK CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.rel_users_tab_organizacoes_tab_perfil_acesso
    ADD CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_plano_de_acao_ FOREIGN KEY (cod_plano_de_acao) REFERENCES pei.tab_plano_de_acao(cod_plano_de_acao);


--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso rel_users_tab_organizacoes_tab_perfil_acesso_user_id_foreign; Type: FK CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.rel_users_tab_organizacoes_tab_perfil_acesso
    ADD CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_user_id_foreign FOREIGN KEY (user_id) REFERENCES governanca.users(id);


--
-- Name: tab_audit tab_audit_user_id_foreign; Type: FK CONSTRAINT; Schema: governanca; Owner: marcio
--

ALTER TABLE ONLY governanca.tab_audit
    ADD CONSTRAINT tab_audit_user_id_foreign FOREIGN KEY (user_id) REFERENCES governanca.users(id);


--
-- Name: tab_evolucao_indicador pei_tab_evolucao_indicador_cod_indicador_foreign; Type: FK CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_evolucao_indicador
    ADD CONSTRAINT pei_tab_evolucao_indicador_cod_indicador_foreign FOREIGN KEY (cod_indicador) REFERENCES pei.tab_indicador(cod_indicador);


--
-- Name: tab_indicador pei_tab_indicador_cod_plano_de_acao_foreign; Type: FK CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_indicador
    ADD CONSTRAINT pei_tab_indicador_cod_plano_de_acao_foreign FOREIGN KEY (cod_plano_de_acao) REFERENCES pei.tab_plano_de_acao(cod_plano_de_acao);


--
-- Name: tab_linha_base_indicador pei_tab_linha_base_indicador_cod_indicador_foreign; Type: FK CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_linha_base_indicador
    ADD CONSTRAINT pei_tab_linha_base_indicador_cod_indicador_foreign FOREIGN KEY (cod_indicador) REFERENCES pei.tab_indicador(cod_indicador) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: tab_meta_por_ano pei_tab_meta_por_ano_cod_indicador_foreign; Type: FK CONSTRAINT; Schema: pei; Owner: marcio
--

ALTER TABLE ONLY pei.tab_meta_por_ano
    ADD CONSTRAINT pei_tab_meta_por_ano_cod_indicador_foreign FOREIGN KEY (cod_indicador) REFERENCES pei.tab_indicador(cod_indicador);


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
-- Name: acoes acoes_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.acoes
    ADD CONSTRAINT acoes_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


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
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso rel_users_tab_organizacoes_tab_perfil_acesso_cod_plano_de_acao_; Type: FK CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso
    ADD CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_cod_plano_de_acao_ FOREIGN KEY (cod_plano_de_acao) REFERENCES pei.tab_plano_de_acao(cod_plano_de_acao);


--
-- Name: rel_users_tab_organizacoes_tab_perfil_acesso rel_users_tab_organizacoes_tab_perfil_acesso_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.rel_users_tab_organizacoes_tab_perfil_acesso
    ADD CONSTRAINT rel_users_tab_organizacoes_tab_perfil_acesso_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- Name: tab_audit tab_audit_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: marcio
--

ALTER TABLE ONLY public.tab_audit
    ADD CONSTRAINT tab_audit_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- PostgreSQL database dump complete
--

