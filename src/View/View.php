<?php

namespace PhpMvc\View;
class View
{
    public static function make($view,$layout, $params = [])
    {
        $baseContent = self::getBaseContent($layout);
        $viewContent = self::getViewContent($view, params: $params);
        if (!$layout){echo $viewContent; return;}
        echo str_replace("{{content}}", $viewContent, $baseContent);
    }

    protected static function getBaseContent($layout)
    {
        ob_start();
        include LAYOUTS_PATH . $layout.'.php';
        return ob_get_clean();
    }

    protected static function getViewContent($view, $isError = false, array $params = [])
    {
        //if there is an error return 404 page
        $path = $isError ? VIEWS_PATH . 'errors'.DIRECTORY_SEPARATOR : VIEWS_PATH;

        //if view passed as dir1.dir2.v.php then it will be exploded and converted to views/dir1/
        if (str_contains($view, '.')) {
            $views = explode('.', $view);
            foreach ($views as $view_dir) {
                if (is_dir($path.$view_dir)) {
                    $path .= $view_dir . DIRECTORY_SEPARATOR;
                }
            }
            //add last part ..../v.php
            $view = $path.end($views) . '.php';
        } else {
            //else no dots
            $view = $path . $view . '.php';
        }
        //append parameters to the view file
        foreach ($params as $param => $value) {
            $$param = $value;
        }
        //if error then only return error page
        if ($isError) {
            include($view);
        } else {
            //else start including file
            ob_start();
            include($view);
            return ob_get_clean();
        }


    }

    public static function makeError(string $error)
    {
        self::getViewContent($error,true);
    }

}