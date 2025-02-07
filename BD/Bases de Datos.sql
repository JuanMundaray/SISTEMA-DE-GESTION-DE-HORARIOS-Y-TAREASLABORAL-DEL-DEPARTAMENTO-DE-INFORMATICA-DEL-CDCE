--Base de Datos--
CREATE DATABASE "CDCE_SGHT"
    WITH
    OWNER = postgres
    TEMPLATE = template0
    ENCODING = 'UTF8'
    LOCALE_PROVIDER = 'libc'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;

-- SCHEMA: asistencia--

-- DROP SCHEMA IF EXISTS asistencia ;

CREATE SCHEMA IF NOT EXISTS asistencia
    AUTHORIZATION postgres;

-- Table: asistencia.usuarios--

-- DROP TABLE IF EXISTS asistencia.usuarios;

CREATE TABLE IF NOT EXISTS asistencia.usuarios
(
    id integer NOT NULL DEFAULT nextval('asistencia.usuarios_id_seq'::regclass),
    nombre character varying(100) COLLATE pg_catalog."default" NOT NULL,
    email character varying(100) COLLATE pg_catalog."default" NOT NULL,
    password character varying(255) COLLATE pg_catalog."default" NOT NULL,
    telefono character varying(20) COLLATE pg_catalog."default",
    direccion text COLLATE pg_catalog."default",
    fecha_creaccion timestamp without time zone,
    id_departamento integer,
    id_rol integer,
    CONSTRAINT usuarios_pkey PRIMARY KEY (id),
    CONSTRAINT usuarios_email_key UNIQUE (email),
    CONSTRAINT usuarios_id_departamento_fkey FOREIGN KEY (id_departamento)
        REFERENCES asistencia.departamento (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT usuarios_id_rol_fkey FOREIGN KEY (id_rol)
        REFERENCES asistencia.rol_usuario (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS asistencia.usuarios
    OWNER to postgres;

-- Table: asistencia.departamento--

-- DROP TABLE IF EXISTS asistencia.departamento;

CREATE TABLE IF NOT EXISTS asistencia.departamento
(
    id integer NOT NULL DEFAULT nextval('asistencia.departamento_id_seq'::regclass),
    nombre character varying(100) COLLATE pg_catalog."default" NOT NULL,
    descripcion text COLLATE pg_catalog."default",
    CONSTRAINT departamento_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS asistencia.departamento
    OWNER to postgres;

-- Table: asistencia.rol_usuario--

-- DROP TABLE IF EXISTS asistencia.rol_usuario;

CREATE TABLE IF NOT EXISTS asistencia.rol_usuario
(
    id integer NOT NULL DEFAULT nextval('asistencia.rol_usuario_id_seq'::regclass),
    nombre character varying(50) COLLATE pg_catalog."default" NOT NULL,
    descripcion text COLLATE pg_catalog."default",
    CONSTRAINT rol_usuario_pkey PRIMARY KEY (id)
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS asistencia.rol_usuario
    OWNER to postgres;

-- Table: asistencia.planificacion--

-- DROP TABLE IF EXISTS asistencia.planificacion;

CREATE TABLE IF NOT EXISTS asistencia.planificacion
(
    id integer NOT NULL DEFAULT nextval('asistencia.planificacion_id_seq'::regclass),
    descripcion text COLLATE pg_catalog."default" NOT NULL,
    fecha timestamp without time zone NOT NULL,
    id_usuario integer,
    CONSTRAINT planificacion_pkey PRIMARY KEY (id),
    CONSTRAINT planificacion_id_usuario_fkey FOREIGN KEY (id_usuario)
        REFERENCES asistencia.usuarios (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE SET NULL
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS asistencia.planificacion
    OWNER to postgres;

-- Table: asistencia.actividad--

-- DROP TABLE IF EXISTS asistencia.actividad;

CREATE TABLE IF NOT EXISTS asistencia.actividad
(
    id integer NOT NULL DEFAULT nextval('asistencia.actividad_id_seq'::regclass),
    nombre character varying(100) COLLATE pg_catalog."default" NOT NULL,
    descripcion text COLLATE pg_catalog."default",
    fecha timestamp without time zone NOT NULL,
    id_planificacion integer,
    CONSTRAINT actividad_pkey PRIMARY KEY (id),
    CONSTRAINT actividad_id_planificacion_fkey FOREIGN KEY (id_planificacion)
        REFERENCES asistencia.planificacion (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE SET NULL
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS asistencia.actividad
    OWNER to postgres;

-- Table: asistencia.usuarios_actividad

-- DROP TABLE IF EXISTS asistencia.usuarios_actividad;

CREATE TABLE IF NOT EXISTS asistencia.usuarios_actividad
(
    id_usuario integer NOT NULL,
    id_actividad integer NOT NULL,
    rol character varying(50) COLLATE pg_catalog."default",
    CONSTRAINT usuarios_actividad_pkey PRIMARY KEY (id_usuario, id_actividad),
    CONSTRAINT usuarios_actividad_id_actividad_fkey FOREIGN KEY (id_actividad)
        REFERENCES asistencia.actividad (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT usuarios_actividad_id_usuario_fkey FOREIGN KEY (id_usuario)
        REFERENCES asistencia.usuarios (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS asistencia.usuarios_actividad
    OWNER to postgres;

-- Table: asistencia.asistencia--

-- DROP TABLE IF EXISTS asistencia.asistencia;

CREATE TABLE IF NOT EXISTS asistencia.asistencia
(
    id integer NOT NULL DEFAULT nextval('asistencia.asistencia_id_seq'::regclass),
    id_usuario integer,
    id_actividad integer,
    presente boolean NOT NULL,
    fecha timestamp without time zone NOT NULL,
    CONSTRAINT asistencia_pkey PRIMARY KEY (id),
    CONSTRAINT asistencia_id_actividad_fkey FOREIGN KEY (id_actividad)
        REFERENCES asistencia.actividad (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION,
    CONSTRAINT asistencia_id_usuario_fkey FOREIGN KEY (id_usuario)
        REFERENCES asistencia.usuarios (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS asistencia.asistencia
    OWNER to postgres;

-- Table: asistencia.horario--

-- DROP TABLE IF EXISTS asistencia.horario;

CREATE TABLE IF NOT EXISTS asistencia.horario
(
    id integer NOT NULL DEFAULT nextval('asistencia.horario_id_seq'::regclass),
    id_usuario integer,
    dia_semana character varying(20) COLLATE pg_catalog."default" NOT NULL,
    hora_inicio time without time zone NOT NULL,
    hora_fin time without time zone NOT NULL,
    CONSTRAINT horario_pkey PRIMARY KEY (id),
    CONSTRAINT horario_id_usuario_fkey FOREIGN KEY (id_usuario)
        REFERENCES asistencia.usuarios (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS asistencia.horario
    OWNER to postgres;

-- Table: asistencia.constancia--

-- DROP TABLE IF EXISTS asistencia.constancia;

CREATE TABLE IF NOT EXISTS asistencia.constancia
(
    id integer NOT NULL DEFAULT nextval('asistencia.constancia_id_seq'::regclass),
    id_usuario integer,
    detalle text COLLATE pg_catalog."default" NOT NULL,
    fecha_emision timestamp without time zone NOT NULL,
    CONSTRAINT constancia_pkey PRIMARY KEY (id),
    CONSTRAINT constancia_id_usuario_fkey FOREIGN KEY (id_usuario)
        REFERENCES asistencia.usuarios (id) MATCH SIMPLE
        ON UPDATE NO ACTION
        ON DELETE NO ACTION
)

TABLESPACE pg_default;

ALTER TABLE IF EXISTS asistencia.constancia
    OWNER to postgres;