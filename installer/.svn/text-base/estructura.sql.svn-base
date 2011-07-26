
CREATE TABLE aporte(
    apr_id       INT               AUTO_INCREMENT,
    mmb_id       INT               NOT NULL,
    apr_monto    DECIMAL(18, 0)    NOT NULL,
    apr_fecha    DATETIME          NOT NULL,
    PRIMARY KEY (apr_id)
)TYPE=INNODB
;




CREATE TABLE auditoria(
    adt_id              INT            AUTO_INCREMENT,
    usr_id              INT,
    adt_hora_trans      DATETIME,
    adt_nombre_tabla    VARCHAR(30)    NOT NULL,
    adt_nombre_col      VARCHAR(30)    NOT NULL,
    adt_evento          VARCHAR(20)    NOT NULL,
    adt_valor_ant       TEXT,
    adt_valor_nuevo     TEXT,
    PRIMARY KEY (adt_id)
)TYPE=INNODB
;




CREATE TABLE autoridad(
    atr_id             SMALLINT       AUTO_INCREMENT,
    prs_id             INT            NOT NULL,
    atr_cargo          VARCHAR(25)    NOT NULL,
    inicio_periodo     DATETIME       NOT NULL,
    atr_fin_periodo    DATETIME       NOT NULL,
    PRIMARY KEY (atr_id)
)TYPE=INNODB
;




CREATE TABLE comunidad(
    cmn_id        INT            AUTO_INCREMENT,
    dto_id        INT,
    pais_id       SMALLINT,
    cmn_nombre    VARCHAR(50)    NOT NULL,
    PRIMARY KEY (cmn_id)
)TYPE=INNODB
;




CREATE TABLE confesion(
    cnf_id        INT            AUTO_INCREMENT,
    cnf_nombre    VARCHAR(50)    NOT NULL,
    PRIMARY KEY (cnf_id)
)TYPE=INNODB
;




CREATE TABLE departamento(
    dto_id        INT            AUTO_INCREMENT,
    pais_id       SMALLINT       NOT NULL,
    dto_nombre    VARCHAR(50)    NOT NULL,
    PRIMARY KEY (dto_id, pais_id)
)TYPE=INNODB
;




CREATE TABLE miembro(
    mmb_id               INT         NOT NULL,
    mmb_miembro_desde    DATETIME    NOT NULL,
    PRIMARY KEY (mmb_id)
)TYPE=INNODB
;




CREATE TABLE pais(
    pais_id        SMALLINT       AUTO_INCREMENT,
    pais_nombre    VARCHAR(50)    NOT NULL,
    PRIMARY KEY (pais_id)
)TYPE=INNODB
;




CREATE TABLE parametro(
    par_id              SMALLINT       AUTO_INCREMENT,
    par_congregacion    VARCHAR(50)    NOT NULL,
    par_ruc             VARCHAR(15),
    par_direccion       VARCHAR(50),
    par_telefono        VARCHAR(20),
    par_membrete        LONGBLOB,
    par_descripcion     VARCHAR(50),
    PRIMARY KEY (par_id)
)TYPE=INNODB
;




CREATE TABLE permiso(
    prm_id                    SMALLINT       AUTO_INCREMENT,
    prm_nombre                VARCHAR(50)    NOT NULL,
    prm_controller_funcion    VARCHAR(40),
    prm_modulo                VARCHAR(40),
    prm_controller            VARCHAR(40),
    PRIMARY KEY (prm_id)
)TYPE=INNODB
;




CREATE TABLE permiso_x_rol(
    rol_id    SMALLINT    NOT NULL,
    prm_id    SMALLINT    NOT NULL,
    PRIMARY KEY (rol_id, prm_id)
)TYPE=INNODB
;




CREATE TABLE persona(
    prs_id                  INT             AUTO_INCREMENT,
    prs_apellidos           VARCHAR(50)     NOT NULL,
    prs_nombres             VARCHAR(50)     NOT NULL,
    prs_doc_num             INT,
    prs_direccion           VARCHAR(50)     NOT NULL,
    prs_telefono            VARCHAR(20)     NOT NULL,
    prs_email               VARCHAR(30),
    prs_sexo                CHAR(1)         NOT NULL,
    prs_fecha_nacimiento    DATETIME        NOT NULL,
    prs_lugar_nacimiento    VARCHAR(50)     NOT NULL,
    prs_bautizado           CHAR(1)         NOT NULL,
    prs_bautismo            DATETIME        NOT NULL,
    prs_lugar_bautismo      VARCHAR(50)     NOT NULL,
    prs_confirmado          CHAR(1)         NOT NULL,
    prs_defunsion           DATETIME,
    prs_lugar_sepultado     VARCHAR(50),
    prs_casado              CHAR(1)         NOT NULL,
    prs_observacion         VARCHAR(100),
    cnf_id                  INT             NOT NULL,
    cmn_id                  INT             NOT NULL,
    prs_estado              CHAR(1),
    PRIMARY KEY (prs_id)
)TYPE=INNODB
;




