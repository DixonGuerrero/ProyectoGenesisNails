<?php
class Salida extends SessionController
{
    private $directorio;
    private $directorioCopiaEditar;
    
    function __construct()
    {
        parent::__construct();
        // Asegúrate de que la ruta relativa esté bien formada.
        $this->directorio = $_SERVER['DOCUMENT_ROOT'] . '/Proyectos/ProyectoGenesisNails2/assets/storage/salida.json';
        $this->directorioCopiaEditar = $_SERVER['DOCUMENT_ROOT'] . '/Proyectos/ProyectoGenesisNails2/assets/storage/salidaCopia.json';


        error_log('Salida::construct -> Inicio de Salida');
    }
    function render()
    {
        $this->view->render('salida/index', [
            'usuario' => $this->usuario,
            'salidas' => $this->listaSalidas()
        ]);
    }

    public function nuevaSalida()
    {
        $this->view->render('salida/nueva', [
            'usuario' => $this->usuario,
            'formularioProducto' => $this->formularioAgregarProducto(),
            'productos' => $this->listaProductosParaSalir(),
            'formularioActualizarProducto' => $this->formularioActualizarProducto()
        ]);
    }

    public function editarSalida()
    {
        //Obtenemos el id de la salida
        if ($this->existeParametrosPost(['id_salida'])) {
            $id_salida = $this->obtenerPost('id_salida');
            $salida = new SalidaModel();
            $salida = $salida->obtenerUno($id_salida);

            //Vamos a limpiar el archivo
            if (file_exists($this->directorio)) {
                unlink($this->directorio);
                unlink($this->directorioCopiaEditar);
            }

            $this->asignarDatosArchivo($salida->getProductos(),$id_salida);
        }
    }

    //Llamamos a la vista de editar 
    public function editar()
    {
        $this->view->render('salida/editar', [
            'usuario' => $this->usuario,
            'formularioProducto' => $this->formularioAgregarProducto(),
            'productos' => $this->listaProductosParaSalir(),
            'formularioActualizarProducto' => $this->formularioActualizarProducto()
        ]);
    }

