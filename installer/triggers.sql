--
-- Cambiamos el Delimitdor
--
DELIMITER //
--/***************************** TABLA APORTE ***********************************************/
--
-- Trigger Insert
--
CREATE TRIGGER audit_ins_aporte AFTER INSERT ON aporte FOR EACH ROW 
BEGIN
-- campo apr_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'apr_id', 'insert', NULL, NEW.apr_id);
-- campo mmb_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'mmb_id', 'insert', NULL, NEW.mmb_id );
-- campo apr_monto
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'apr_monto', 'insert', NULL, NEW.apr_monto);
-- campo apr_fecha
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'apr_fecha', 'insert', NULL, NEW.apr_fecha);
END//

--
-- Trigger Update
--
CREATE TRIGGER audit_upd_aporte BEFORE UPDATE ON aporte FOR EACH ROW 
BEGIN
-- campo apr_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'apr_id', 'update', OLD.apr_id, NEW.apr_id);
-- campo mmb_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'mmb_id', 'update', OLD.mmb_id, NEW.mmb_id );
-- campo apr_monto
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'apr_monto', 'update', OLD.apr_fecha, NEW.apr_monto);
-- campo apr_fecha
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'apr_fecha', 'update', OLD.apr_fecha, NEW.apr_fecha);
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_aporte BEFORE DELETE ON aporte FOR EACH ROW 
BEGIN
-- campo apr_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'apr_id', 'delete', OLD.apr_id, NULL);
-- campo mmb_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'mmb_id', 'delete', OLD.mmb_id, NULL );
-- campo apr_monto
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'apr_monto', 'delete', OLD.apr_monto, NULL);
-- campo apr_fecha
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'aporte', 'apr_fecha', 'delete', OLD.apr_fecha, NULL);
END//

--/***************************** TABLA AUTORIDAD ***********************************************/
--
-- Trigger Insert
--
CREATE TRIGGER audit_ins_autoridad AFTER INSERT ON autoridad FOR EACH ROW 
BEGIN
-- campo atr_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_id', 'insert', NULL, NEW.atr_id);
-- campo prs_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'prs_id', 'insert', NULL, NEW.prs_id );
-- campo atr_cargo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_cargo', 'insert', NULL, NEW.atr_cargo);
-- campo atr_cargo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_inicio_periodo', 'delete', NULL, NEW.atr_inicio_periodo);
-- campo atr_cargo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_fin_periodo', 'delete', NULL, NEW.atr_fin_periodo);
END//

--
-- Trigger Update
--
CREATE TRIGGER audit_upd_autoridad BEFORE UPDATE ON autoridad FOR EACH ROW 
BEGIN
-- campo atr_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_id', 'update', OLD.atr_id, NEW.atr_id);
-- campo prs_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'prs_id', 'update', OLD.prs_id, NEW.prs_id );
-- campo atr_cargo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_rcargo', 'update', OLD.atr_cargo, NEW.atr_cargo);
-- campo atr_cargo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_inicio_periodo', 'delete', OLD.atr_inicio_periodo, NEW.atr_inicio_periodo);
-- campo atr_cargo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_fin_periodo', 'delete', OLD.atr_fin_periodo, NEW.atr_fin_periodo);
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_autoridad BEFORE DELETE ON autoridad FOR EACH ROW 
BEGIN
-- campo atr_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_id', 'delete', OLD.atr_id, NULL);
-- campo prs_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'prs_id', 'delete', OLD.prs_id, NULL );
-- campo atr_cargo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_cargo', 'delete', OLD.atr_cargo, NULL);
-- campo atr_cargo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_inicio_periodo', 'delete', OLD.atr_inicio_periodo, NULL);
-- campo atr_cargo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'autoridad', 'atr_fin_periodo', 'delete', OLD.atr_fin_periodo, NULL);
END//


