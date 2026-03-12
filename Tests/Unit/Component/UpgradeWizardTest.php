<?php

declare(strict_types=1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\UpgradeWizard;
use PHPUnit\Framework\TestCase;

class UpgradeWizardTest extends TestCase
{
    protected UpgradeWizard $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new UpgradeWizard('Vendor\\Extension\\');
        $this->subject->setName('MigrateSlugUpgradeWizard');
        $this->subject->setDirectory('UpgradeWizard');
        $this->subject->setIdentifier('vendorExtensionMigrateSlug');
        $this->subject->setTitle('Migrate page slugs');
    }

    /**
     * @test
     */
    public function generateUpgradeWizardFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\UpgradeWizard;', $content);
        self::assertStringContainsString('class MigrateSlugUpgradeWizard implements UpgradeWizardInterface', $content);
        self::assertStringContainsString('#[UpgradeWizard(\'vendorExtensionMigrateSlug\')]', $content);
        self::assertStringContainsString('return \'Migrate page slugs\';', $content);
        self::assertStringContainsString('public function executeUpdate(): bool', $content);
        self::assertStringContainsString('public function updateNecessary(): bool', $content);
    }

    /**
     * @test
     */
    public function upgradeWizardClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\UpgradeWizard\\MigrateSlugUpgradeWizard', $this->subject->getClassName());
    }

    /**
     * @test
     */
    public function serviceConfigurationContainsUpgradeWizardTag(): void
    {
        $config = $this->subject->getServiceConfiguration();

        self::assertArrayHasKey('Vendor\\Extension\\UpgradeWizard\\MigrateSlugUpgradeWizard', $config);
        self::assertEquals('typo3.upgrade_wizard', $config['Vendor\\Extension\\UpgradeWizard\\MigrateSlugUpgradeWizard']['tags'][0]['name']);
    }

    /**
     * @test
     * @dataProvider identifierProposalDataProvider
     */
    public function identifierProposalIsGeneratedCorrectly(string $name, string $extensionKey, string $expectedIdentifier): void
    {
        $wizard = new UpgradeWizard('Vendor\\Extension\\');
        $wizard->setName($name);

        self::assertEquals($expectedIdentifier, $wizard->getIdentifierProposalForWizard($extensionKey));
    }

    public static function identifierProposalDataProvider(): array
    {
        return [
            ['MigrateSlugUpgradeWizard', 'my_extension', 'myExtensionMigrateSlug'],
            ['CleanupDataUpgradeWizard', 'my_ext', 'myExtCleanupData'],
            ['SimpleUpgradeWizard', 'vendor_ext', 'vendorExtSimple'],
        ];
    }
}
