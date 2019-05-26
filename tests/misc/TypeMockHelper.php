<?php
declare(strict_types=1);

namespace Ixocreate\Misc\Schema;

use Ixocreate\Schema\Type\Type;
use Ixocreate\Schema\Type\TypeInterface;
use Ixocreate\ServiceManager\Exception\ServiceNotFoundException;
use Ixocreate\ServiceManager\SubManager\SubManagerInterface;
use PHPUnit\Framework\MockObject\MockBuilder;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class TypeMockHelper
{
    /**
     * @var TestCase
     */
    private $testCase;
    /**
     * @var array
     */
    private $typesToRegister;
    /**
     * @var bool
     */
    private $strictRegisterCheck;

    public function __construct(TestCase $testCase, array $typesToRegister = [], bool $strictRegisterCheck = false)
    {
        $this->testCase = $testCase;
        $this->typesToRegister = $typesToRegister;
        $this->strictRegisterCheck = $strictRegisterCheck;
    }

    public function create(): void
    {
        $reflection = new ReflectionClass(Type::class);
        $type = $reflection->newInstanceWithoutConstructor();

        $container = (new MockBuilder($this->testCase, SubManagerInterface::class))
            ->disableOriginalConstructor()
            ->disableOriginalClone()
            ->disableArgumentCloning()
            ->disallowMockingUnknownTypes()
            ->getMock();


        $container->method('get')->willReturnCallback(function ($requestedName) {
            if (\array_key_exists($requestedName, $this->typesToRegister)) {
                return $this->typesToRegister[$requestedName];
            }

            if ($this->strictRegisterCheck === true) {
                throw new ServiceNotFoundException('Type not found');
            }

            return (new MockBuilder($this->testCase, TypeInterface::class))
                ->disableOriginalConstructor()
                ->disableOriginalClone()
                ->disableArgumentCloning()
                ->disallowMockingUnknownTypes()
                ->getMock();
        });

        $container->method('has')->willReturnCallback(function ($requestedName) {
            if (\array_key_exists($requestedName, $this->typesToRegister)) {
                return true;
            }

            if ($this->strictRegisterCheck === true) {
                return false;
            }

            return true;
        });

        $reflection = new \ReflectionProperty($type, 'subManager');
        $reflection->setAccessible(true);
        $reflection->setValue($type, $container);

        $reflection = new \ReflectionProperty(Type::class, 'type');
        $reflection->setAccessible(true);
        $reflection->setValue($type);
    }
}
