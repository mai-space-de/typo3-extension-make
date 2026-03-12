<?php

declare(strict_types = 1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\Migration;
use PHPUnit\Framework\TestCase;

class MigrationTest extends TestCase
{
    protected Migration $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Migration('Vendor\\Extension\\');
        $this->subject->setName('MigrateUserDataMigration');
        $this->subject->setDirectory('Migration');
        $this->subject->setDescription('Migrate user data to new format');
    }

    /**
     * @test
     */
    public function generateMigrationFileContentTest(): void
    {
        $content = $this->subject->__toString();

        self::assertStringContainsString('namespace Vendor\Extension\Migration;', $content);
        self::assertStringContainsString('class MigrateUserDataMigration', $content);
        self::assertStringContainsString('Migrate user data to new format', $content);
        self::assertStringContainsString('public function migrate(): void', $content);
    }

    /**
     * @test
     */
    public function migrationClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Migration\\MigrateUserDataMigration', $this->subject->getClassName());
    }

    /**
     * @test
     */
    public function descriptionIsStored(): void
    {
        self::assertEquals('Migrate user data to new format', $this->subject->getDescription());
    }
}
