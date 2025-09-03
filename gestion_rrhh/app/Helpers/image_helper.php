<?php

use CodeIgniter\Files\File;

/**
 * Verifica si el archivo tiene un tipo MIME permitido.
 *
 * @param \CodeIgniter\Files\File $file El archivo a verificar.
 * @return bool True si el tipo MIME está permitido, False en caso contrario.
 */
if (!function_exists('isValidImage')) {
    function isValidImage(File $file): bool
    {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/avif'];
        return in_array($file->getMimeType(), $allowedTypes);
    }
}

/**
 * Guarda una imagen en la carpeta de uploads con un nombre basado en el nombre y apellido proporcionados.
 *
 * @param \CodeIgniter\Files\File $file El archivo de imagen a guardar.
 * @param string $nombre El nombre para el archivo.
 * @param string $apellido El apellido para el archivo.
 * @return string La ruta del nuevo archivo guardado.
 * @throws \RuntimeException Si hay un error durante el guardado.
 */
if (!function_exists('saveImageWithCustomName')) {
    function saveImageWithCustomName(File $file, string $nombre, string $apellido): string
    {
        if ($file->isValid() && !$file->hasMoved()) {
            // Generar un nombre único para el archivo de imagen
            $imageName = $file->getRandomName();
            // Mover el archivo de imagen a la carpeta de destino
            $file->move(ROOTPATH . 'public/uploads', $imageName);
        } else {
            $imageName = 'default.png';
        }
        return $imageName;
        // Genera un nombre de archivo aleatorio
        // $randomNumber = rand(1000, 9999);
        // $extension = $file->getExtension(); // Obtén la extensión del archivo original
        // $newFileName = $nombre . $apellido . '_' . $randomNumber . '.' . $extension;
        // //$newFilePath = WRITEPATH . 'public/uploads' . $newFileName;

        // try {
        //     // Mueve el archivo a la carpeta de uploads con el nuevo nombre
        //     $file->move(WRITEPATH . 'public/uploads', $newFileName);

        //     return $newFilePath;
        // } catch (Exception $e) {
        //     log_message('error', 'Error al guardar la imagen: ' . $e->getMessage());
        //     throw new RuntimeException('Error al guardar la imagen.');
        // }
    }
}
