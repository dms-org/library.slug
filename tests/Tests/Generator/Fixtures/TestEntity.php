<?php declare(strict_types = 1);

namespace Dms\Library\Slug\Tests\Generator\Fixtures;

use Dms\Core\Model\Object\ClassDefinition;
use Dms\Core\Model\Object\Entity;

/**
 *
 * @author Elliot Levin <elliotlevin@hotmail.com>
 */
class TestEntity extends Entity
{
    const SLUG = 'slug';
    
    /**
     * @var string
     */
    public $slug;

    /**
     * TestEntity constructor.
     *
     * @param int    $id
     * @param string $slug
     */
    public function __construct(int $id, string $slug)
    {
        parent::__construct($id);
        $this->slug = $slug;
    }


    /**
     * Defines the structure of this entity.
     *
     * @param ClassDefinition $class
     */
    protected function defineEntity(ClassDefinition $class)
    {
        $class->property($this->slug)->asString();
    }
}