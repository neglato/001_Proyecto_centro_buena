<?php

/*Inicializamos la funcion breadcrumbs() con dos variables fijas que serian $separator la cual asignara el separador de cada fase del breadcrumbs, en este caso es el simbolo '>>' y $home que sera el reemplazo a la variable raiz del sistema.*/

function breadcrumbs($separator = ' >> ', $home = 'Inicio') {
    
    /*$path cortara las cadenas de palabras cuando encuentre un '/' en la url para formar las rutas de nuestro breadcrumbs.*/
    
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
    
    /*$base sera la encargada de rastrear la raiz de la url ya sea http o https.*/
    
    $base = ($_SERVER['HTTPS'] ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
    
    /*$breadcrumbs creara el primer link en este caso sera nuestra variable $home, $last es quien tomara la ultima variable de nuestro array.*/
    
    $breadcrumbs = array('<a href="'. $base .'" class="migas">'. $home .'</a>');
 
    $last = end(array_keys($path));
    
   /* Generamos un bucle, de esta forma recorrera el array completo generado anteriormente, tomando las 'key' de los array es decir las palabras claves no el contenido, sacamos las extension (en este caso remplaza las extensiones php y _) creado el breadcrumbs.*/
 
    foreach ($path as $x => $crumb) {
        $title = ucwords(str_replace(array('.php', '_'), array('', ' '), $crumb));
 
        if ($x != $last) {
            $breadcrumbs[] = '<a href="'. $base . $crumb .'" class="migas">'. $title .'</a>';
        } else {
            $breadcrumbs[] = $title;
        }
    }
 
    return implode($separator, $breadcrumbs);
}
?> 