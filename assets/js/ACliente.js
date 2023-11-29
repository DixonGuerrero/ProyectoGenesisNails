document.getElementById('actualizar').addEventListener('click', aceptarActualizar);
document.getElementById('aceptarConfirmar').addEventListener('click', enviadoActualizar);
document.getElementById('aceptarEnviado').addEventListener('click', recargar);
document.getElementById('cancelarConfirmar').addEventListener('click', recargar);

function aceptarActualizar () {
    document.getElementById('confirmar').style.display = 'flex';
    document.getElementById('alerta_enviado').style.display = 'none';
    document.getElementById('alerta_confirmar').style.display = 'flex';
    document.getElementById('textoConfirmar').innerHTML = '¿Estás seguro de realizar las modificaciones?';
}
function enviadoActualizar () {
    document.getElementById('alerta_enviado').style.display = 'flex';
    document.getElementById('alerta_confirmar').style.display = 'none';
    document.getElementById('textoEnviado').innerHTML = 'Cambios realizados';
}
function recargar () {
    location.reload()
}