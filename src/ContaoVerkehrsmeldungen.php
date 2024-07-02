<?php

namespace Clickpress\ContaoVerkehrsmeldungen;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoVerkehrsmeldungen extends Bundle
{
    public function getPath(): string
    {
        return dirname(__DIR__);
    }
}
