<?php declare(strict_types = 1);

namespace Dms\Library\Slug\Tests\Generator;

use Dms\Common\Testing\CmsTestCase;
use Dms\Library\Slug\Generator\DashedSlugGenerator;
use Dms\Library\Slug\Tests\Generator\Fixtures\TestEntity;

/**
 * @author Elliot Levin <elliotlevin@hotmail.com>
 */
class DashedSlugGeneratorTest extends CmsTestCase
{
    /**
     * @var DashedSlugGenerator
     */
    protected $slugGenerator;

    public function setUp()
    {
        $this->slugGenerator = new DashedSlugGenerator();
    }

    public function testSlugWithNoOtherEntities()
    {
        $this->assertSame('some-label', $this->slugGenerator->generateSlug(TestEntity::collection(), TestEntity::SLUG, 'Some Label', null));
    }

    public function testSlugWithOtherEntities()
    {
        $this->assertSame('some-label-2', $this->slugGenerator->generateSlug(TestEntity::collection([
            new TestEntity(1, 'some-label'),
            new TestEntity(1, 'some-label-1'),
        ]), TestEntity::SLUG, 'Some Label', null));
    }
}