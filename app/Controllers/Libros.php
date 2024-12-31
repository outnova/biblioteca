<?php 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\Controller;
use App\Models\libro;

class Libros extends BaseController {

    /**
	 * Instance of the main Request object.
	 *
     * @var \CodeIgniter\HTTP\IncomingRequest
	 */
	protected $request;
    public function index() {

        $libro = new Libro();
        $datos['libros'] = $libro->orderBy('id', 'ASC')->findAll();

        $datos['header'] = view('templates/header');
        $datos['footer'] = view('templates/footer');

        return view('libros/listar', $datos);
    }

    public function crear() {

        $datos['header'] = view('templates/header');
        $datos['footer'] = view('templates/footer');

        return view('libros/crear', $datos);
    }

    public function guardar() {

        $libro = new Libro();

        if($imagen=$this->request->getFile('imagen')) {
            $nuevoNombre = $imagen->getRandomName();
            $imagen->move('../public/uploads/', $nuevoNombre);

            $datos = [
                'nombre' => $this->request->getVar('nombre'),
                'imagen' => $nuevoNombre
            ];  

            $libro->insert($datos);
        }

        echo "Ingresado a la BD";
    }
}