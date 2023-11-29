/*--------------Configuración del menú lateral---------------------------*/

document.getElementById('menu_clientes').addEventListener('click', clientesMostrar);
document.getElementById('menu_citas').addEventListener('click', citasMostrar);
document.getElementById('menu_agendar').addEventListener('click', agendarMostrar);
document.getElementById('menu_modificar').addEventListener('click', modificarMostrar);
document.getElementById('menu_eliminar').addEventListener('click', eliminarMostrar);
      
function clientesMostrar() {
    document.getElementById('clientes').style.display = 'grid';
    document.getElementById('citas').style.display = 'none';
    document.getElementById('Acitas').style.display = 'none';
    document.getElementById('Mcitas').style.display = 'none';
    document.getElementById('Ecitas').style.display = 'none';
            
    document.getElementById('menu_clientes').style.fontWeight = 600;
    document.getElementById('menu_clientes').style.borderBottom = '2px solid var(--c_terciario)';
    document.getElementById('menu_citas').style.fontWeight = 'normal';
    document.getElementById('menu_citas').style.borderBottom = 'none';
    document.getElementById('menu_agendar').style.fontWeight = 'normal';
    document.getElementById('menu_agendar').style.borderBottom = 'none';
    document.getElementById('menu_modificar').style.fontWeight = 'normal';
    document.getElementById('menu_modificar').style.borderBottom = 'none';
    document.getElementById('menu_eliminar').style.fontWeight = 'normal';
    document.getElementById('menu_eliminar').style.borderBottom = 'none';
}
function citasMostrar() {
    document.getElementById('clientes').style.display = 'none';
    document.getElementById('citas').style.display = 'grid';
    document.getElementById('Acitas').style.display = 'none';
    document.getElementById('Mcitas').style.display = 'none';
    document.getElementById('Ecitas').style.display = 'none';
            
    document.getElementById('menu_clientes').style.fontWeight = 'normal';
    document.getElementById('menu_clientes').style.borderBottom = 'none';
    document.getElementById('menu_citas').style.fontWeight = 600;
    document.getElementById('menu_citas').style.borderBottom = '2px solid var(--c_terciario)';
    document.getElementById('menu_agendar').style.fontWeight = 'normal';
    document.getElementById('menu_agendar').style.borderBottom = 'none';
    document.getElementById('menu_modificar').style.fontWeight = 'normal';
    document.getElementById('menu_modificar').style.borderBottom = 'none';
    document.getElementById('menu_eliminar').style.fontWeight = 'normal';
    document.getElementById('menu_eliminar').style.borderBottom = 'none';
}
function agendarMostrar() {
    document.getElementById('clientes').style.display = 'none';
    document.getElementById('citas').style.display = 'none';
    document.getElementById('Acitas').style.display = 'grid';
    document.getElementById('Mcitas').style.display = 'none';
    document.getElementById('Ecitas').style.display = 'none';
            
    document.getElementById('menu_clientes').style.fontWeight = 'normal';
    document.getElementById('menu_clientes').style.borderBottom = 'none';
    document.getElementById('menu_citas').style.fontWeight = 'normal';
    document.getElementById('menu_citas').style.borderBottom = 'none';
    document.getElementById('menu_agendar').style.fontWeight = 600;
    document.getElementById('menu_agendar').style.borderBottom = '2px solid var(--c_terciario)';
    document.getElementById('menu_modificar').style.fontWeight = 'normal';
    document.getElementById('menu_modificar').style.borderBottom = 'none';
    document.getElementById('menu_eliminar').style.fontWeight = 'normal';
    document.getElementById('menu_eliminar').style.borderBottom = 'none';
}
function modificarMostrar() {
    document.getElementById('clientes').style.display = 'none';
    document.getElementById('citas').style.display = 'none';
    document.getElementById('Acitas').style.display = 'none';
    document.getElementById('Mcitas').style.display = 'grid';
    document.getElementById('Ecitas').style.display = 'none';
            
    document.getElementById('menu_clientes').style.fontWeight = 'normal';
    document.getElementById('menu_clientes').style.borderBottom = 'none';
    document.getElementById('menu_citas').style.fontWeight = 'normal';
    document.getElementById('menu_citas').style.borderBottom = 'none';
    document.getElementById('menu_agendar').style.fontWeight = 'normal';
    document.getElementById('menu_agendar').style.borderBottom = 'none';
    document.getElementById('menu_modificar').style.fontWeight = 600;
    document.getElementById('menu_modificar').style.borderBottom = '2px solid var(--c_terciario)';
    document.getElementById('menu_eliminar').style.fontWeight = 'normal';
    document.getElementById('menu_eliminar').style.borderBottom = 'none';
}
function eliminarMostrar() {
    document.getElementById('clientes').style.display = 'none';
    document.getElementById('citas').style.display = 'none';
    document.getElementById('Acitas').style.display = 'none';
    document.getElementById('Mcitas').style.display = 'none';
    document.getElementById('Ecitas').style.display = 'grid';
            
    document.getElementById('menu_clientes').style.fontWeight = 'normal';
    document.getElementById('menu_clientes').style.borderBottom = 'none';
    document.getElementById('menu_citas').style.fontWeight = 'normal';
    document.getElementById('menu_citas').style.borderBottom = 'none';
    document.getElementById('menu_agendar').style.fontWeight = 'normal';
    document.getElementById('menu_agendar').style.borderBottom = 'none';
    document.getElementById('menu_modificar').style.fontWeight = 'normal';
    document.getElementById('menu_modificar').style.borderBottom = 'none';
    document.getElementById('menu_eliminar').style.fontWeight = 600;
    document.getElementById('menu_eliminar').style.borderBottom = '2px solid var(--c_terciario)';
}