--/***************************** TABLA COMUNIDAD ***********************************************/
--
-- Trigger Insert
--
CREATE TRIGGER audit_ins_comunidad AFTER INSERT ON comunidad FOR EACH ROW 
BEGIN
-- campo cmn_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'comunidad', 'cmn_id', 'insert', NULL, NEW.cmn_id);
-- campo cmn_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'comunidad', 'cmn_nombre', 'insert', NULL, NEW.cmn_nombre );
END//

--
-- Trigger Update
--
CREATE TRIGGER audit_upd_comunidad BEFORE UPDATE ON comunidad FOR EACH ROW 
BEGIN
-- campo cmn_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'comunidad', 'cmn_id', 'update', OLD.cmn_id, NEW.cmn_id);
-- campo cmn_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'comunidad', 'cmn_nombre', 'update', OLD.cmn_nombre, NEW.cmn_nombre );
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_comunidad BEFORE DELETE ON comunidad FOR EACH ROW 
BEGIN
-- campo cmn_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'comunidad', 'cmn_id', 'delete', OLD.cmn_id, NULL);
-- campo cmn_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'comunidad', 'cmn_nombre', 'delete', OLD.cmn_nombre, NULL);
END//


--/***************************** TABLA CONFESION ***********************************************/
--
-- Trigger Insert
--
CREATE TRIGGER audit_ins_confesion AFTER INSERT ON confesion FOR EACH ROW 
BEGIN
-- campo cnf_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'confesion', 'cnf_id', 'insert', NULL, NEW.cnf_id);
-- campo cnf_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'confesion', 'cnf_nombre', 'insert', NULL, NEW.cnf_nombre );
END//

--
-- Trigger Update
--
CREATE TRIGGER audit_upd_confesion BEFORE UPDATE ON confesion FOR EACH ROW 
BEGIN
-- campo cnf_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'confesion', 'cnf_id', 'update', OLD.cnf_id, NEW.cnf_id);
-- campo cnf_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'confesion', 'cnf_nombre', 'update', OLD.cnf_nombre, NEW.cnf_nombre );
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_confesion BEFORE DELETE ON confesion FOR EACH ROW 
BEGIN
-- campo cnf_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'confesion', 'cnf_id', 'delete', OLD.cnf_id, NULL);
-- campo cnf_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'confesion', 'cnf_nombre', 'delete', OLD.cnf_nombre, NULL );
END//

--/***************************** TABLA MIEMBRO ***********************************************/
--
-- Trigger Insert
--
CREATE TRIGGER audit_ins_miembro AFTER INSERT ON miembro FOR EACH ROW 
BEGIN
-- campo mmb_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'miembro', 'mmb_id', 'insert', NULL, NEW.mmb_id);
-- campo mmb_miembro_desde
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'miembro', 'mmb_miembro_desde', 'insert', NULL, NEW.mmb_miembro_desde );
END//

--
-- Trigger Update
--
CREATE TRIGGER audit_upd_miembro BEFORE UPDATE ON miembro FOR EACH ROW 
BEGIN
-- campo cnf_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'miembro', 'mmb_id', 'update', OLD.mmb_id, NEW.mmb_id);
-- campo mmb_miembro_desde
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'miembro', 'mmb_miembro_desde', 'update', OLD.mmb_miembro_desde, NEW.mmb_miembro_desde );
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_miembro BEFORE DELETE ON miembro FOR EACH ROW 
BEGIN
-- campo mmb_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'miembro', 'mmb_id', 'delete', OLD.mmb_id, NULL);
-- campo mmb_miembro_desde
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'miembro', 'mmb_miembro_desde', 'delete', OLD.mmb_miembro_desde, NULL );
END//




--/***************************** TABLA PARAMETRO ***********************************************/
--
-- Trigger Insert
--
CREATE TRIGGER audit_ins_parametro AFTER INSERT ON parametro FOR EACH ROW 
BEGIN
-- campo par_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'parametro', 'par_id', 'insert', NULL, NEW.par_id);
-- campo par_membrete
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'parametro', 'par_membrete', 'insert', NULL, NEW.par_membrete );
-- campo par_descripcion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'parametro', 'par_descripcion', 'insert', NULL, NEW.par_descripcion );
END//

