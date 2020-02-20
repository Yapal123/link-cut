<?php 
namespace core;

class Router 
{
    private static $routes = array();
    
    private function __construct() {}
    private function __clone() {}
    
    /**
     * This method take url pattern and connect it with callback
     * @param string $pattern - pattern of url 
     * @param function $callback - user callback function
     */
    public static function route($pattern, $callback) 
    {
        /**
         * Escaping "/", because it using as regex marker
         */
        $pattern = '/^' . str_replace('/', '\/', $pattern) . '$/';
        self::$routes[$pattern] = $callback;
    }
    
    /**
     * This method compare current url with $routes url`s
     * @param string $url - current url
     */
    public static function execute($url) 
    {
        foreach (self::$routes as $pattern => $callback) 
        {
            if (preg_match($pattern, $url, $params)) // сравнение идет через регулярное выражение
            {
                /**
                 * If match was found - we need to remove first element, because it contain full url string
                 */
                array_shift($params);
                return call_user_func_array($callback, array_values($params));
            }
        }
    }
}