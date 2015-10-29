<?php include 'header.php'; ?>

<table id="dg" title="Usuarios" class="easyui-datagrid" style="width:890px;height:450px"
       url="../Servlet/administrarUsuarios.php?accion=Listado"
       toolbar="#toolbar"
       rownumbers="true" fitColumns="true" singleSelect="true">
    <thead>
        <tr>
            <th field="run" width="30">Run</th>
            <th field="clave" width="60">Clave</th>
            <th field="idPerfil" width="60">id Perfil</th>
        </tr>
    </thead>
</table>


<?php include 'footer.php'; ?>