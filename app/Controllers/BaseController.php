<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController proporciona un lugar conveniente para cargar componentes
 * y realizar funciones que son necesarias para todos tus controladores.
 * Extiende esta clase en cualquier nuevo controlador:
 *     class Home extends BaseController
 *
 * Para mayor seguridad, asegúrate de declarar cualquier nuevo método como protected o private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instancia de la solicitud principal.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * Una instancia de Helpers a cargar automáticamente tras la instanciación.
     * Estos helpers estarán disponibles para todos los controladores que hereden de BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Sé que el constructor no se puede evitar. Pero no olvides jugar bien
     * con él y llamar a parent::__construct($request, $response, $logger);
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // No edites esta línea
        parent::initController($request, $response, $logger);

        // Precarga cualquier modelo, biblioteca, etc, aquí.

        // Ejemplo:
        // $this->session = \Config\Services::session();
    }
}