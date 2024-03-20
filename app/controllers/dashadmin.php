<?php
class DashAdmin extends SessionController
{
    function __construct()
    {
        parent::__construct();
        error_log('Home::construct -> Inicio de Home');
    }

    public function render()
    {
        $this->view->render('dashadmin/index', [
            'usuario' => $this->usuario,
            'mensajeTiempo' => $this->mensajeTiempo(),
            'num_citas' => $this->numCitas(),
            'num_usuarios' => $this->numUsuarios(),
            'num_productos' => $this->numProductos(),
            'num_proveedores' => $this->numProveedores(),
            'producto_max_stock' => $this->productoMaxStock(),
            'producto_min_stock' => $this->productoMinStock()

        ]);
    }

    public function numCitas()
    {
        error_log('DashAdmin::numCitas -> Inicio de numCitas');

        $cita = new CitaAdmin;
        $citas = $cita->numCitas();
        return $citas;
    }

    public function numUsuarios()
    {
        error_log('DashAdmin::numUsuarios -> Inicio de numUsuarios');

        $usuario = new Usuario;
        $usuarios = $usuario->numUsuarios();
        return $usuarios;
    }

    public function numProductos()
    {
        error_log('DashAdmin::numProductos -> Inicio de numProductos');

        $producto = new Producto;
        $productos = $producto->numProductos();
        return $productos;
    }

    public function numProveedores()
    {
        error_log('DashAdmin::numProveedores -> Inicio de numProveedores');

        $proveedor = new Proveedor;
        $proveedores = $proveedor->numProveedores();
        return $proveedores;
    }

    public function productoMaxStock()
    {
        try {
            $producto = new Producto;
            $maxStock = $producto->productoMaxStock();
            return $maxStock;
        } catch (Exception $e) {
            error_log('DashAdmin::productoMaxStock -> ERROR: ' . $e);
            return 0;
        }
    }

    public function productoMinStock()
    {
        try {
            $producto = new Producto;
            $minStock = $producto->productoMinStock();
            return $minStock;
        } catch (Exception $e) {
            error_log('DashAdmin::productoMinStock -> ERROR: ' . $e);
            return 0;
        }
    }

    public function mensajeTiempo()
    {
        // Obtener la hora actual
        $hora = date("H");

        // Inicializar variable de mensaje
        $mensaje = '';

        // Determinar el mensaje apropiado según la hora
        if ($hora >= 6 && $hora < 12) {
            $mensaje = 'Buenos días, ';
        } elseif ($hora >= 12 && $hora < 18) {
            $mensaje = 'Buenas tardes, ';
        } else {
            $mensaje = 'Buenas noches, ';
        }

        $mensaje .= $this->usuario->getNombres();

        // Mostrar el mensaje
        return $mensaje;
    }
}
