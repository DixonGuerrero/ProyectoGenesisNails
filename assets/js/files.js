document.addEventListener("DOMContentLoaded", function() {
    // Selecciona todos los inputs de tipo archivo
    document.querySelectorAll('input[type="file"]').forEach(input => {
        input.addEventListener("change", function() {
            // Encuentra los elementos relacionados usando el ID del input actual
            let numOfFiles = document.getElementById(`num-of-files-${this.id.split('-')[2]}`);
            let filesList = document.getElementById(`files-list-${this.id.split('-')[2]}`);

            // Actualiza el texto para mostrar el número de archivos cargados
            numOfFiles.textContent = `${this.files.length} archivo(s) seleccionado(s)`;

            // Limpia la lista anterior y muestra los nombres de los archivos cargados
            filesList.innerHTML = "";
            Array.from(this.files).forEach(file => {
                const listItem = document.createElement("li");
                const fileName = file.name;
                let fileSize = (file.size / 1024).toFixed(1); // Tamaño en KB
                let fileUnit = 'KB';
                
                if (fileSize > 1024) {
                    fileSize = (fileSize / 1024).toFixed(1); // Convierte a MB si es necesario
                    fileUnit = 'MB';
                }
                
                listItem.innerHTML = `<p>${fileName}</p> <p>${fileSize} ${fileUnit}</p>`;
                filesList.appendChild(listItem);
            });
        });
    });
});
