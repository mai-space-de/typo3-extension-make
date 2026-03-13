<?php

declare(strict_types = 1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\EnumComponent;
use PHPUnit\Framework\TestCase;

class EnumComponentTest extends TestCase
{
    protected EnumComponent $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new EnumComponent('Vendor\\Extension\\');
        $this->subject->setName('Status');
        $this->subject->setDirectory('Enum');
        $this->subject->setBackingType('string');
    }

    /**
     * @test
     */
    public function generateStringBackedEnumFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\Enum;', $content);
        self::assertStringContainsString('enum Status: string', $content);
    }

    /**
     * @test
     */
    public function generateIntBackedEnumFileContentTest(): void
    {
        $this->subject->setBackingType('int');
        $content = $this->subject->__toString();

        self::assertStringContainsString('enum Status: int', $content);
    }

    /**
     * @test
     */
    public function generatePureEnumFileContentTest(): void
    {
        $this->subject->setBackingType('');
        $content = $this->subject->__toString();

        self::assertStringContainsString('enum Status', $content);
        self::assertStringNotContainsString('enum Status:', $content);
    }

    /**
     * @test
     */
    public function enumClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Enum\\Status', $this->subject->getClassName());
    }

    /**
     * @test
     */
    public function backingTypeIsStored(): void
    {
        self::assertEquals('string', $this->subject->getBackingType());
    }
}
