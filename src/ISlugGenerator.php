<?php declare(strict_types = 1);

namespace Dms\Library\Slug;

use Dms\Core\Model\IObjectSet;
use Dms\Core\Model\Object\Entity;

/**
 * @author Elliot Levin <elliotlevin@hotmail.com>
 */
interface ISlugGenerator
{
    /**
     * Generates a unique slug for the supplied entity
     *
     * @param IObjectSet  $dataSource
     * @param string      $slugProperty
     * @param string      $label
     * @param Entity|null $entity
     *
     * @return string
     */
    public function generateSlug(IObjectSet $dataSource, string $slugProperty, string $label, Entity $entity = null) : string;
}