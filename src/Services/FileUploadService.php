<?php

use Smalot\PdfParser\Parser;

class FileUploadService {
    private $tempDirectory;
    private $finalDirectory;

    public function __construct($tempDirectory, $finalDirectory) {
        $this->tempDirectory = $tempDirectory;
        $this->finalDirectory = $finalDirectory;
    }

    public function uploadFile($file) {
        // Verificar se o arquivo é um PDF
        if (!$this->isValidPdf($file['tmp_name'])) {
            throw new Exception('O arquivo não é um PDF válido.');
        }

        // Mover o arquivo para o diretório temporário
        $tempPath = $this->tempDirectory . '/' . basename($file['name']);
        if (!move_uploaded_file($file['tmp_name'], $tempPath)) {
            throw new Exception('Falha ao mover o arquivo para o diretório temporário.');
        }

        return $tempPath;
    }

    public function moveFileToFinal($tempFilePath) {
        $finalPath = $this->finalDirectory . '/' . basename($tempFilePath);
        if (!rename($tempFilePath, $finalPath)) {
            throw new Exception('Falha ao mover o arquivo para o diretório final.');
        }

        return $finalPath;
    }

    private function isValidPdf($filePath) {
        $parser = new Parser();
        try {
            $pdf = $parser->parseFile($filePath);
            return $pdf !== null;
        } catch (Exception $e) {
            return false;
        }
    }
}
