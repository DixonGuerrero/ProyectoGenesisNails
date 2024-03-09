document.addEventListener('DOMContentLoaded', function() {
    
    var miTabla = document.querySelector('#tablaDatos');

    if (miTabla) {
        // Ahora es seguro inicializar la DataTable
        new DataTable(miTabla,{
            perPage: 6,
            perPageSelect: [4,6,8,10,20],
            labels: {
                placeholder: "Buscar...",
                perPage: "Mostrar {select} datos por página",
                noRows: "No se encontraron datos",
                info: "Mostrando {start} a {end} de {rows} datos",
            },

        }
        );


    } else {
        console.error('El elemento de la tabla no fue encontrado en el DOM.');
    }
});
