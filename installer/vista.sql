create view vista_auditoria as Select usr_nombre, adt_hora_trans, adt_nombre_tabla, adt_nombre_col, adt_evento, adt_valor_ant, adt_valor_nuevo from auditoria, usuario where usuario.usr_id=auditoria.usr_id;