<?php

declare(strict_types = 1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\RouteEnhancer;
use PHPUnit\Framework\TestCase;

class RouteEnhancerTest extends TestCase
{
    protected RouteEnhancer $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new RouteEnhancer('Vendor\\Extension\\');
        $this->subject->setName('BlogRouteEnhancer');
        $this->subject->setDirectory('Routing/Enhancer');
    }

    /**
     * @test
     */
    public function generateRouteEnhancerFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\Routing\Enhancer;', $content);
        self::assertStringContainsString('class BlogRouteEnhancer implements EnhancerInterface', $content);
        self::assertStringContainsString('public function enhanceForMatching(RouteCollection $collection): void', $content);
        self::assertStringContainsString('public function enhanceForGeneration(RouteCollection $collection, array $originalParameters): void', $content);
    }

    /**
     * @test
     */
    public function routeEnhancerClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Routing\\Enhancer\\BlogRouteEnhancer', $this->subject->getClassName());
    }
}
