<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Tests\Unit\Component;

use Maispace\MaiMake\Component\Utility;
use PHPUnit\Framework\TestCase;

class UtilityTest extends TestCase
{
    protected Utility $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Utility('Vendor\\Extension\\');
        $this->subject->setName('StringUtility');
        $this->subject->setDirectory('Utility');
    }

    /**
     * @test
     */
    public function generateUtilityFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\Utility;', $content);
        self::assertStringContainsString('class StringUtility', $content);
    }

    /**
     * @test
     */
    public function utilityClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Utility\\StringUtility', $this->subject->getClassName());
    }
}
