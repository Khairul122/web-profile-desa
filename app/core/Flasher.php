<?php
namespace User\WebDesa\Core;

/**
 * Kelas untuk notifikasi sederhana menggunakan JavaScript alert
 */
class Flasher
{
    /**
     * Method untuk menampilkan pesan
     */
    public static function setMessage($type, $message)
    {
        $_SESSION['message'] = [
            'type' => $type,
            'text' => $message
        ];
    }

    /**
     * Method untuk menampilkan pesan
     */
    public static function getMessage()
    {
        if (isset($_SESSION['message'])) {
            $message = $_SESSION['message'];
            unset($_SESSION['message']);

            // Escape untuk mencegah XSS
            $escapedText = addslashes(htmlspecialchars($message['text'], ENT_QUOTES, 'UTF-8'));
            
            // Return script alert sederhana untuk ditampilkan di view
            return '<script>alert("' . $escapedText . '");</script>';
        }
        return '';
    }
}