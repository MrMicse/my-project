<?php
// Проверяем, что файл загружен
if ($_FILES['files']) {
    $uploadedFiles = [];
    
    foreach ($_FILES['files']['name'] as $key => $name) {
        $file = [
            'name' => $_FILES['files']['name'][$key],
            'size' => $_FILES['files']['size'][$key],
            'tmp_name' => $_FILES['files']['tmp_name'][$key],
            'error' => $_FILES['files']['error'][$key]
        ];
        
        // Проверяем ошибки загрузки
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Указываем директорию для сохранения файлов
            $uploadDir = 'uploads/';
            
            // Создаем директорию, если не существует
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            
            // Сохраняем файл
            $uploadFile = $uploadDir . basename($file['name']);
            if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
                $uploadedFiles[] = [
                    'name' => $file['name'],
                    'size' => $file['size'],
                    'downloadUrl' => '/uploads/' . $file['name']
                ];
            }
        }
    }
    
    //