CREATE TABLE persona_relacion(
    prs_id    INT         NOT NULL,
    mmb_id    INT         NOT NULL,
    rlc_id    SMALLINT    NOT NULL,
    PRIMARY KEY (prs_id, mmb_id)
)TYPE=INNODB
;




CREATE TABLE rol(
    rol_id        SMALLINT       AUTO_INCREMENT,
    rol_nombre    VARCHAR(50)    NOT NULL,
    PRIMARY KEY (rol_id)
)TYPE=INNODB
;




CREATE TABLE tipo_relacion(
    rlc_id      SMALLINT       AUTO_INCREMENT,
    rlc_tipo    VARCHAR(30)    NOT NULL,
    PRIMARY KEY (rlc_id)
)TYPE=INNODB
;




CREATE TABLE usuario(
    usr_id                INT            AUTO_INCREMENT,
    prs_id                INT            NOT NULL,
    rol_id                SMALLINT       NOT NULL,
    usr_contrasena        VARCHAR(32)    NOT NULL,
    usr_nombre            VARCHAR(30)    NOT NULL,
    usr_super             CHAR(1)        NOT NULL,
    usr_fecha_registro    DATETIME       NOT NULL,
    usr_ultimo_login      DATETIME       NOT NULL,
    PRIMARY KEY (usr_id)
)TYPE=INNODB
;




CREATE INDEX Ref222 ON aporte(mmb_id)
;

CREATE INDEX Ref913 ON auditoria(usr_id)
;

CREATE INDEX Ref121 ON autoridad(prs_id)
;

CREATE INDEX Ref2128 ON comunidad(pais_id, dto_id)
;

CREATE INDEX Ref2027 ON departamento(pais_id)
;

CREATE INDEX Ref11 ON miembro(mmb_id)
;

CREATE INDEX Ref1318 ON permiso_x_rol(prm_id)
;

CREATE INDEX Ref1419 ON permiso_x_rol(rol_id)
;

CREATE INDEX Ref410 ON persona(cnf_id)
;

CREATE INDEX Ref811 ON persona(cmn_id)
;

CREATE INDEX Ref114 ON persona_relacion(prs_id)
;

CREATE INDEX Ref225 ON persona_relacion(mmb_id)
;

CREATE INDEX Ref1226 ON persona_relacion(rlc_id)
;

CREATE INDEX Ref112 ON usuario(prs_id)
;

CREATE INDEX Ref1420 ON usuario(rol_id)
;

ALTER TABLE aporte ADD CONSTRAINT Refmiembro22 
    FOREIGN KEY (mmb_id)
    REFERENCES miembro(mmb_id)
;



ALTER TABLE auditoria ADD CONSTRAINT Refusuario13 
    FOREIGN KEY (usr_id)
    REFERENCES usuario(usr_id)
;



ALTER TABLE autoridad ADD CONSTRAINT Refpersona21 
    FOREIGN KEY (prs_id)
    REFERENCES persona(prs_id)
;



ALTER TABLE comunidad ADD CONSTRAINT Refdepartamento28 
    FOREIGN KEY (dto_id, pais_id)
    REFERENCES departamento(dto_id, pais_id)
;


ALTER TABLE departamento ADD CONSTRAINT Refpais27 
    FOREIGN KEY (pais_id)
    REFERENCES pais(pais_id)
;



ALTER TABLE miembro ADD CONSTRAINT Refpersona1 
    FOREIGN KEY (mmb_id)
    REFERENCES persona(prs_id)
;



ALTER TABLE permiso_x_rol ADD CONSTRAINT Refpermiso18 
    FOREIGN KEY (prm_id)
    REFERENCES permiso(prm_id)
;

ALTER TABLE permiso_x_rol ADD CONSTRAINT Refrol19 
    FOREIGN KEY (rol_id)
    REFERENCES rol(rol_id)
;



ALTER TABLE persona ADD CONSTRAINT Refconfesion10 
    FOREIGN KEY (cnf_id)
    REFERENCES confesion(cnf_id)
;

ALTER TABLE persona ADD CONSTRAINT Refcomunidad11 
    FOREIGN KEY (cmn_id)
    REFERENCES comunidad(cmn_id)
;



ALTER TABLE persona_relacion ADD CONSTRAINT Refpersona14 
    FOREIGN KEY (prs_id)
    REFERENCES persona(prs_id)
;

ALTER TABLE persona_relacion ADD CONSTRAINT Refmiembro25 
    FOREIGN KEY (mmb_id)
    REFERENCES miembro(mmb_id)
;

ALTER TABLE persona_relacion ADD CONSTRAINT Reftipo_relacion26 
    FOREIGN KEY (rlc_id)
    REFERENCES tipo_relacion(rlc_id)
;



ALTER TABLE usuario ADD CONSTRAINT Refpersona12 
    FOREIGN KEY (prs_id)
    REFERENCES persona(prs_id)
;

ALTER TABLE usuario ADD CONSTRAINT Refrol20 
    FOREIGN KEY (rol_id)
    REFERENCES rol(rol_id)
;


