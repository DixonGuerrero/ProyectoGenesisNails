
<?php
class Entrada extends SessionController
{

    private $directorio;
    private $directorioCopia;

    function __construct()
    {
        parent::__construct();
        $this->directorio = $_SERVER['DOCUMENT_ROOT'] . '/Proyectos/ProyectoGenesisNails2/assets/storage/entrada.json';
        $this->directorioCopia = $_SERVER['DOCUMENT_ROOT'] . '/Proyectos/ProyectoGenesisNails2/assets/storage/entradaCopia.json';

        error_log('Entrada::construct -> Inicio de Entrada');
    }

    public function render()
    {
        $this->view->render('entrada/index', [
            'usuario' => $this->usuario,
            'entradas' => $this->listaEntradas()
        ]);
    }



    public function nuevaEntrada()
    {
        $this->view->render('entrada/nueva', [
            'usuario' => $this->usuario,
            'formularioProducto' => $this->formularioAgregarProducto(),
            'productos' => $this->listaProductosParaSalir(),
            'formularioActualizarProducto' => $this->formularioActualizarProducto(),
            'formularioProveedor' => $this->formularioAgregarProveedor(),
            'existeProveedor' => $this->existeProveedor(),
            'formularioActualizarProveedor' => $this->formularioActualizarProveedor()
        ]);

        //$this->validarCopiaDatos();
    }

    //Llamamos a la vista de editar 
    public function editar()
    {
        $this->view->render('entrada/editar', [
            'usuario' => $this->usuario,
            'formularioProducto' => $this->formularioAgregarProducto(),
            'productos' => $this->listaProductosParaSalir(),
            'formularioActualizarProducto' => $this->formularioActualizarProducto(),
            'formularioProveedor' => $this->formularioAgregarProveedor(),
            'existeProveedor' => $this->existeProveedor(),
            'formularioActualizarProveedor' => $this->formularioActualizarProveedor()
        ]);
    }


    public function editarEntrada()
    {
        //Obtenemos el id de la salida
        if ($this->existeParametrosPost(['id_entrada'])) {
            $id_entrada = $this->obtenerPost('id_entrada');
            $entrada = new EntradaModel();
            $entrada = $entrada->obtenerUno($id_entrada);
            $proveedor =$entrada->getIdProveedor();

            //Vamos a limpiar el archivo
            if (file_exists($this->directorio)) {
                unlink($this->directorio);
                unlink($this->directorioCopia);
            }

            $this->asignarDatosArchivo($entrada->getProductos(), $id_entrada, $proveedor);
        }
    }

    //Funciones de movimientos en la base de datos
    public function guardar()
    {
        //Obtenemos los datos del archivo
        if (file_exists($this->directorio)) {
            $contenido = file_get_contents($this->directorio);
            $datos = json_decode($contenido, true);

            //Validamos que existan productos
            if (count($datos['productos']) > 0) {

                //Validamos que hayan escogido un proveedor
                if (!isset($datos['id_proveedor'])) {
                    //Lanzamos alerta
                    $this->alerta = new Alertas('error', 'No se ha seleccionado un proveedor');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }


                $entrada = new EntradaModel();
                $entrada->setIdAdmin($this->usuario->getId());
                $entrada->setIdProveedor($datos['id_proveedor']);
                $entrada->setProductos($datos['productos']);
                $response = $entrada->guardar();
                if ($response['status'] == 201) {
                    //Eliminar el archivo
                    unlink($this->directorio);
                    unlink($this->directorioCopia);
                    //Lanzamos alerta
                    $this->alerta = new Alertas('success', 'Entrada guardada correctamente');
                    http_response_code(200);
                    echo $this->alerta->redireccionar('entrada')->exito()->getAlerta();
                    exit();
                } else {
                    //Lanzamos alerta
                    $this->alerta = new Alertas('error', 'No se pudo guardar la entrada');
                    http_response_code(400);
                    echo $this->alerta->simple()->error()->getAlerta();
                    exit();
                }
            }
        } else {
            //Lanzamos alerta
            $this->alerta = new Alertas('error', 'No se han agregado productos a la entrada');
            http_response_code(400);
            echo $this->alerta->simple()->error()->getAlerta();
            exit();
        }
    }
    public function actualizar()
    {
        //En esta funcion se va a comparar el archivo salida.json con el archivo salidaCopia.json para asi poder mirar que cambios se realizaron y solo enviar a la base de datos los productos que fueron modificados
        // Decodificar los contenidos de ambos archivos JSON a arrays de PHP
        $contenidoSalida = json_decode(file_get_contents($this->directorio), true);
        $contenidoSalidaCopia = json_decode(file_get_contents($this->directorioCopia), true);

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
        $entrada = new EntradaModel();
        $entrada->setIdEntrada($contenidoSalida['id_entrada']);
        $entrada->setProductos($productosModificados);

        //Guardamos la salida
        $response = $entrada->actualizar();

        if ($response['status'] == 200) :
            //Lanzamos alerta
            $this->alerta = new Alertas('success', 'Entrada actualizada correctamente');
            http_response_code(200);
            echo $this->alerta->redireccionar('entrada')->exito()->getAlerta();

            //Eliminamos el archivo
            if (!unlink($this->directorio) || !unlink($this->directorioCopia)) :
                //Lanzamos alerta
                $this->alerta = new Alertas('error', 'No se pudo eliminar el archivo');
                http_response_code(400);
                echo $this->alerta->simple()->error()->getAlerta();
                exit();
            endif;
        else:
            //Lanzamos alerta
            $this->alerta = new Alertas('error', 'No se pudo actualizar la entrada');
            http_response_code(400);
            echo $this->alerta->simple()->error()->getAlerta();
            exit();
        endif;


    }

