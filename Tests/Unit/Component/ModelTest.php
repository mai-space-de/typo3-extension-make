<?php

declare(strict_types = 1);

namespace Maispace\MaiMake\Tests\Unit\Component;

use Maispace\MaiMake\Component\Model;
use PHPUnit\Framework\TestCase;

class ModelTest extends TestCase
{
    protected Model $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Model('Vendor\\Extension\\');
        $this->subject->setName('BlogPost');
        $this->subject->setDirectory('Domain/Model');
    }

    /**
     * @test
     */
    public function generateModelFileContentTest(): void
    {
        $expectedFileContent = <<<'EOF'
            <?php

            declare(strict_types=1);

            namespace Vendor\Extension\Domain\Model;

            use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

            class BlogPost extends AbstractEntity
            {
                // Add model properties here
            }

            EOF;

        self::assertEquals($expectedFileContent, $this->subject->__toString());
    }

    /**
     * @test
     */
    public function modelClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Domain\\Model\\BlogPost', $this->subject->getClassName());
    }
}
