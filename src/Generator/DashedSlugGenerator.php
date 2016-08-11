<?php declare(strict_types = 1);

namespace Dms\Library\Slug\Generator;

use Dms\Core\Model\IObjectSet;
use Dms\Core\Model\Object\Entity;
use Dms\Library\Slug\ISlugGenerator;

/**
 * @author Elliot Levin <elliotlevin@hotmail.com>
 */
class DashedSlugGenerator implements ISlugGenerator
{
    /**
     * @inheritdoc
     */
    public function generateSlug(IObjectSet $dataSource, string $slugProperty, string $label, Entity $entity = null) : string
    {
        $slug = preg_replace('~[^\pL\d]+~u', '-', $label);
        $slug = iconv('utf-8', 'us-ascii//TRANSLIT', $slug);
        $slug = preg_replace('~[^-\w]+~', '', $slug);
        $slug = trim($slug, '-');
        $slug = preg_replace('~-+~', '-', $slug);
        $slug = strtolower($slug);

        if (empty($slug)) {
            $slug = 'default';
        }

        $uniqueSlug = $slug;
        $i          = 1;

        while ($dataSource->countMatching(
                $dataSource->criteria()
                    ->where($slugProperty, '=', $uniqueSlug)
                    ->where(Entity::ID, '!=', $entity ? $entity->getId() : null)
            ) > 0) {
            $uniqueSlug = $slug . '-' . $i;
            $i++;
        }

        return $uniqueSlug;
    }
}