    //Funcion para guardar en BD
    public function guardar()
    {
        //Miramos si el salida.json existe
        if (file_exists($this->directorio)) {
            //Leemos el archivo
            $contenido = file_get_contents($this->directorio);
            //Decodificamos el archivo
            $contenido = json_decode($contenido, true);
            $ // Prepara un nuevo arreglo para los productos
            $productosNuevos = [];

            // Itera sobre los productos y añádelos al nuevo arreglo
            foreach ($contenido['productos'] as $producto) {
                $productosNuevos[] = [
                    'id_producto' => (int) $producto['id_producto'], // Convierte a int
                    'cantidad' => (int) $producto['cantidad'] // Convierte a int
                ];
            }


            error_log('Salida::guardar -> Productos: ' . json_encode($productosNuevos));

            //Creamos la salida
            $salida = new SalidaModel();
            $salida->setIdAdmin($this->usuario->getId());
            $salida->setProductos($productosNuevos);
            $response = $salida->guardar();
            //Guardamos la salida
            if ($response['status'] == 201) {
                //Lanzamos alerta
                $this->alerta = new Alertas('Exito', 'Salida guardada correctamente');
                http_response_code(200);
                echo $this->alerta->redireccionar('salida')->exito()->getAlerta();

                //Eliminamos el archivo
                if (!unlink($this->directorio)) :
                    //Lanzamos alerta
                    $this->alerta = new Alertas('error', 'No se pudo eliminar el archivo');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                endif;
                exit();
            } else {
                //Lanzamos alerta
                $this->alerta = new Alertas('error', 'No se pudo guardar la salida');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
        } else {
            //Lanzamos alerta
            $this->alerta = new Alertas('error', 'No se han agregado productos a la salida');
            http_response_code(400);
            echo $this->alerta->simple()->error()->getAlerta();
            exit();
        }
    }

    //Funcion para actualizar en BD
    public function actualizar()
    {
        //En esta funcion se va a comparar el archivo salida.json con el archivo salidaCopia.json para asi poder mirar que cambios se realizaron y solo enviar a la base de datos los productos que fueron modificados
        // Decodificar los contenidos de ambos archivos JSON a arrays de PHP
        $contenidoSalida = json_decode(file_get_contents($this->directorio), true);
        $contenidoSalidaCopia = json_decode(file_get_contents($this->directorioCopiaEditar), true);

        // Asumiendo que ambos archivos tienen una estructura similar y contienen un array bajo la clave 'productos'
        $productosSalida = $contenidoSalida['productos'];
        $productosSalidaCopia = $contenidoSalidaCopia['productos'];

        // Identificar productos modificados
        $productosModificados = [];
        foreach ($productosSalida as $producto) {
            $idProducto = $producto['id_producto'];
            // Buscar el producto en salidaCopia por id_producto
            $productoCopia = array_filter($productosSalidaCopia, function ($item) use ($idProducto) {
                return $item['id_producto'] == $idProducto;
            });

            // Si el producto no existe en salidaCopia o si la cantidad es diferente, se considera modificado
            if (empty($productoCopia) || $producto['cantidad'] !== array_values($productoCopia)[0]['cantidad']) {
                $productosModificados[] = $producto;
            }
        }

        

        //Actualizamos la salida actual
        $salida = new SalidaModel();
        $salida->setIdSalida($contenidoSalida['id_salida']);
        $salida->setProductos($productosModificados);

        //Guardamos la salida
        $response = $salida->actualizar();

        if ($response['status'] == 200) :
            //Lanzamos alerta
            $this->alerta = new Alertas('success', 'Salida actualizada correctamente');
            http_response_code(200);
            echo $this->alerta->redireccionar('salida')->exito()->getAlerta();

            //Eliminamos el archivo
            if (!unlink($this->directorio) || !unlink($this->directorioCopiaEditar)) :
                //Lanzamos alerta
                $this->alerta = new Alertas('error', 'No se pudo eliminar el archivo');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            endif;
        else:
            //Lanzamos alerta
            $this->alerta = new Alertas('error', 'No se pudo actualizar la salida');
            http_response_code(400);
            echo $this->alerta->simple()->error()->getAlerta();
            exit();
        endif;


    }

    //Funcion para guardar los productos que se van agregando al archivo temporal
    public function guardarProductos()
    {
        if ($this->existeParametrosPost(['id_producto', 'cantidad'])) {
            $id_producto = $this->obtenerPost('id_producto');
            $cantidad = $this->obtenerPost('cantidad');

            $nuevoProducto = [
                'id_producto' => $id_producto,
                'cantidad' => $cantidad
            ];

            // Inicializar la estructura con un array para 'productos' si no existe el archivo
            $estructura = ['productos' => []];

            if (file_exists($this->directorio)) {
                // Leer el contenido existente si el archivo ya existe
                $contenidoExistente = file_get_contents($this->directorio);
                $estructura = json_decode($contenidoExistente, true);
                if (!is_array($estructura) || !isset($estructura['productos'])) {
                    // Asegurarse de que $estructura sea un array y tenga un array 'productos'
                    $estructura = ['productos' => []];
                }
            }

            // Añadir el nuevo producto al array 'productos'
            $estructura['productos'][] = $nuevoProducto;

            // Codificar la estructura a JSON
            $datos = json_encode($estructura, JSON_PRETTY_PRINT);

            // Guardar los datos en el archivo, reemplazando el contenido anterior
            if (file_put_contents($this->directorio, $datos)) {
                // Lanzar una alerta de éxito
                $this->alerta = new Alertas('success', 'Producto agregado correctamente');
                http_response_code(200);
                echo $this->alerta->recargar()->exito()->getAlerta();
                exit();
            } else {
                // Lanzar una alerta de error
                $this->alerta = new Alertas('error', 'No se pudo agregar el producto');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
        } else {
            // Lanzar una alerta de error por falta de datos
            $this->alerta = new Alertas('error', 'No se han recibido los datos necesarios');
            http_response_code(400);
            echo $this->alerta->simple()->error()->getAlerta();
            exit();
        }
    }

    //Funcion para listar las salidas
    public function listaSalidas()
    {

        $salidas =  $this->model->obtenerTodo();

        $respuesta = '';

        foreach ($salidas as $salida) :
            $respuesta .= '
                <div class="tarjeta">
                <div class="tarjeta-header">
                    <h2 class="titulo-salida">
                        Salida #' . $salida->getIdSalida() . '
                    </h2>
                </div>
        
                <div class="info-salida">
                    <p class="info-fecha">Fecha: ' . $salida->getFecha() . '</p>
                    <p class="cantidad">Cantidad:' . $this->cantidadProductos($salida->getProductos()) . '</p>
                </div>
        
                <div class="productos">
                    <h2 class="titulo-producto">Productos</h2>
                    <div class="contenedor-imagenes">
                ';

            foreach ($salida->getProductos() as $producto) :
                $respuesta .= '
                        <img src="' . APP_URL . 'assets/images/producto/' . $producto->getImagen() . '" alt="">
                        ';
            endforeach;

            $respuesta .= '
                    </div>
                    </div>
            
                    <div class="acciones">

                    <form action="' . APP_URL . 'salida/editarSalida" method="POST" class="form FormularioAjax">


                        <button type="submit" class="btn-editar">Editar <ion-icon name="create"></ion-icon></button>
                   

                    <input type="hidden" name="id_salida" value="' . $salida->getIdSalida() . '">

                    </form>
             </div>
                </div>
                    ';
        endforeach;


        return $respuesta;
    }

    //Funcion para obtener la cantidad de productos de una salida
    public function cantidadProductos($productos)
    {
        $cantidad = 0;

        foreach ($productos as $producto) :
            $cantidad += $producto->getCantidad();
        endforeach;

        return $cantidad;
    }

    //Funcion para obtener el formulario de agregar producto
    public function formularioAgregarProducto()
    {
        $productos = new ProductoModel();

        try {
            $productos = $productos->obtenerTodo();
            $respuesta = '
            <div class="modal_container">
            <div class="encabezado">
                <h1>Productos</h1>
                <a href="#" class="modal_close">X</a>
            </div>
            
            <img src="' . APP_URL . 'assets/images/categoria_add.png"  class="modal_img" alt="">
            <h2 class="modal_title">Agregue el Producto</h2>
        
            <p class="modal_text">
                Por favor, complete el siguiente formulario para agregar un producto a la salida.
            </p>
            <form action="' . APP_URL . 'salida/guardarProductos" method="POST" class="form FormularioAjax">
                

                <div class="form_group">
                    <label for="producto">Productos</label>
                    <select name="id_producto" id="producto" class="form_input" >
                ';

            foreach ($productos as $producto) :
                $respuesta .= '
                    <option value="' . $producto->getIdProducto() . '">' . $producto->getNombre() . '</option>
                    ';
            endforeach;

            $respuesta .= '
                    </select>
                </div>

                <!-- <------Fecha y Hora------> 
                <div class="form_group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form__input">
                </div>

                <button type="submit" class="enviar">
                    Agregar
                </button>
            </form>

            </div>';


            return $respuesta;
        } catch (\Throwable $e) {
            error_log('Salida::formularioAgregarProducto -> ' . $e);
            return '';
        }
    }

    //Funcion para obtener el formulario de actualizar producto
    public function formularioActualizarProducto()
    {
        $productos = new ProductoModel();

        try {
            $productos = $productos->obtenerTodo();
            $respuesta = '
            <div class="modal_container">
            <div class="encabezado">
                <h1>Productos</h1>
                <a href="#" class="modal_close">X</a>
            </div>
            
            <img src="' . APP_URL . 'assets/images/categoria_add.png"  class="modal_img" alt="">
            <h2 class="modal_title">Actualice el Producto</h2>
        
            <p class="modal_text">
                Modifique los datos del producto a la salida que crea necesarios.
            </p>
            <form action="' . APP_URL . 'salida/actualizarProducto" method="POST" class="form FormularioAjax">
                

                <div class="form_group">
                    <label for="producto">Productos</label>
                    <select name="producto" id="producto" class="form_input" >
                ';

            foreach ($productos as $producto) :
                $respuesta .= '
                    <option value="' . $producto->getIdProducto() . '">' . $producto->getNombre() . '</option>
                    ';
            endforeach;

            $respuesta .= '
                    </select>
                </div>

                <input type="hidden" name="id_producto" id="id_producto" class="form__input" value="">

                <!-- <------Cantidad------> 
                <div class="form_group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form__input">
                </div>

                <button type="submit" class="enviar">
                    Actualizar
                </button>
            </form>

            </div>';


            return $respuesta;
        } catch (\Throwable $e) {
            error_log('Salida::formularioAgregarProducto -> ' . $e);
            return '';
        }
    }

    //Funcion para actualizar los productos que se van agregando al archivo temporal
    public function listaProductosParaSalir()
    {
        try {

            //Validamos que el archivo exista
            if (!file_exists($this->directorio) || filesize($this->directorio) <= 40) :
                //Validar que el archivo no este vacio

                $respuesta = '<div class="contenedor-productos">
                <h3>No hay Productos Agregados</h3>
                </div>';

                return $respuesta;
                exit();
            endif;


            //V
            $productos = file_get_contents($this->directorio);
            $productos = json_decode($productos, true);
            $productos = $productos['productos'];

            error_log('Salida::listaProductosParaSalir -> Productos: ' . json_encode($productos));




            //Si hay datos vamos a empezar a crear la tabla
            //Creamos tabla
            $tabla = '

            <div class="table-section">
                <table id="tablaDatos">
                    <thead id="encabezado-tabla">
                        <tr>
                            <th>
                            <ion-icon name="id-card"></ion-icon>
                            Id
                            </th>
                            <th>
                            <ion-icon name="person-circle"></ion-icon>
                            Imagen
                            </th>
                            <th>
                            <ion-icon name="people-circle"></ion-icon>
                            Nombre</th>
                            <th>
                            <ion-icon name="people-circle"></ion-icon>
                            Cantidad</th>
                            <th>
                            <ion-icon name="build"></ion-icon>
                            Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';

            //Empezamos a recorrer los datos y agregarlos a la tabla

            foreach ($productos as $producto) {
                //Obtenemos el producto
                $productoFila = new ProductoModel();
                $productoFila = $productoFila->obtenerUno($producto['id_producto']);
                $tabla .= '<tr>
                <td class="id">' . $productoFila->getIdProducto() . '</td>
                <td class="perfil"><img src="' . APP_URL . 'assets/images/producto/' . $productoFila->getImagen() . '" alt=""></td>
                <td>' . $productoFila->getNombre() . '</td>
                <td>' . $producto['cantidad'] . '</td>
                <td >
                   <div class="acciones">
                   <button class="editar boton-editar">
                   <ion-icon name="create"></ion-icon>
               </button>

               ';


                $url = isset($_GET['url']) ? $_GET['url'] : null;
                $url = rtrim($url, '/');
                $url = explode('/', $url);

                if ($url[1] == 'nuevaSalida') :

                    $tabla .= '
                            <form  action="' . APP_URL . 'salida/eliminarProducto" method="POST" class="form FormularioAjax">

                        
                        <button type="submit" class="eliminar">
                        <ion-icon name="trash-bin"></ion-icon></button>

                            <input type="hidden" name="id_producto" value="' . $productoFila->getIdProducto() . '"> 

                            <input type="hidden" name="cantidad" value="' . $producto['cantidad'] . '">

                        </form>';
                endif;
                $tabla .= '

                   </div>
                </td>
            </tr>';
            }

            //Cerramos la tabla
            $tabla .= '
            </tbody>
        </table>
        </div>
            ';

            return $tabla;
        } catch (Exception $e) {
            error_log('Usuario::listaUsuarios -> ERROR: ' . $e);
            return false;
        }
    }

    //Funcion para eliminar un producto del archivo temporal
    public function eliminarProducto()
    {

        if ($this->existeParametrosPost(['id_producto', 'cantidad'])) {

            $id_producto = $this->obtenerPost('id_producto');
            $cantidad = $this->obtenerPost('cantidad');

            //Leer el contenido existente si el archivo ya existe
            $contenidoExistente = file_get_contents($this->directorio);
            $estructura = json_decode($contenidoExistente, true);
            $productos = $estructura['productos'];

            //Buscamos el producto en el array
            foreach ($productos as $key => $producto) {
                if ($producto['id_producto'] == $id_producto && $producto['cantidad'] == $cantidad) {
                    //Eliminamos el producto
                    unset($productos[$key]);
                }
            }

            //Actualizamos la estructura
            $estructura['productos'] = $productos;

            //Codificar la estructura a JSON
            $datos = json_encode($estructura, JSON_PRETTY_PRINT);

            // Guardar los datos en el archivo, reemplazando el contenido anterior
            if (file_put_contents($this->directorio, $datos)) {
                // Lanzar una alerta de éxito
                $this->alerta = new Alertas('success', 'Producto eliminado correctamente');
                http_response_code(200);
                echo $this->alerta->recargar()->exito()->getAlerta();
                exit();
            } else {
                // Lanzar una alerta de error
                $this->alerta = new Alertas('error', 'No se pudo eliminar el producto');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
        }
    }

    //Funcion para eliminar todos los productos del archivo temporal
    public function eliminarProductosAgregados()
    {
        //Eliminar el archivo
        if (file_exists($this->directorio)) {
            unlink($this->directorio);
        }

        //Lanzamos alerta
        $this->alerta = new Alertas('success', 'Productos eliminados correctamente');
        http_response_code(200);
        echo $this->alerta->redireccionar('salida')->exito()->getAlerta();
        exit();
    }

    //Funcion para actualizar un producto del archivo temporal
    public function actualizarProducto()
    {
        //Obtenemos los datos
        if ($this->existeParametrosPost(['id_producto', 'cantidad', 'producto'])) {

            $id_producto = $this->obtenerPost('id_producto');
            $cantidad = $this->obtenerPost('cantidad');
            $productoNew = $this->obtenerPost('producto');

            //Leer el contenido existente si el archivo ya existe
            $contenidoExistente = file_get_contents($this->directorio);
            $estructura = json_decode($contenidoExistente, true);
            $productos = $estructura['productos'];

            //Buscamos el producto en el array
            foreach ($productos as $key => $producto) {
                if ($producto['id_producto'] == $id_producto) {
                    //Actualizamos la cantidad
                    $productos[$key]['id_producto'] = $productoNew;
                    $productos[$key]['cantidad'] = $cantidad;
                }
            }

            //Actualizamos la estructura
            $estructura['productos'] = $productos;

            //Codificar la estructura a JSON
            $datos = json_encode($estructura, JSON_PRETTY_PRINT);

            // Guardar los datos en el archivo, reemplazando el contenido anterior
            if (file_put_contents($this->directorio, $datos)) {
                // Lanzar una alerta de éxito
                $this->alerta = new Alertas('success', 'Producto actualizado correctamente');
                http_response_code(200);
                echo $this->alerta->recargar()->exito()->getAlerta();
                exit();
            } else {
                // Lanzar una alerta de error
                $this->alerta = new Alertas('error', 'No se pudo actualizar el producto');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            }
        } else {
            // Lanzar una alerta de error por falta de datos
            $this->alerta = new Alertas('error', 'No se han recibido los datos necesarios');
            http_response_code(400);
            echo $this->alerta->simple()->error()->getAlerta();
            exit();
        }
    }

    //Funcion para asignar los datos al archivo
    function asignarDatosArchivo($productos,$salida): void
    {
        $productosTransformados = array_map(function ($producto) {
            return [
                'id_producto' => $producto->getIdProducto(),
                'cantidad' => $producto->getCantidad()
            ];
        }, $productos);

        // La estructura inicial en caso de que el archivo no exista o no tenga el formato correcto
        $estructura = ['id_salida' => $salida, 'productos' => []];
     

        if (file_exists($this->directorio)) {
            // Leer el contenido existente si el archivo ya existe
            $contenidoExistente = file_get_contents($this->directorio);
            $estructura = json_decode($contenidoExistente, true);
            if (!is_array($estructura) || !isset($estructura['productos'])) {
                // Reiniciar la estructura si el contenido no es válido
                $estructura = ['productos' => []];
            }
        }

        // Añadir los productos transformados al array 'productos'. Esto combina los arrays en vez de añadir uno dentro del otro
        foreach ($productosTransformados as $producto) {
            $estructura['productos'][] = $producto;
        }

        // Codificar la estructura completa a JSON
        $datos = json_encode($estructura, JSON_PRETTY_PRINT);

        // Guardar los datos en el archivo, reemplazando el contenido anterior

        error_log('Salida::asignarDatosArchivo -> Datos: Antes de crear el archivo');
        if (file_put_contents($this->directorio, $datos)  && file_put_contents($this->directorioCopiaEditar, $datos)) {
            // Lanzar una alerta de éxito

            error_log('Salida::asignarDatosArchivo -> Exito');
            $this->alerta = new Alertas('success', 'Productos cargados correctamente');
            http_response_code(200);
            echo $this->alerta->redireccionar('salida/editar')->exito()->getAlerta();
            exit();
        } else {
            // Lanzar una alerta de error
            error_log('Salida::asignarDatosArchivo -> Error');
            $this->alerta = new Alertas('error', 'No se pudo agregar el producto');
            http_response_code(400);
            echo $this->alerta->simple()->error()->getAlerta();
            exit();
        }
    }
}
