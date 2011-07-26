<!--se carga la lista de resultados de la busqueda de miembros en una tabla HTML-->

<?php if(empty($results)): echo "isEmpty"; return;?>

<?php endif;?>

<div class="clear"></div>
<table id="listado-miembros"  >
    <tbody>
        <tr class="header-pr-miembro">
            <td class="par-bs-nombre">Nombre</td>
            <td class="par-bs-apellido">Apellido</td>
            <td class="par-bs-docnum">Doc. Numero</td>
            <td class="par-bs-fechanac">Fecha Nacimiento</td>
        </tr>
                
        <?php  foreach ($results as $row){ ?>

            <?php echo "<tr class=\"pr-row-miembro \" onclick=\"llamar(".$row->prs_id.",'".$row->prs_nombres.", ".$row->prs_apellidos."',this )\">"  ?>
                <?php echo "<td class=\"pr-col-nombre\">".$row->prs_nombres."</td>"  ?>
                <?php echo "<td class=\"pr-col-apellido\">".$row->prs_apellidos."</td>"  ?>
                <?php echo "<td class=\"pr-col-docnum\">".$row->prs_doc_num."</td>"  ?>
                <?php echo "<td class=\"pr-col-fechanac\">".date("Y-m-d", strtotime($row->prs_fecha_nacimiento))."</td>"  ?>
            <?php echo "</tr>"  ?>
        <?php  } ?>
    </tbody>
</table>