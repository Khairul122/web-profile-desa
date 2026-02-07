<?php
namespace User\WebDesa\Core;

/**
 * Kelas utama controller
 */
class Controller
{
    /**
     * Method untuk memanggil view
     */
    public function view($view, $data = [])
    {
        $viewPath = '../app/views/' . $view . '.php';
        
        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die('View tidak ditemukan: ' . $viewPath);
        }
    }
    
    /**
     * Method untuk memanggil model
     */
    public function model($model)
    {
        $modelPath = '../app/models/' . $model . '.php';
        
        if (file_exists($modelPath)) {
            require_once $modelPath;
            
            $modelName = '\\User\\WebDesa\\Models\\' . $model;
            return new $modelName;
        } else {
            die('Model tidak ditemukan: ' . $modelPath);
        }
    }
}