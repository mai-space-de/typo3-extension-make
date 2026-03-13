<?php

declare(strict_types = 1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\DataProcessor;
use PHPUnit\Framework\TestCase;

class DataProcessorTest extends TestCase
{
    protected DataProcessor $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new DataProcessor('Vendor\\Extension\\');
        $this->subject->setName('MyDataProcessor');
        $this->subject->setDirectory('DataProcessing');
    }

    /**
     * @test
     */
    public function generateDataProcessorFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\DataProcessing;', $content);
        self::assertStringContainsString('class MyDataProcessor implements DataProcessorInterface', $content);
        self::assertStringContainsString('public function process(', $content);
    }

    /**
     * @test
     */
    public function dataProcessorClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\DataProcessing\\MyDataProcessor', $this->subject->getClassName());
    }
}
