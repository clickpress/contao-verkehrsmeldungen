<?php
namespace Clickpress\ContaoVerkehrsmeldungen\EventListener\DataContainer;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Doctrine\DBAL\Connection;

#[AsCallback(table: 'tl_verkehrsmeldungen_detail', target: 'list.sorting.child_record ')]
class ChildRecordCallback
{
    public function __invoke(array $records): array
    {

        dump($records);

        return $records;
    }
}