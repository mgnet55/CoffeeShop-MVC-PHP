<?php

namespace PhpMvc;

use PhpMvc\Database\DB;
use PhpMvc\Database\Managers\Contracts\DatabaseManager;
use PhpMvc\Database\Managers\MysqlManager;
use PhpMvc\Http\Request;
use PhpMvc\Http\Response;
use PhpMvc\Http\Route;
use PhpMvc\Support\Config;
use PhpMvc\Support\Session;

class Application
{
    protected Route $route;
    protected Request $request;
    protected Response $response;
    protected Config $config;
    protected DB $db;
    protected Session $session;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->session = new Session;
        $this->db = new DB($this->getDatabaseDriver());
        $this->route = new Route($this->request, $this->response);
        $this->config = new Config($this->loadConfiguration());
    }

    protected function getDatabaseDriver(): DatabaseManager
    {
        return match(env('DB_DRIVER','mysql')) {
            'mysql' => new MysqlManager,
        };
    }

    public function run()
    {
        $this->db->init();
        $this->route->resolve();

    }

    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        return null;
    }

    protected function loadConfiguration()
    {
        foreach (scandir(CONFIG_PATH) as $file) {
            if (in_array($file, ['.', '..'])) {
                continue;
            }
            $filename = explode('.', $file)[0];
            yield $filename => require CONFIG_PATH . $file;
        }

    }

}