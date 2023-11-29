/*--------------Configuración del menú lateral---------------------------*/

document.getElementById('menu_agendar').addEventListener('click', agendaMostrar);
document.getElementById('menu_modificar').addEventListener('click', modificarMostrar);
document.getElementById('menu_eliminar').addEventListener('click', eliminarMostrar);
      
function agendaMostrar() {
    document.getElementById('agenda').style.display = 'grid';
    document.getElementById('modificar').style.display = 'none';
    document.getElementById('eliminar').style.display = 'none';
            
    document.getElementById('menu_agendar').style.fontWeight = 600;
    document.getElementById('menu_agendar').style.borderBottom = '2px solid var(--c_terciario)';
    document.getElementById('menu_modificar').style.fontWeight = 'normal';
    document.getElementById('menu_modificar').style.borderBottom = 'none';
    document.getElementById('menu_eliminar').style.fontWeight = 'normal';
    document.getElementById('menu_eliminar').style.borderBottom = 'none';
}
function modificarMostrar() {
    document.getElementById('agenda').style.display = 'none';
    document.getElementById('modificar').style.display = 'grid';
    document.getElementById('eliminar').style.display = 'none';

    document.getElementById('menu_agendar').style.fontWeight = 'normal';
    document.getElementById('menu_agendar').style.borderBottom = 'none';
    document.getElementById('menu_modificar').style.fontWeight = 600;
    document.getElementById('menu_modificar').style.borderBottom = '2px solid var(--c_terciario)';
    document.getElementById('menu_eliminar').style.fontWeight = 'normal';
    document.getElementById('menu_eliminar').style.borderBottom = 'none';
}
function eliminarMostrar() {
    document.getElementById('agenda').style.display = 'none';
    document.getElementById('modificar').style.display = 'none';
    document.getElementById('eliminar').style.display = 'grid';

    document.getElementById('menu_agendar').style.fontWeight = 'normal';
    document.getElementById('menu_agendar').style.borderBottom = 'none';
    document.getElementById('menu_modificar').style.fontWeight = 'normal';
    document.getElementById('menu_modificar').style.borderBottom = 'none';
    document.getElementById('menu_eliminar').style.fontWeight = 600;
    document.getElementById('menu_eliminar').style.borderBottom = '2px solid var(--c_terciario)';
}




/*------------------Configuración de los botones-----------------------*/

document.getElementById('aceptarAgenda').addEventListener('click', aceptarAgenda);
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
    document.getElementById('textoEnviado').innerHTML = 'Cita agendada';
}
function recargar () {
    location.reload()
}

document.getElementById('aceptarModificar').addEventListener('click', aceptarModificar);
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

document.getElementById('aceptarEliminar').addEventListener('click', aceptarEliminar);
document.getElementById('aceptarConfirmar').addEventListener('click', enviadoEliminar);

function aceptarEliminar () {
    document.getElementById('confirmar').style.display = 'flex';
    document.getElementById('alerta_enviado').style.display = 'none';
    document.getElementById('alerta_confirmar').style.display = 'flex';
    document.getElementById('textoConfirmar').innerHTML = '¿Estás seguro que desea eliminar la cita?';
}
function enviadoEliminar () {
    document.getElementById('alerta_enviado').style.display = 'flex';
    document.getElementById('alerta_confirmar').style.display = 'none';
    document.getElementById('textoEnviado').innerHTML = 'Cita eliminada';
}