<?php

namespace Clickpress\ContaoVerkehrsmeldungen\ContaoManager;

use Clickpress\ContaoVerkehrsmeldungen\ContaoVerkehrsmeldungen;
use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;

class Plugin implements BundlePluginInterface
{
    public function getBundles(ParserInterface $parser): array
    {
        return [
            BundleConfig::create(ContaoVerkehrsmeldungen::class)
                ->setLoadAfter([ContaoCoreBundle::class]),
        ];
    }
}
