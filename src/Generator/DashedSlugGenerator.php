<?php declare(strict_types = 1);

namespace Dms\Library\Slug\Generator;

use Dms\Core\Model\IObjectSet;
use Dms\Core\Model\Object\Entity;
use Dms\Library\Slug\ISlugGenerator;
use Illuminate\Support\Str;

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
        $slug = Str::slug($label);

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