    public function validarCopiaDatos()
    {
        //Vamos a mirar si el archivo contiene algo si es asi vamos a lanzar una alerta donde le digamos al usuario que continue donde lo dejo la ultima vez

        if (file_exists($this->directorio)) {
            $contenido = file_get_contents($this->directorio);
            $datos = json_decode($contenido, true);

            if (count($datos['productos']) > 0) {
                //Lanzamos alerta
                $this->alerta = new Alertas('info', 'Se ha encontrado una entrada sin finalizar, ¿Desea continuar?');
                http_response_code(200);
                echo $this->alerta->simple()->info()->getAlerta();
                exit();
            }
        }
    }



    public function listaEntradas()
    {

        $entradas =  $this->model->obtenerTodo();

        $respuesta = '';

        foreach ($entradas as $entrada) :
            $respuesta .= '
                <div class="tarjeta">
                <div class="tarjeta-header">
                    <h2 class="titulo-entrada">
                        Entrada #' . $entrada->getIdEntrada() . '
                    </h2>
                </div>
        
                <div class="info-entrada">
                    <p class="info-fecha">Fecha: ' . $entrada->getFecha() . '</p>
                    <p class="info-proveedor">Proveedor: ' . $this->nombreProveedor($entrada->getIdProveedor()) . '</p>
                    <p class="cantidad">Cantidad:' . $this->cantidadProductos($entrada->getProductos()) . '</p>
                </div>
        
                <div class="productos">
                    <h2 class="titulo-producto">Productos</h2>
                    <div class="contenedor-imagenes">
                ';

            foreach ($entrada->getProductos() as $producto) :
                $respuesta .= '
                        <img src="' . APP_URL . 'assets/images/producto/' . $producto->getImagen() . '" alt="">
                        ';
            endforeach;

            $respuesta .= '
                    </div>
                    </div>
            
                    <div class="acciones">
                    <form action="' . APP_URL . 'entrada/editarEntrada" method="POST" class="form FormularioAjax">


                    <button type="submit" class="btn-editar">Editar <ion-icon name="create"></ion-icon></button>
               

                <input type="hidden" name="id_entrada" value="' . $entrada->getIdEntrada() . '">

                </form>
                    </div>
            
                </div>
                    ';
        endforeach;


        return $respuesta;
    }


    public function nombreProveedor($id)
    {
        $proveedor = new ProveedorModel();

        $proveedor = $proveedor->obtenerUno($id);
        error_log('Entrada::nombreProveedor -> ' . $proveedor->getIdProveedor());


        return $proveedor = isset($proveedor) ? $proveedor->getNombre() : 'No se ha encontrado el proveedor';
    }


    public function cantidadProductos($productos)
    {
        $cantidad = 0;

        foreach ($productos as $producto) :
            $cantidad += $producto->getCantidad();
        endforeach;

        return $cantidad;
    }

