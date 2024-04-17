<?php

declare(strict_types=1);

namespace Larastan\Larastan\ReturnTypes;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Larastan\Larastan\Types\Factory\ModelFactoryType;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Name;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ReflectionProvider;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Accessory\AccessoryNumericStringType;
use PHPStan\Type\DynamicStaticMethodReturnTypeExtension;
use PHPStan\Type\ErrorType;
use PHPStan\Type\FloatType;
use PHPStan\Type\IntegerType;
use PHPStan\Type\IntersectionType;
use PHPStan\Type\StringType;
use PHPStan\Type\Type;
use PHPStan\Type\UnionType;

use function class_exists;
use function count;
use function ltrim;

final class ModelFactoryDynamicStaticMethodReturnTypeExtension implements DynamicStaticMethodReturnTypeExtension
{
    public function __construct(
        private ReflectionProvider $reflectionProvider,
    ) {
    }

    public function getClass(): string
    {
        return Model::class;
    }

    public function isStaticMethodSupported(MethodReflection $methodReflection): bool
    {
        return $methodReflection->getName() === 'factory';
    }

    public function getTypeFromStaticMethodCall(
        MethodReflection $methodReflection,
        StaticCall $methodCall,
        Scope $scope,
    ): Type {
        $class = $methodCall->class;

        if (! $class instanceof Name) {
            return new ErrorType();
        }

        if (count($methodCall->getArgs()) === 0) {
            $isSingleModel = TrinaryLogic::createYes();
        } else {
            $argType = $scope->getType($methodCall->getArgs()[0]->value);

            $numericTypes = [
                new IntegerType(),
                new FloatType(),
                new IntersectionType([
                    new StringType(),
                    new AccessoryNumericStringType(),
                ]),
            ];

            $isSingleModel = (new UnionType($numericTypes))->isSuperTypeOf($argType)->negate();
        }

        $factoryClass = $this->getFactoryClass($class, $scope);

        if ($factoryClass === null) {
            return new ErrorType();
        }

        return new ModelFactoryType($factoryClass, null, null, $isSingleModel);
    }

    private function getFactoryClass(Name $model, Scope $scope): string|null
    {
        $factoryClass = $this->getFactoryClassFromNewFactoryMethod($model, $scope);

        if ($factoryClass !== null) {
            return $factoryClass;
        }

        $factoryClass = Factory::resolveFactoryName(ltrim($model->toCodeString(), '\\')); // @phpstan-ignore-line

        if (class_exists($factoryClass)) {
            return $factoryClass;
        }

        return null;
    }

    private function getFactoryClassFromNewFactoryMethod(Name $model, Scope $scope): string|null
    {
        $modelReflection = $this->reflectionProvider->getClass($model->toString());

        if (! $modelReflection->hasMethod('newFactory')) {
            return null;
        }

        $returnType = $modelReflection->getMethod('newFactory', $scope)
            ->getVariants()[0]
            ->getReturnType();

        $factoryClasses = $returnType->getObjectClassNames();

        if (count($factoryClasses) !== 1) {
            return null;
        }

        $factoryReflection = $this->reflectionProvider->getClass($factoryClasses[0]);

        if (
            ! $factoryReflection->isSubclassOf(Factory::class)
            || $factoryReflection->isAbstract()
        ) {
            return null;
        }

        return $factoryReflection->getName();
    }
}
