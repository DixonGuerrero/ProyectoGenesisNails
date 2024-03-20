let fileEntrada = document.getElementById("file-input");
let fileLista = document.getElementById("files-list");
let numOfFiles = document.getElementById("num-of-files");


fileEntrada.addEventListener("change",()=>{
    fileLista.innerHTML = "";

    numOfFiles.textContent = `${fileEntrada.files.length} archivos seleccionados`;

    for(i of fileEntrada.files){
        let lector = new FileReader();
        let listItem = document.createElement("li");
        let fileName = i.name;
        let fileSize = (i.size/1024).toFixed(1);
        listItem.innerHTML = `<p>${fileName}</p> <p>${fileSize} KB</p>`;

        if(fileSize >= 1024){
            fileSize = (fileSize/1024).toFixed(1);
            listItem.innerHTML = `<p>${fileName}</p> <p>${fileSize} MB</p>`;
        }

        fileLista.appendChild(listItem);
    }
})