--
-- Trigger Update
--
CREATE TRIGGER audit_upd_parametro BEFORE UPDATE ON parametro FOR EACH ROW 
BEGIN
-- campo par_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'parametro', 'par_id', 'update', OLD.par_id, NEW.par_id);
-- campo par_membrete
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'parametro', 'par_membrete', 'update', OLD.par_membrete, NEW.par_membrete );
-- campo par_descripcion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'parametro', 'par_descripcion', 'update', OLD.par_descripcion, NEW.par_descripcion );
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_parametro BEFORE DELETE ON parametro FOR EACH ROW 
BEGIN
-- campo par_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'parametro', 'par_id', 'delete', OLD.par_id, NULL);
-- campo par_membrete
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'parametro', 'par_membrete', 'delete', OLD.par_membrete, NULL );
-- campo par_descripcion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'parametro', 'par_descripcion', 'delete', OLD.par_descripcion,NULL );
END//

--/***************************** TABLA PERMISO ***********************************************/
--
-- Trigger Insert
--
CREATE TRIGGER audit_ins_permiso AFTER INSERT ON permiso FOR EACH ROW 
BEGIN
-- campo prm_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso', 'prm_id', 'insert', NULL, NEW.prm_id);
-- campo prm_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso', 'prm_nombre', 'insert', NULL, NEW.prm_nombre );
END//

--
-- Trigger Update
--
CREATE TRIGGER audit_upd_permiso BEFORE UPDATE ON permiso FOR EACH ROW 
BEGIN
-- campo prm_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso', 'prm_id', 'update', OLD.prm_id, NEW.prm_id);
-- campo prm_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso', 'prm_nombre', 'update', OLD.prm_nombre, NEW.prm_nombre );
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_permiso BEFORE DELETE ON permiso FOR EACH ROW 
BEGIN
-- campo prm_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso', 'prm_id', 'delete', OLD.prm_id, NULL);
-- campo prm_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso', 'prm_nombre', 'delete', OLD.prm_nombre, NULL);
END//


--/***************************** TABLA PERMISO_X_ROL ***********************************************/
--
-- Trigger Insert
--
CREATE TRIGGER audit_ins_permiso_x_rol AFTER INSERT ON permiso_x_rol FOR EACH ROW 
BEGIN
-- campo rol_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso_x_rol', 'rol_id', 'insert', NULL, NEW.rol_id);
-- campo prm_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso_x_rol', 'prm_id', 'insert', NULL, NEW.prm_id);
END//

--
-- Trigger Update
--
CREATE TRIGGER audit_upd_permiso_x_rol BEFORE UPDATE ON permiso_x_rol FOR EACH ROW 
BEGIN
-- campo rol_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso_x_rol', 'rol_id', 'update', OLD.rol_id, NEW.rol_id);
-- campo prm_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso_x_rol', 'prm_id', 'update', OLD.prm_id, NEW.prm_id);
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_permiso_x_rol BEFORE DELETE ON permiso_x_rol FOR EACH ROW 
BEGIN
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso_x_rol', 'rol_id', 'delete', OLD.rol_id, NULL);
-- campo rlc_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'permiso_x_rol', 'prm_id', 'delete', OLD.prm_id, NULL );
END//

