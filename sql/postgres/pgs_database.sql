-- **
-- Author:  debian
-- Created: 25/10/2017
--
-- POSTGRESQL
--
-- **

-- Database: portal_u

-- DROP DATABASE portal_u;

CREATE DATABASE IF NOT EXISTS portal_u
  WITH OWNER = postgres
       ENCODING = 'UTF8'
       TABLESPACE = pg_default
       LC_COLLATE = 'pt_BR.UTF-8'
       LC_CTYPE = 'pt_BR.UTF-8'
       CONNECTION LIMIT = -1;

-- ***************************************************************************
-- Table: public.tab_users
-- DROP TABLE public.tab_users;
CREATE TABLE public.tab_users (
  usr_uid       integer NOT NULL DEFAULT nextval('tab_users_user_uid_seq'::regclass),
  usr_name      character varying(32) NOT NULL,
  usr_email     character varying(256) NOT NULL,
  usr_pass      character varying(64) NOT NULL,
  usr_mobile    character varying(64),
  usr_group_uid integer DEFAULT 1,
  usr_site      character varying(256),
  usr_created   timestamp without time zone DEFAULT now(),
  CONSTRAINT tab_users_pkey PRIMARY KEY (usr_uid),
  CONSTRAINT tab_users_user_email_key UNIQUE (usr_email),
  CONSTRAINT tab_users_user_name_key UNIQUE (usr_name)
)
WITH (
  OIDS=FALSE
);
--
ALTER TABLE public.tab_users
  OWNER TO postgres;