<?php

declare(strict_types=1);

namespace App\Middleware;

use Framework\Contracts\MiddlewareInterface;
use Framework\TemplateEngine;

class TemplateDataMiddleware implements MiddlewareInterface
{
    public function __construct(private TemplateEngine $view)
    {
        var_dump($this->view);
    }
    public function process(callable $next)
    {
        $this->view->addGloal('title', 'Expence Tracking App');
        $next();
    }
}
