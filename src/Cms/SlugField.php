<?php declare(strict_types = 1);

namespace Dms\Library\Slug\Cms;

use Dms\Common\Structure\Field;
use Dms\Core\Common\Crud\Definition\Form\CrudFormDefinition;
use Dms\Core\Model\IObjectSet;
use Dms\Core\Model\Object\Entity;
use Dms\Library\Slug\ISlugGenerator;

/**
 * @author Elliot Levin <elliotlevin@hotmail.com>
 */
class SlugField
{
    /**
     * @param CrudFormDefinition $form
     * @param string             $fieldName
     * @param string             $fieldLabel
     * @param IObjectSet         $dataSource
     * @param ISlugGenerator     $slugGenerator
     * @param string             $labelFieldName
     * @param string             $slugProperty
     *
     * @throws \Dms\Core\Exception\InvalidOperationException
     */
    public static function build(
        CrudFormDefinition $form,
        string $fieldName,
        string $fieldLabel,
        IObjectSet $dataSource,
        ISlugGenerator $slugGenerator,
        string $labelFieldName,
        string $slugProperty
    ) {
        $form->dependentOn(
            [$labelFieldName],
            function (CrudFormDefinition $form, array $input, Entity $entity = null) use (
                $fieldName,
                $fieldLabel,
                $dataSource,
                $slugGenerator,
                $labelFieldName,
                $slugProperty
            ) {
                $value = $slugGenerator->generateSlug($dataSource, $slugProperty, $input[$labelFieldName], $entity);

                $form->continueSection([
                    $form->field(
                        Field::create($fieldName, $fieldLabel)->string()->required()->value($value)
                            ->uniqueIn($dataSource, $slugProperty)
                    )->bindToProperty($slugProperty),
                ]);
            }
        );
    }
}