<?php include 'header.php'; ?>

<table id="dg" title="Mascotas" class="easyui-datagrid" style="width:890px;height:450px"
       url="../Servlet/administrarMascotas.php?accion=Listado"
       toolbar="#toolbar"
       rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="idMascota" width="30">Id Mascota</th>
            <th field="raza" width="60">Raza</th>
            <th field="nombre" width="60">Nombre</th>
            <th field="run" width="30">Run Dueño</th>
        </tr>
    </thead>
</table>


<?php include 'footer.php'; ?>