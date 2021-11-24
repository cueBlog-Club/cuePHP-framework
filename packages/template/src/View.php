<?php
declare(strict_types=1);

namespace CuePhp\Template;

use Jenssegers\Blade\Blade;

class View
{

    /**
     * @param string $viewPath
     * @param array $data
     * @return string
     */
    public static function render(string $viewPath, array $data = []): string
    {
        $blade = new Blade(dirname(__DIR__) . '/public/views', dirname(__DIR__) . '/public/cache');
        return $blade->render($viewPath, $data);
    }
}