--/***************************** TABLA PERSONA ***********************************************/
--
-- Trigger Insert
--
CREATE TRIGGER audit_ins_persona AFTER INSERT ON persona FOR EACH ROW
BEGIN
-- campo prs_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_id', 'insert', NULL, NEW.prs_id);
-- campo prs_apellidos
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_apellidos', 'insert', NULL, NEW.prs_apellidos );
-- campo prs_nombres
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_nombres', 'insert', NULL, NEW.prs_nombres);
-- campo prs_doc_num
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_doc_num', 'insert', NULL, NEW.prs_doc_num);
-- campo prs_direccion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_direccion', 'insert', NULL, NEW.prs_direccion);
-- campo prs_telefono
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_telefono', 'insert', NULL, NEW.prs_telefono);
-- campo prs_email
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_email', 'insert', NULL, NEW.prs_email);
-- campo prs_sexo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_sexo', 'insert', NULL, NEW.prs_sexo);
-- campo prs_fecha_nacimiento
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_fecha_nacimiento', 'insert', NULL, NEW.prs_fecha_nacimiento);
-- campo prs_lugar_nacimiento
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_lugar_nacimiento', 'insert', NULL, NEW.prs_lugar_nacimiento);
-- campo prs_bautizado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_bautizado', 'insert', NULL, NEW.prs_bautizado);
-- campo prs_bautismo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_bautismo', 'insert', NULL, NEW.prs_bautismo);
-- campo prs_lugar_bautismo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_lugar_bautismo', 'insert', NULL, NEW.prs_lugar_bautismo);
-- campo prs_confirmado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_confirmado', 'insert', NULL, NEW.prs_confirmado);
-- campo prs_defunsion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_defunsion', 'insert', NULL, NEW.prs_defunsion);
-- campo prs_lugar_sepultado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_lugar_sepultado', 'insert', NULL, NEW.prs_lugar_sepultado);
-- campo prs_casado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_casado', 'insert', NULL, NEW.prs_casado);
-- campo prs_observacion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_observacion', 'insert', NULL, NEW.prs_observacion);
-- campo cnf_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'cnf_id', 'insert', NULL, NEW.cnf_id);
-- campo cmn_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'cmn_id', 'insert', NULL, NEW.cmn_id);
END//
--
-- Trigger Update
--
CREATE TRIGGER audit_upd_persona BEFORE UPDATE ON persona FOR EACH ROW 
BEGIN
-- campo prs_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_id', 'update', OLD.prs_id, NEW.prs_id);
-- campo prs_apellidos
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_apellidos', 'update', OLD.prs_apellidos, NEW.prs_apellidos );
-- campo prs_nombres
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_nombres', 'update', OLD.prs_nombres, NEW.prs_nombres);
-- campo prs_doc_num
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_doc_num', 'update', OLD.prs_doc_num, NEW.prs_doc_num);
-- campo prs_direccion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_direccion', 'update', OLD.prs_direccion, NEW.prs_direccion);
-- campo prs_telefono
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_telefono', 'update', OLD.prs_telefono, NEW.prs_telefono);
-- campo prs_email
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_email', 'update', OLD.prs_email, NEW.prs_email);
-- campo prs_sexo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_sexo', 'update', OLD.prs_sexo, NEW.prs_sexo);
-- campo prs_fecha_nacimiento
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_fecha_nacimiento', 'update', OLD.prs_fecha_nacimiento, NEW.prs_fecha_nacimiento);
-- campo prs_lugar_nacimiento
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_lugar_nacimiento', 'update', OLD.prs_lugar_nacimiento, NEW.prs_lugar_nacimiento);
-- campo prs_bautizado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_bautizado', 'update', OLD.prs_bautizado, NEW.prs_bautizado);
-- campo prs_bautismo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_bautismo', 'update', OLD.prs_bautismo, NEW.prs_bautismo);
-- campo prs_lugar_bautismo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_lugar_bautismo', 'update', OLD.prs_lugar_bautismo, NEW.prs_lugar_bautismo);
-- campo prs_confirmado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_confirmado', 'update', OLD.prs_confirmado, NEW.prs_confirmado);
-- campo prs_defunsion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_defunsion', 'update', OLD.prs_defunsion, NEW.prs_defunsion);
-- campo prs_lugar_sepultado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_lugar_sepultado', 'update', OLD.prs_lugar_sepultado, NEW.prs_lugar_sepultado);
-- campo prs_casado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_casado', 'update', OLD.prs_casado, NEW.prs_casado);
-- campo prs_observacion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_observacion', 'update', OLD.prs_observacion, NEW.prs_observacion);
-- campo cnf_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'cnf_id', 'update', OLD.cnf_id, NEW.cnf_id);
-- campo cmn_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'cmn_id', 'update', OLD.cmn_id, NEW.cmn_id);
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_persona BEFORE DELETE ON persona FOR EACH ROW 
BEGIN
-- campo prs_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_id', 'delete', OLD.prs_id, NULL);
-- campo prs_apellidos
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_apellidos', 'delete', OLD.prs_apellidos, NULL);
-- campo prs_nombres
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_nombres', 'delete', OLD.prs_nombres, NULL);
-- campo prs_doc_num
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_doc_num', 'delete', OLD.prs_doc_num, NULL);
-- campo prs_direccion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_direccion', 'delete', OLD.prs_direccion, NULL);
-- campo prs_telefono
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_telefono', 'delete', OLD.prs_telefono, NULL);
-- campo prs_email
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_email', 'delete', OLD.prs_email, NULL);
-- campo prs_sexo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_sexo', 'delete', OLD.prs_sexo, NULL);
-- campo prs_fecha_nacimiento
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_fecha_nacimiento', 'delete', OLD.prs_fecha_nacimiento, NULL);
-- campo prs_lugar_nacimiento
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_lugar_nacimiento', 'delete', OLD.prs_lugar_nacimiento, NULL);
-- campo prs_bautizado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_bautizado', 'delete', OLD.prs_bautizado, NULL);
-- campo prs_bautismo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_bautismo', 'delete', OLD.prs_bautismo, NULL);
-- campo prs_lugar_bautismo
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_lugar_bautismo', 'delete', OLD.prs_lugar_bautismo, NULL);
-- campo prs_confirmado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_confirmado', 'delete', OLD.prs_confirmado, NULL);
-- campo prs_defunsion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_defunsion', 'delete', OLD.prs_defunsion, NULL);
-- campo prs_lugar_sepultado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_lugar_sepultado', 'delete', OLD.prs_lugar_sepultado, NULL);
-- campo prs_casado
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_casado', 'delete', OLD.prs_casado, NULL);
-- campo prs_observacion
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'prs_observacion', 'delete', OLD.prs_observacion, NULL);
-- campo cnf_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'cnf_id', 'delete', OLD.cnf_id, NULL);
-- campo cmn_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona', 'cmn_id', 'delete', OLD.cmn_id, NULL);
END//


