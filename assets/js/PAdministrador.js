/*--------------Configuración del menú lateral---------------------------*/

document.getElementById('menu_consultar').addEventListener('click', consultarMostrar);
document.getElementById('menu_prodprov').addEventListener('click', prodprovMostrar);
document.getElementById('menu_entsal').addEventListener('click', entsalMostrar);
      
function consultarMostrar() {
    document.getElementById('consultas').style.display = 'grid';
    document.getElementById('prodprov').style.display = 'none';
    document.getElementById('entsal').style.display = 'none';
            
    document.getElementById('menu_consultar').style.fontWeight = 600;
    document.getElementById('menu_consultar').style.borderBottom = '2px solid var(--c_terciario)';
    document.getElementById('menu_prodprov').style.fontWeight = 'normal';
    document.getElementById('menu_prodprov').style.borderBottom = 'none';
    document.getElementById('menu_entsal').style.fontWeight = 'normal';
    document.getElementById('menu_entsal').style.borderBottom = 'none';
}
function prodprovMostrar() {
    document.getElementById('consultas').style.display = 'none';
    document.getElementById('prodprov').style.display = 'grid';
    document.getElementById('entsal').style.display = 'none';

    document.getElementById('menu_consultar').style.fontWeight = 'normal';
    document.getElementById('menu_consultar').style.borderBottom = 'none';
    document.getElementById('menu_prodprov').style.fontWeight = 600;
    document.getElementById('menu_prodprov').style.borderBottom = '2px solid var(--c_terciario)';
    document.getElementById('menu_entsal').style.fontWeight = 'normal';
    document.getElementById('menu_entsal').style.borderBottom = 'none';
}
function entsalMostrar() {
    document.getElementById('consultas').style.display = 'none';
    document.getElementById('prodprov').style.display = 'none';
    document.getElementById('entsal').style.display = 'grid';

    document.getElementById('menu_consultar').style.fontWeight = 'normal';
    document.getElementById('menu_consultar').style.borderBottom = 'none';
    document.getElementById('menu_prodprov').style.fontWeight = 'normal';
    document.getElementById('menu_prodprov').style.borderBottom = 'none';
    document.getElementById('menu_entsal').style.fontWeight = 600;
    document.getElementById('menu_entsal').style.borderBottom = '2px solid var(--c_terciario)';
}




/*------------------Configuración de los botones-----------------------*/

document.getElementById('registrarPro').addEventListener('click', aceptarRegistro);
document.getElementById('aceptarConfirmar').addEventListener('click', enviadoRegistro);
document.getElementById('aceptarEnviado').addEventListener('click', recargar);
document.getElementById('cancelarConfirmar').addEventListener('click', recargar);

function aceptarRegistro () {
    document.getElementById('confirmar').style.display = 'flex';
    document.getElementById('alerta_enviado').style.display = 'none';
    document.getElementById('alerta_confirmar').style.display = 'flex';
    document.getElementById('textoConfirmar').innerHTML = '¿Estás seguro que los datos ingresados son correctos?';
}
function enviadoRegistro () {
    document.getElementById('alerta_enviado').style.display = 'flex';
    document.getElementById('alerta_confirmar').style.display = 'none';
    document.getElementById('textoEnviado').innerHTML = 'Registro completado';
}
function recargar () {
    location.reload()
}

document.getElementById('registrarEnt').addEventListener('click', aceptarEntsal);
document.getElementById('aceptarConfirmar').addEventListener('click', enviadoEntsal);

function aceptarEntsal () {
    document.getElementById('confirmar').style.display = 'flex';
    document.getElementById('alerta_enviado').style.display = 'none';
    document.getElementById('alerta_confirmar').style.display = 'flex';
    document.getElementById('textoConfirmar').innerHTML = '¿Estás seguro que los datos ingresados son correctos?';
}
function enviadoEntsal () {
    document.getElementById('alerta_enviado').style.display = 'flex';
    document.getElementById('alerta_confirmar').style.display = 'none';
    document.getElementById('textoEnviado').innerHTML = 'Registro completado';
}


/*-------------------------Configuracion de los menus Select-----------------*/

document.getElementById('ConsultaMenu').addEventListener('change', function () {
    let valor = this.value;
    switch (valor) {
        case '0':
            document.getElementById('CProductos').style.display = 'none';
            document.getElementById('CProveedor').style.display = 'none';
            document.getElementById('CEntrada').style.display = 'none';
            document.getElementById('CSalida').style.display = 'none';
            break;
        case '1':
            document.getElementById('CProductos').style.display = 'flex';
            document.getElementById('CProveedor').style.display = 'none';
            document.getElementById('CEntrada').style.display = 'none';
            document.getElementById('CSalida').style.display = 'none';
            break;
        case '2':
            document.getElementById('CProductos').style.display = 'none';
            document.getElementById('CProveedor').style.display = 'flex';
            document.getElementById('CEntrada').style.display = 'none';
            document.getElementById('CSalida').style.display = 'none';
            break;
        case '3':
            document.getElementById('CProductos').style.display = 'none';
            document.getElementById('CProveedor').style.display = 'none';
            document.getElementById('CEntrada').style.display = 'flex';
            document.getElementById('CSalida').style.display = 'none';
            break;
        case '4':
            document.getElementById('CProductos').style.display = 'none';
            document.getElementById('CProveedor').style.display = 'none';
            document.getElementById('CEntrada').style.display = 'none';
            document.getElementById('CSalida').style.display = 'flex';
            break;
    }
});

document.getElementById('ProductosMenu').addEventListener('change', function () {
    let valor = this.value;
    switch (valor) {
        case "0":
            document.getElementById('RProducto').style.display = 'none';
            document.getElementById('RProveedor').style.display = 'none';
            document.getElementById('MProducto').style.display = 'none';
            document.getElementById('MProveedor').style.display = 'none';
            break;
        case "1":
            document.getElementById('RProducto').style.display = 'flex';
            document.getElementById('RProveedor').style.display = 'none';
            document.getElementById('MProducto').style.display = 'none';
            document.getElementById('MProveedor').style.display = 'none';      
            break;
        case "2":
            document.getElementById('RProducto').style.display = 'none';
            document.getElementById('RProveedor').style.display = 'flex';
            document.getElementById('MProducto').style.display = 'none';
            document.getElementById('MProveedor').style.display = 'none';
            break;
        case "3":
            document.getElementById('RProducto').style.display = 'none';
            document.getElementById('RProveedor').style.display = 'none';
            document.getElementById('MProducto').style.display = 'flex';
            document.getElementById('MProveedor').style.display = 'none';
            break;
        case "4":
            document.getElementById('RProducto').style.display = 'none';
            document.getElementById('RProveedor').style.display = 'none';
            document.getElementById('MProducto').style.display = 'none';
            document.getElementById('MProveedor').style.display = 'flex';
            break;
    }
})

document.getElementById('EntradaSalidaMenu').addEventListener('change', function () {
    let valor = this.value;
    switch (valor) {
        case '0':
            document.getElementById('REntrada').style.display = 'none';
            document.getElementById('RSalida').style.display = 'none';
            break;
        case '1':
            document.getElementById('REntrada').style.display = 'flex';
            document.getElementById('RSalida').style.display = 'none';
            break;
        case '2':
            document.getElementById('REntrada').style.display = 'none';
            document.getElementById('RSalida').style.display = 'flex';
            break;
    }
})
