<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Tests\Unit\Component;

use Maispace\MaiMake\Component\Hook;
use PHPUnit\Framework\TestCase;

class HookTest extends TestCase
{
    protected Hook $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Hook('Vendor\\Extension\\');
        $this->subject->setName('PageHook');
        $this->subject->setDirectory('Hook');
    }

    /**
     * @test
     */
    public function generateHookFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\Hook;', $content);
        self::assertStringContainsString('class PageHook', $content);
    }

    /**
     * @test
     */
    public function hookClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Hook\\PageHook', $this->subject->getClassName());
    }
}
