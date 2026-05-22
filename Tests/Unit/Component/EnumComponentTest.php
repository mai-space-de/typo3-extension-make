<?php

declare(strict_types=1);

namespace Maispace\MaiMake\Tests\Unit\Component;

use Maispace\MaiMake\Component\EnumComponent;
use PHPUnit\Framework\Attributes\Test;
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

    #[Test]
    public function generateStringBackedEnumFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\Enum;', $content);
        self::assertStringContainsString('enum Status: string', $content);
    }

    #[Test]
    public function generateIntBackedEnumFileContentTest(): void
    {
        $this->subject->setBackingType('int');
        $content = $this->subject->__toString();

        self::assertStringContainsString('enum Status: int', $content);
    }

    #[Test]
    public function generatePureEnumFileContentTest(): void
    {
        $this->subject->setBackingType('');
        $content = $this->subject->__toString();

        self::assertStringContainsString('enum Status', $content);
        self::assertStringNotContainsString('enum Status:', $content);
    }

    #[Test]
    public function enumClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Enum\\Status', $this->subject->getClassName());
    }

    #[Test]
    public function backingTypeIsStored(): void
    {
        self::assertEquals('string', $this->subject->getBackingType());
    }
}
