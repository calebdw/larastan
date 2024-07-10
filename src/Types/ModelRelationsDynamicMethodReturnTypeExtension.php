<?php

declare(strict_types=1);

namespace Larastan\Larastan\Types;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Relation;
use Larastan\Larastan\Concerns\HasContainer;
use PhpParser\Node\Expr\MethodCall;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\ShouldNotHappenException;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\Generic\GenericObjectType;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;

use function array_map;
use function count;
use function in_array;
use function version_compare;

class ModelRelationsDynamicMethodReturnTypeExtension implements DynamicMethodReturnTypeExtension
{
    use HasContainer;

    public function __construct(private RelationParserHelper $relationParserHelper)
    {
    }

    public function getClass(): string
    {
        return Model::class;
    }

    public function isMethodSupported(MethodReflection $methodReflection): bool
    {
        $variants = ParametersAcceptorSelector::selectSingle($methodReflection->getVariants());

        $returnType = $variants->getReturnType();

        $classNames = $returnType->getObjectClassNames();

        if (count($classNames) !== 1) {
            return false;
        }

        if (! (new ObjectType(Relation::class))->isSuperTypeOf($returnType)->yes()) {
            return false;
        }

        if (! $methodReflection->getDeclaringClass()->hasNativeMethod($methodReflection->getName())) {
            return false;
        }

        if (count($variants->getParameters()) !== 0) {
            return false;
        }

        if (
            in_array($methodReflection->getName(), [
                'hasOne',
                'hasOneThrough',
                'morphOne',
                'belongsTo',
                'morphTo',
                'hasMany',
                'hasManyThrough',
                'morphMany',
                'belongsToMany',
                'morphToMany',
                'morphedByMany',
            ], true)
        ) {
            return false;
        }

        $models = $this
            ->relationParserHelper
            ->findModelsInRelationMethod($methodReflection);

        return count($models) !== 0;
    }

    /**
     * @return Type
     *
     * @throws ShouldNotHappenException
     */
    public function getTypeFromMethodCall(
        MethodReflection $methodReflection,
        MethodCall $methodCall,
        Scope $scope,
    ): Type|null {
        $returnType                 = ParametersAcceptorSelector::selectSingle($methodReflection->getVariants())->getReturnType();
        $returnTypeObjectClassNames = $returnType->getObjectClassNames();

        if ($returnTypeObjectClassNames === []) {
            return null;
        }

        $models = $this->relationParserHelper->findModelsInRelationMethod($methodReflection);

        $types   = array_map(static fn ($model) => new ObjectType((string) $model), $models);
        $types[] = $scope->getType($methodCall->var);

        if (
            // @phpstan-ignore-next-line
            version_compare(LARAVEL_VERSION, '11.0.0', '<')
            && ! (new ObjectType(BelongsTo::class))->isSuperTypeOf($returnType)->yes()
        ) {
            $types = [$types[0]];
        }

        return new GenericObjectType($returnTypeObjectClassNames[0], $types);
    }
}
