<?php 

    require_once 'app/views/template/parteSuperiorAdmin.php';
?>

<div class="barra-superior">
        <h1 class="titulo-pagina">Salidas</h1>  
    </div>

    <div class="tabla">
        <div class="table-header">
            <p>Citas Detalles</p>
            <div>      
                 <button class="add-new">
                    <ion-icon name="add-circle"></ion-icon>
                    Nuevo
                </button>   
              
                
            </div>
        </div>
        <div class="table-section">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Id Cita</th>
                        <th>Servicio</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td><img src="../images/36.jpg" alt=""></td>
                        <td>Carlos</td>
                        <td>2021-10-10</td>
                        <td>
                            <button class="editar">
                                <ion-icon name="create"></ion-icon>
                            </button>
                            <button class="eliminar">
                                <ion-icon name="trash"></ion-icon>
                            </button>
                    </tr>

                </tbody>
            </table>    
        </div>
        <div class="pagination">
               <div><i>
                     <ion-icon name="chevron-back-outline"></ion-icon>
               </i></div>
               <div><i>1</i></div>
               <div><i>2</i></div>
               <div><i>3</i></div>
               <div><i>
                        <ion-icon name="chevron-forward-outline"></ion-icon>
               </i></div>
            </div>
    </div>




<?php 
    require_once 'app/views/template/parteInferiorAdmin.php';
?>