    //Formulario para agregar un producto
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
                Por favor, complete el siguiente formulario para agregar un producto a la entrada.
            </p>
            <form action="' . APP_URL . 'entrada/guardarProductos" method="POST" class="form FormularioAjax">
                

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

                <!-- <------Cantidad------> 
                <div class="form_group">
                    <label for="cantidad">Cantidad</label>
                    <input type="number" name="cantidad" id="cantidad" class="form__input">
                </div>

                
                <!-- <------Precio------> 
                <div class="form_group">
                    <label for="precio">Precio</label>
                    <input type="number" name="precio" id="precio" class="form__input">
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

    public function formularioAgregarProveedor()
    {
        $proveedores = new ProveedorModel();

        try {
            $proveedores = $proveedores->obtenerTodo();
            $respuesta = '
            <div class="modal_container">
            <div class="encabezado">
                <h1>Proveedores</h1>
                <a href="#" class="modal_close modal_close_proveedor">X</a>
            </div>
            
            <img src="' . APP_URL . 'assets/images/proveedor_add.png"  class="modal_img" alt="">
            <h2 class="modal_title">Agregue el Proveedor</h2>
        
            <p class="modal_text">
                Por favor seleccione el proveedor con el cual se esta ejecutando esta entrada de productos
            </p>
            <form action="' . APP_URL . 'entrada/guardarProveedor" method="POST" class="form FormularioAjax">
                

                <div class="form_group">
                    <label for="proveedor">Proveedores</label>
                    <select name="id_proveedor" id="proveedor" class="form_input" >
                ';

            foreach ($proveedores as $proveedor) :
                $respuesta .= '
                     <option value="' . $proveedor->getIdProveedor() . '">' . $proveedor->getNombre() . '</option>
                        ';
            endforeach;

            $respuesta .= '
                    </select>
                </div>

                <button type="submit" class="enviar">
                    Agregar
                </button>
            </form>

            </div>';

            return $respuesta;
        } catch (Exception $e) {
            error_log('Salida::formularioAgregarProveedor -> ERROR: ' . $e);
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
                    Modifique los datos del producto a la entrada que crea necesarios.
                </p>
                <form action="' . APP_URL . 'entrada/actualizarProducto" method="POST" class="form FormularioAjax">
                    
    
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

                    <!-- <------Precio------> 
                    <div class="form_group">
                        <label for="precio">Precio</label>
                        <input type="number" name="precio" id="precio" class="form__input">
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

    public function formularioActualizarProveedor()
    {
        $proveedores = new ProveedorModel();

        try {
            $proveedores = $proveedores->obtenerTodo();
            $respuesta = '
            <div class="modal_container">
            <div class="encabezado">
                <h1>Proveedores</h1>
                <a href="#" class="modal_close modal_close_proveedor_update">X</a>
            </div>
            
            <img src="' . APP_URL . 'assets/images/proveedor_add.png"  class="modal_img" alt="">
            <h2 class="modal_title">Actualice el Proveedor</h2>
        
            <p class="modal_text">
                Por favor, seleccione el proveedor con el cual se esta ejecutando esta entrada de productos
            </p>
            <form action="' . APP_URL . 'entrada/actualizarProveedor" method="POST" class="form FormularioAjax">
                

                <div class="form_group">
                    <label for="proveedor">Proveedores</label>
                    <select name="id_proveedor" id="proveedor" class="form_input" >
                ';

            foreach ($proveedores as $proveedor) :
                $respuesta .= '
                     <option value="' . $proveedor->getIdProveedor() . '">' . $proveedor->getNombre() . '</option>
                        ';
            endforeach;

            $respuesta .= '
                    </select>
                </div>

                <button type="submit" class="enviar">
                    Actualizar
                </button>
            </form>

            </div>';

            return $respuesta;
        } catch (Exception $e) {
            error_log('Salida::formularioAgregarProveedor -> ERROR: ' . $e);
            return '';
        }
    }

    public function guardarProveedor()
    {
        error_log('Salida::guardarProveedor -> Inicio');

        if ($this->existeParametrosPost(['id_proveedor'])) {
            $id_proveedor = $this->obtenerPost('id_proveedor');

            // Estructura inicial, se establece aquí el 'id_proveedor'
            $estructura = ['id_proveedor' => $id_proveedor, 'productos' => []];

            if (file_exists($this->directorio)) {
                // Leer el contenido existente si el archivo ya existe
                $contenidoExistente = file_get_contents($this->directorio);
                $contenidoDecodificado = json_decode($contenidoExistente, true);

                if (is_array($contenidoDecodificado) && isset($contenidoDecodificado['productos'])) {
                    // Solo actualizar la parte de 'productos' si el contenido es válido
                    $estructura['productos'] = $contenidoDecodificado['productos'];
                }
            }

            // Codificar la estructura a JSON
            $datos = json_encode($estructura, JSON_PRETTY_PRINT);

            error_log('Salida::guardarProveedor -> Datos: ' . $datos);

            // Intenta guardar los datos tanto en el directorio principal como en la copia
            $resultadoPrincipal = file_put_contents($this->directorio, $datos);
            $resultadoCopia = file_put_contents($this->directorioCopia, $datos);

            if ($resultadoPrincipal && $resultadoCopia) {
                // Lanzar una alerta de éxito
                $this->alerta = new Alertas('success', 'Proveedor agregado correctamente');
                http_response_code(200);
                echo $this->alerta->recargar()->exito()->getAlerta();
                exit();
            } else {
                // Lanzar una alerta de error
                $this->alerta = new Alertas('error', 'No se pudo agregar el proveedor');
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


    public function listaProductosParaSalir()
    {
        error_log('Salida::listaProductosParaSalir -> Inicio');

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
            $datos = json_decode($productos, true);
            $productos = $datos['productos'];

            error_log('Salida::listaProductosParaSalir -> Productos: ' . json_encode($productos));

            error_log("Salida::listaProductosParaSalir -> Proveedor: " . $datos['id_proveedor']);

            if (isset($datos['id_proveedor'])) :
                $proveedor = new ProveedorModel();
                $proveedor = $proveedor->obtenerUno((int)$datos['id_proveedor']);
                $id_proveedor = $proveedor->getIdProveedor();
                $nombre = $proveedor->getNombre();
            endif;





            //Si hay datos vamos a empezar a crear la tabla
            //Creamos tabla

            if ($proveedor) :
                # code...

                $tabla = '

                <div class="proveedor">
                    <h2>Proveedor</h2>
                    <div class="proveedor-info">
                    <h3>' . $nombre . '</h3>
                    <input type="hidden" name="id_proveedor" value="' . $id_proveedor . '">
                    <button class="editar boton-editar add-new-proveedor-update">
                    <ion-icon name="create"></ion-icon>
                    </button>

                    </div>
                </div>';
            endif;

            $tabla .= '
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
                            <ion-icon name="people-circle"></ion-icon>
                            Precio</th>
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
                <td>' . $producto['precio'] . '</td>
                <td >
                   <div class="acciones">
                   <button class="editar boton-editar">
                   <ion-icon name="create"></ion-icon>
               </button>

               ';


                $url = isset($_GET['url']) ? $_GET['url'] : null;
                $url = rtrim($url, '/');
                $url = explode('/', $url);

                if ($url[1] == 'nuevaEntrada') :

                    $tabla .= '
                            <form  action="' . APP_URL . 'entrada/eliminarProducto" method="POST" class="form FormularioAjax">

                        
                        <button type="submit" class="eliminar">
                        <ion-icon name="trash-bin"></ion-icon></button>

                            <input type="hidden" name="id_producto" value="' . $productoFila->getIdProducto() . '"> 

                            <input type="hidden" name="cantidad" value="' . $producto['cantidad'] . '">

                            <input type="hidden" name="precio" value="' . $producto['precio'] . '">

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

    public function guardarProductos()
    {
        if ($this->existeParametrosPost(['id_producto', 'cantidad', 'precio'])) {
            $id_producto = $this->obtenerPost('id_producto');
            $cantidad = $this->obtenerPost('cantidad');
            $precio = $this->obtenerPost('precio');

            $nuevoProducto = [
                'id_producto' => $id_producto,
                'cantidad' => $cantidad,
                'precio' => $precio
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

    public function eliminarProducto()
    {

        if ($this->existeParametrosPost(['id_producto', 'cantidad', 'precio'])) {

            $id_producto = $this->obtenerPost('id_producto');
            $cantidad = $this->obtenerPost('cantidad');
            $precio = $this->obtenerPost('precio');

            //Leer el contenido existente si el archivo ya existe
            $contenidoExistente = file_get_contents($this->directorio);
            $estructura = json_decode($contenidoExistente, true);
            $productos = $estructura['productos'];

            //Buscamos el producto en el array
            foreach ($productos as $key => $producto) {
                if ($producto['id_producto'] == $id_producto && $producto['cantidad'] == $cantidad && $producto['precio'] == $precio) {
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

    public function eliminarProductosAgregados()
    {
        //Eliminar el archivo
        if (file_exists($this->directorio)) {
            unlink($this->directorio);
            unlink($this->directorioCopia);
        }

        //Lanzamos alerta
        $this->alerta = new Alertas('success', 'Productos eliminados correctamente');
        http_response_code(200);
        echo $this->alerta->redireccionar('entrada')->exito()->getAlerta();
        exit();
    }

    public function actualizarProducto()
    {
        //Obtenemos los datos
        if ($this->existeParametrosPost(['id_producto', 'cantidad', 'producto', 'precio'])) {

            $id_producto = $this->obtenerPost('id_producto');
            $cantidad = $this->obtenerPost('cantidad');
            $productoNew = $this->obtenerPost('producto');
            $precio = $this->obtenerPost('precio');

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
                    $productos[$key]['precio'] = $precio;
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

    public function actualizarProveedor(): void
    {
        if ($this->existeParametrosPost(['id_proveedor'])) {
            $id_proveedor = $this->obtenerPost('id_proveedor');

            // Estructura inicial, se establece aquí el 'id_proveedor'
            $estructura = ['id_proveedor' => $id_proveedor, 'productos' => []];

            if (file_exists($this->directorio)) {
                // Leer el contenido existente si el archivo ya existe
                $contenidoExistente = file_get_contents($this->directorio);
                $contenidoDecodificado = json_decode($contenidoExistente, true);

                if (is_array($contenidoDecodificado) && isset($contenidoDecodificado['productos'])) {
                    // Solo actualizar la parte de 'productos' si el contenido es válido
                    $estructura['productos'] = $contenidoDecodificado['productos'];
                }
            }

            // Codificar la estructura a JSON
            $datos = json_encode($estructura, JSON_PRETTY_PRINT);

            error_log('Salida::actualizarProveedor -> Datos: ' . $datos);

            // Intenta guardar los datos tanto en el directorio principal como en la copia
            $resultadoPrincipal = file_put_contents($this->directorio, $datos);
            $resultadoCopia = file_put_contents($this->directorioCopia, $datos);

            if ($resultadoPrincipal && $resultadoCopia) {
                // Lanzar una alerta de éxito
                $this->alerta = new Alertas('success', 'Proveedor actualizado correctamente');
                http_response_code(200);
                echo $this->alerta->recargar()->exito()->getAlerta();
                exit();
            } else {
                // Lanzar una alerta de error
                $this->alerta = new Alertas('error', 'No se pudo actualizar el proveedor');
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
    
    function asignarDatosArchivo($productos, $entrada, $proveedor): void
    {
        $productosTransformados = array_map(function ($producto) {
            return [
                'id_producto' => $producto->getIdProducto(),
                'cantidad' => $producto->getCantidad(),
                'precio' => $producto->getPrecio()
            ];
        }, $productos);

        // La estructura inicial en caso de que el archivo no exista o no tenga el formato correcto
        $estructura = ['id_entrada' => $entrada, 'productos' => []];


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
        if (file_put_contents($this->directorio, $datos)  && file_put_contents($this->directorioCopia, $datos)) {
            // Lanzar una alerta de éxito

            error_log('Salida::asignarDatosArchivo -> Exito');
            $this->alerta = new Alertas('success', 'Productos cargados correctamente');
            http_response_code(200);
            echo $this->alerta->redireccionar('entrada/editar')->exito()->getAlerta();
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

    function existeProveedor()
    {
        if (file_exists($this->directorio)) {
            $contenidoExistente = file_get_contents($this->directorio);
            $estructura = json_decode($contenidoExistente, true);
            if (isset($estructura['id_proveedor'])) {
                return true;
            }
        }
        return false;
    }
}