/*------------------Configuración de los botones-----------------------*/

document.getElementById('agendarCi').addEventListener('click', aceptarAgenda);
document.getElementById('aceptarConfirmar').addEventListener('click', enviadoAgenda);
document.getElementById('aceptarEnviado').addEventListener('click', recargar);
document.getElementById('cancelarConfirmar').addEventListener('click', recargar);

function aceptarAgenda () {
    document.getElementById('confirmar').style.display = 'flex';
    document.getElementById('alerta_enviado').style.display = 'none';
    document.getElementById('alerta_confirmar').style.display = 'flex';
    document.getElementById('textoConfirmar').innerHTML = '¿Estás seguro que los datos ingresados son correctos?';
}
function enviadoAgenda () {
    document.getElementById('alerta_enviado').style.display = 'flex';
    document.getElementById('alerta_confirmar').style.display = 'none';
    document.getElementById('textoEnviado').innerHTML = 'Registro completado';
}
function recargar () {
    location.reload()
}

document.getElementById('modificarCi').addEventListener('click', aceptarModificar);
document.getElementById('aceptarConfirmar').addEventListener('click', enviadoModificar);

function aceptarModificar () {
    document.getElementById('confirmar').style.display = 'flex';
    document.getElementById('alerta_enviado').style.display = 'none';
    document.getElementById('alerta_confirmar').style.display = 'flex';
    document.getElementById('textoConfirmar').innerHTML = '¿Estás seguro de realizar las modificaciones?';
}
function enviadoModificar () {
    document.getElementById('alerta_enviado').style.display = 'flex';
    document.getElementById('alerta_confirmar').style.display = 'none';
    document.getElementById('textoEnviado').innerHTML = 'Cambios realizados';
}

document.getElementById('eliminarCi').addEventListener('click', eliminarModificar);
document.getElementById('aceptarConfirmar').addEventListener('click', enviadoEliminar);

function eliminarModificar () {
    document.getElementById('confirmar').style.display = 'flex';
    document.getElementById('alerta_enviado').style.display = 'none';
    document.getElementById('alerta_confirmar').style.display = 'flex';
    document.getElementById('textoConfirmar').innerHTML = '¿Estás seguro que desea eliminar la cita?';
}
function enviadoEliminar () {
    document.getElementById('alerta_enviado').style.display = 'flex';
    document.getElementById('alerta_confirmar').style.display = 'none';
    document.getElementById('textoEnviado').innerHTML = 'Cambios realizados';
}