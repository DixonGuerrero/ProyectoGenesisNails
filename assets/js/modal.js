const openModel = document.querySelector('.add-new ,#add-new');
const openModelProveedor = document.querySelector('.add-new-proveedor ,#add-new-proveedor');
const openModelProveedorUpdate = document.querySelector('.add-new-proveedor-update ,#add-new-proveedor-update');
const modalProveedor = document.querySelector('.modal_proveedor');
const modalProveedorUpdate = document.querySelector('.modal_update_proveedor');
const modal = document.querySelector('.modal');
const closeModal = document.querySelector('.modal_close');
const closeModelProveedor = document.querySelector('.modal_close_proveedor');
const closeModelProveedorUpdate = document.querySelector('.modal_close_proveedor_update');

//Agregamos const para abrir y cerrar el model de actualizar
const openModalUpdate = document.querySelector('.actualizar');
const modalUpdate  = document.querySelector('.modal_update');


//Agregamos el evento para abrir el model
if(openModel) {
    openModel.addEventListener('click',(e)=> {
        e.preventDefault();
        modal.classList.add('modal--show');
    })
}

closeModal.addEventListener('click',(e)=> {
    e.preventDefault();
    modal.classList.remove('modal--show');
})


if(closeModelProveedor) {
closeModelProveedor.addEventListener('click',(e)=> {
    e.preventDefault();
    modalProveedor.classList.remove('modal--show');
})
}


if(openModelProveedorUpdate){
closeModelProveedorUpdate.addEventListener('click',(e)=> {
    e.preventDefault();
    modalProveedorUpdate.classList.remove('modal--show');
})
}



//Agregamos el evento para abrir el model de proveedor
if(openModelProveedor) {
    openModelProveedor.addEventListener('click',(e)=> {
        e.preventDefault();
        modalProveedor.classList.add('modal--show');
    })
}

if(openModalUpdate) {
    openModalUpdate.addEventListener('click',(e)=> {
        e.preventDefault();
        modalUpdate.classList.add('modal--show');
    })
}


//Agregamos el evento para abrir el model de actualizar
if(openModelProveedorUpdate) {
    openModelProveedorUpdate.addEventListener('click',(e)=> {
        e.preventDefault();
        modalProveedorUpdate.classList.add('modal--show');
    })
}