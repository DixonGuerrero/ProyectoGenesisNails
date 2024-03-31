const openModel = document.querySelector('.add-new ,#add-new');
const modal = document.querySelector('.modal');
const closeModal = document.querySelector('.modal_close');

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


//Agregamos el evento para abrir el model de actualizar
if(openModalUpdate) {
    openModalUpdate.addEventListener('click',(e)=> {
        e.preventDefault();
        modalUpdate.classList.add('modal--show');
    })
}