<?php

namespace App\Controllers;

require __DIR__.'/../config.php';

use App\Services\FileUploadService;

// Exemplo de uso em um controlador
class ControllerFilesUpload {

    private $fileUploadService;

    public function __construct( ) {
        
        $this->fileUploadService = new FileUploadService(TEMP_DIRECTORY, FINAL_DIRECTORY);
    }

    public function uploadAction() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
            try {
                // Upload do arquivo e validação
                $tempFilePath = $this->fileUploadService->uploadFile($_FILES['file']);

                // Mover o arquivo para o diretório final
                $finalFilePath = $this->fileUploadService->moveFileToFinal($tempFilePath);

                echo "Arquivo enviado e movido com sucesso para: " . $finalFilePath;
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }
        }
    }
}