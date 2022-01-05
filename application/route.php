<?php
class Route
{
	public static function start()
	{
		
		// контроллер и действие по умолчанию
		$controller_name = 'Main';
             $action_name = 'index';
			 if(array_key_exists('url', $_GET))
			 {
	             $routes = $_GET['url'];
			 }
			 else
			 {
				 $routes='';
			 }
		
		// получаем имя контроллера
		if ( !empty($routes) )
		{	
			$controller_name = $routes;
		}
		else
		{
			$controller_name = "main";
		}
		
		// добавляем префиксы
		$model_name = 'model_'.$controller_name;
		$controller_name = 'controller_'.$controller_name;
		$action_name = 'action_'.$action_name;
		// подцепляем файл с классом модели (файла модели может и не быть)
		$model_file = strtolower($model_name).'.php';
		$model_path = "models/".$model_file;
		
		if(file_exists($model_path))
		{
			
			include $model_path;
		}
		// подцепляем файл с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = "controllers/".$controller_file;
		
		if(file_exists($controller_path))
		{
			include $controller_path;
		}
		else
		{
			
			Route::ErrorPage404();
		}
		// создаем контроллер
		$controller = new $controller_name;
		$action = $action_name;
		if(method_exists($controller, $action))
		{
			// вызываем действие контроллера
			$controller->$action();
		}
		else
		{
			
		    Route::ErrorPage404();
		}
	}
	static function ErrorPage404()
	{
                        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
                         header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
}
?>