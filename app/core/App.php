<?php
namespace User\WebDesa\Core;

/**
 * Kelas routing untuk menangani URL dinamis
 */
class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $this->routeRequest();
    }
    
    public function routeRequest()
    {
        $url = $this->parseUrl();
        
        // Gabungkan URL untuk mencocokkan dengan route
        $routeKey = $url ? implode('/', $url) : '';
        
        // Muat file route
        $routes = require_once __DIR__ . '/Route.php';
        
        // Cek apakah route ada di definisi route
        if (isset($routes[$routeKey])) {
            $route = $routes[$routeKey];
            
            // Set controller dan method berdasarkan route
            $this->controller = $route['controller'];
            $this->method = $route['method'];
            
            // Include controller
            $controllerPath = __DIR__ . '/../controllers/' . $this->controller . '.php';
            if(file_exists($controllerPath)) {
                require_once $controllerPath;
            } else {
                // Jika controller tidak ditemukan, gunakan controller default
                $this->controller = 'HomeController';
                $controllerPath = __DIR__ . '/../controllers/' . $this->controller . '.php';
                require_once $controllerPath;
            }
            
            // Instansiasi controller
            $className = '\\User\\WebDesa\\Controllers\\' . $this->controller;
            $this->controller = new $className;
            
            // Tidak ada parameter tambahan karena route sudah didefinisikan
            $this->params = [];
        } else {
            // Jika route tidak ditemukan, gunakan pendekatan lama untuk kompatibilitas
            $this->handleLegacyRoute($url);
        }
        
        // Jalankan controller dan method, serta kirimkan params jika ada
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
    
    /**
     * Fungsi untuk menangani route lama sebagai fallback
     */
    private function handleLegacyRoute($url)
    {
        // Jika tidak ada URL, gunakan HomeController sebagai default
        if (!$url) {
            $this->controller = 'HomeController';
        } else {
            // Cek apakah controller yang diminta ada (format Controller.php)
            $controllerName = ucfirst($url[0]);
            // Konversi format seperti 'auth' menjadi 'AuthController'
            if (file_exists(__DIR__ . '/../controllers/' . $controllerName . 'Controller.php')) {
                $this->controller = $controllerName . 'Controller';
                unset($url[0]);
            } 
            // Cek apakah controller yang diminta ada (format .php)
            elseif (file_exists(__DIR__ . '/../controllers/' . $url[0] . '.php')) {
                $this->controller = $url[0];
                unset($url[0]);
            } else {
                // Jika tidak ada yang cocok, tetap gunakan HomeController
                $this->controller = 'HomeController';
            }
        }
        
        // Include controller
        $controllerPath = __DIR__ . '/../controllers/' . $this->controller . '.php';
        if(file_exists($controllerPath)) {
            require_once $controllerPath;
        } else {
            // Jika tetap tidak ditemukan, arahkan ke controller HomeController
            $this->controller = 'HomeController';
            $controllerPath = __DIR__ . '/../controllers/' . $this->controller . '.php';
            require_once $controllerPath;
        }
        
        // Instansiasi controller
        $className = '\\User\\WebDesa\\Controllers\\' . $this->controller;
        $this->controller = new $className;
        
        // Cek method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        
        // Parameter
        $this->params = $url ? array_values($url) : [];
    }
    
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
        return [];
    }
    
    public function run()
    {
        $this->routeRequest();
    }
}