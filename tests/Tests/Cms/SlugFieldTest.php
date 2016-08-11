<?php declare(strict_types = 1);

namespace Dms\Library\Slug\Tests\Cms;
use Dms\Common\Structure\Field;
use Dms\Common\Testing\CmsTestCase;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Library\Slug\Cms\SlugField;
use Dms\Library\Slug\Generator\DashedSlugGenerator;
use Dms\Library\Slug\Tests\Generator\Fixtures\TestEntity;

/**
 *
 * @author Elliot Levin <elliotlevin@hotmail.com>
 */
class SlugFieldTest extends CmsTestCase
{
    public function testSlugField()
    {
        $entities = TestEntity::collection();
        $form     = new CrudFormDefinition($entities, TestEntity::definition(), CrudFormDefinition::MODE_CREATE);

        $form->section('Test', [
            $form->field(
                Field::create('label', 'Label')->string()->required()
            )->withoutBinding()
        ]);

        SlugField::build($form, 'slug', 'Slug', $entities, new DashedSlugGenerator(), 'label', TestEntity::SLUG);

        $this->assertSame(['slug' => 'some-label'], $form->finalize()->getStagedForm()->getFormForStage(2, ['label' => 'Some Label'])->getInitialValues());
    }
}