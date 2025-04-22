<?php
// namespace App\Controllers;

class BaseController
{
    const VIEW_FOLDER_NAME = 'Views';
    const MODEL_FOLDER_NAME = 'Models';
    protected function view($view_path, array $data = [])
    {
        foreach ($data as $key => $value) {
            $$key = $value; 
        }
        $view_path = self::VIEW_FOLDER_NAME . '/' . str_replace('.','/',$view_path) .'.php';
        return require $view_path;
    }
    protected function model($model_path)
    {
        $modelClassName = ucfirst(strtolower($model_path)) . 'Model';
        $modelFilePath = self::MODEL_FOLDER_NAME . '/' . $modelClassName . '.php';
        
        require_once $modelFilePath;

        return new $modelClassName();  // <- Tạo object model và trả về
    }
}