--/***************************** TABLA PERSONA_RELACION ***********************************************/
--
-- Trigger Insert 
--
CREATE TRIGGER audit_ins_persona_relacion AFTER INSERT ON persona_relacion FOR EACH ROW 
BEGIN
-- campo rlc_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona_relacion', 'rlc_id', 'insert', NULL, NEW.rlc_id);
-- campo prs_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona_relacion', 'prs_id', 'insert', NULL, NEW.prs_id);
-- campo mmb_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona_relacion', 'mmb_id', 'insert', NULL, NEW.mmb_id);
END//
--
-- Trigger Update
--
CREATE TRIGGER audit_upd_persona_relacion BEFORE UPDATE ON persona_relacion FOR EACH ROW 
BEGIN
-- campo rlc_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona_relacion', 'rlc_id', 'update', OLD.rlc_id, NEW.rlc_id);
-- campo prs_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona_relacion', 'prs_id', 'update', OLD.prs_id, NEW.prs_id);
-- campo mmb_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona_relacion', 'mmb_id', 'update', OLD.mmb_id, NEW.rlc_id);
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_persona_relacion BEFORE DELETE ON persona_relacion FOR EACH ROW 
BEGIN
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona_relacion', 'rlc_id', 'delete', OLD.rlc_id, NULL);
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona_relacion', 'prs_id', 'delete', OLD.prs_id, NULL);
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'persona_relacion', 'mmb_id', 'delete', OLD.mmb_id, NULL);
END//

