document.addEventListener("DOMContentLoaded", function () {
  var miTabla = document.querySelector("#tablaDatos");

  if (miTabla) {
    // Ahora es seguro inicializar la DataTable
    new DataTable(miTabla, {
      perPage: 6,
      searchable: false,
      perPageSelect:false,
      labels: {
         noRows: "No se encontraron datos",
         info: "Mostrando {start} a {end} de {rows} datos",
     },

    });
  } else {
    console.error("El elemento de la tabla no fue encontrado en el DOM.");
  }
});
