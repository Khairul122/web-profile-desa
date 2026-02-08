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
            // Untuk view dashboard, kita perlu mengizinkan passing data
            extract($data);
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

    /**
     * Convert relative image URLs to absolute URLs for rich text editor
     */
    public function convertRelativeToAbsoluteUrls($content)
    {
        if (empty($content)) {
            return '';
        }

        $baseUrl = rtrim(BASE_URL, '/');

        $content = preg_replace_callback(
            '/<img[^>]*src=["\']([^"\']+)["\'][^>]*>/i',
            function($matches) use ($baseUrl) {
                $fullTag = $matches[0];
                $src = $matches[1];

                if (strpos($src, '../../public/uploads/profile/') !== false) {
                    $filename = basename($src);
                    return str_replace($src, $baseUrl . '/public/uploads/profile/' . $filename, $fullTag);
                }

                return $fullTag;
            },
            $content
        );

        return $content;
    }
}