--/***************************** TABLA ROL ***********************************************/
--
-- Trigger Insert 
--
CREATE TRIGGER audit_ins_rol AFTER INSERT ON rol FOR EACH ROW 
BEGIN
-- campo rol_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'rol', 'rol_id', 'insert', NULL, NEW.rol_id);
-- campo rol_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'rol', 'rol_nombre', 'insert', NULL, NEW.rol_nombre );
END//

--
-- Trigger Update
--
CREATE TRIGGER audit_upd_rol BEFORE UPDATE ON rol FOR EACH ROW 
BEGIN
-- campo rol_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'rol', 'rol_id', 'update', OLD.rol_id, NEW.rol_id);
-- campo rol_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'rol', 'rol_nombre', 'update', OLD.rol_nombre, NEW.rol_nombre );
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_rol BEFORE DELETE ON rol FOR EACH ROW 
BEGIN
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'rol', 'rol_id', 'delete', OLD.rol_id, NULL);
-- campo rlc_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'rol', 'rol_nombre', 'delete', OLD.rol_nombre, NULL );
END//


--/***************************** TABLA USUARIO ***********************************************/
--
-- Trigger Insert
--
CREATE TRIGGER audit_ins_usuario AFTER INSERT ON usuario FOR EACH ROW 
BEGIN
-- campo usr_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_id', 'insert', NULL, NEW.usr_id);
-- campo prs_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'prs_id', 'insert', NULL, NEW.prs_id );
-- campo rol_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'rol_id', 'insert', NULL, NEW.rol_id);
-- campo usr_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_nombre', 'insert', NULL, NEW.usr_nombre);
-- campo usr_contrasena
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_contrasena', 'insert', NULL, NEW.usr_contrasena);
-- campo usr_super
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_super', 'insert', NULL, NEW.usr_super);
-- campo usr_fecha_registro
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_fecha_registro', 'insert', NULL, NEW.usr_fecha_registro);
-- campo usr_ultimo_login
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_ultimo_login', 'insert', NULL, NEW.usr_ultimo_login);
END//
--
-- Trigger Update
--
CREATE TRIGGER audit_upd_usuario BEFORE UPDATE ON usuario FOR EACH ROW 
BEGIN
-- campo usr_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_id', 'update', OLD.usr_id, NEW.usr_id);
-- campo prs_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'prs_id', 'update', OLD.prs_id, NEW.prs_id );
-- campo rol_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'rol_id', 'update', OLD.rol_id, NEW.rol_id);
-- campo usr_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_nombre', 'update', OLD.usr_nombre, NEW.usr_nombre);
-- campo usr_contrasena
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_contrasena', 'update', OLD.usr_contrasena, NEW.usr_contrasena);
-- campo usr_super
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_super', 'update', OLD.usr_super, NEW.usr_super);
-- campo usr_fecha_registro
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_fecha_registro', 'update', OLD.usr_fecha_registro, NEW.usr_fecha_registro);
-- campo usr_ultimo_login
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_ultimo_login', 'update', OLD.usr_ultimo_login, NEW.usr_ultimo_login);
END//

--
-- Trigger Delete
--
CREATE TRIGGER audit_del_usuario BEFORE DELETE ON usuario FOR EACH ROW 
BEGIN
-- campo usr_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_id', 'delete', OLD.usr_id, NULL);
-- campo prs_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'prs_id', 'delete', OLD.prs_id, NULL);
-- campo rol_id
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'rol_id', 'delete', OLD.rol_id, NULL);
-- campo usr_nombre
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_nombre', 'delete', OLD.usr_nombre, NULL);
-- campo usr_contrasena
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_contrasena', 'delete', OLD.usr_contrasena, NULL);
-- campo usr_super
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_super', 'delete', OLD.usr_super, NULL);
-- campo usr_fecha_registro
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_fecha_registro', 'delete', OLD.usr_fecha_registro, NULL);
-- campo usr_ultimo_login
INSERT INTO auditoria (adt_id, usr_id, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo )
VALUES ( NULL ,NULL , NULL , 'usuario', 'usr_ultimo_login', 'delete', OLD.usr_ultimo_login, NULL);
END//

