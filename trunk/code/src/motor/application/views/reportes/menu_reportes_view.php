<!--comunidad panel-->
<div class="admin-panel">

<!-- Obtengo todos los reportes permitidos por este usuario -->
<?php if(!empty($reportes_permitidos)): ?>



<?php else: ?>

    <div class="empty-database">
        <p>No hay reportes asignados a este usuario.</p>
    </div>

<?php endif; ?>


</div>