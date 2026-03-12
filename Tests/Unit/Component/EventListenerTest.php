<?php

declare(strict_types = 1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\EventListener;
use PHPUnit\Framework\TestCase;

class EventListenerTest extends TestCase
{
    protected EventListener $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new EventListener('Vendor\\Extension\\');
        $this->subject->setEventName('\\TYPO3\\CMS\\Core\\Mail\\Event\\AfterMailerSentMessageEvent');
        $this->subject->setName('AfterMailerSentMessageEventListener');
        $this->subject->setDirectory('EventListener');
        $this->subject->setIdentifier('vendor/extension/after-mailer-sent');
        $this->subject->setMethodName('');
    }

    /**
     * @test
     */
    public function generateEventListenerFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\EventListener;', $content);
        self::assertStringContainsString('final class AfterMailerSentMessageEventListener', $content);
        self::assertStringContainsString('public function __invoke(', $content);
        self::assertStringContainsString('\\TYPO3\\CMS\\Core\\Mail\\Event\\AfterMailerSentMessageEvent $event', $content);
    }

    /**
     * @test
     */
    public function customMethodNameIsUsed(): void
    {
        $this->subject->setMethodName('handle');
        $content = $this->subject->__toString();

        self::assertStringContainsString('public function handle(', $content);
    }

    /**
     * @test
     */
    public function serviceConfigurationContainsEventListenerTag(): void
    {
        $config = $this->subject->getServiceConfiguration();
        $className = $this->subject->getClassName();

        self::assertArrayHasKey($className, $config);
        self::assertEquals('event.listener', $config[$className]['tags'][0]['name']);
        self::assertEquals('vendor/extension/after-mailer-sent', $config[$className]['tags'][0]['identifier']);
    }

    /**
     * @test
     */
    public function serviceConfigurationContainsMethodWhenSet(): void
    {
        $this->subject->setMethodName('handle');
        $config = $this->subject->getServiceConfiguration();
        $className = $this->subject->getClassName();

        self::assertEquals('handle', $config[$className]['tags'][0]['method']);
    }

    /**
     * @test
     */
    public function nameProposalFromEventName(): void
    {
        self::assertEquals('AfterMailerSentMessageEventListener', $this->subject->getNameProposal());
    }
}
