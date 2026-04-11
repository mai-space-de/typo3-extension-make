<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Tests\Unit\Component;

use Maispace\MaiMake\Component\Factory;
use PHPUnit\Framework\TestCase;

class FactoryTest extends TestCase
{
    protected Factory $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Factory('Vendor\\Extension\\');
        $this->subject->setName('UserFactory');
        $this->subject->setDirectory('Factory');
    }

    /**
     * @test
     */
    public function generateFactoryFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\Factory;', $content);
        self::assertStringContainsString('class UserFactory', $content);
    }

    /**
     * @test
     */
    public function factoryClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Factory\\UserFactory', $this->subject->getClassName());
    }
}
