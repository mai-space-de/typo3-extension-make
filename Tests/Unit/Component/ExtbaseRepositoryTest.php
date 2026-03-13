<?php

declare(strict_types = 1);

namespace Maispace\Make\Tests\Unit\Component;

use Maispace\Make\Component\ExtbaseRepository;
use PHPUnit\Framework\TestCase;

class ExtbaseRepositoryTest extends TestCase
{
    protected ExtbaseRepository $subject;

    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new ExtbaseRepository('Vendor\\Extension\\');
        $this->subject->setName('BlogPostRepository');
        $this->subject->setDirectory('Domain/Repository');
    }

    /**
     * @test
     */
    public function generateRepositoryFileContentTest(): void
    {
        $expectedFileContent = <<<'EOF'
            <?php

            declare(strict_types=1);

            namespace Vendor\Extension\Domain\Repository;

            use TYPO3\CMS\Extbase\Persistence\Repository;

            class BlogPostRepository extends Repository
            {
            }

            EOF;

        self::assertEquals($expectedFileContent, $this->subject->__toString());
    }

    /**
     * @test
     */
    public function repositoryClassNameIsCorrect(): void
    {
        self::assertEquals('Vendor\\Extension\\Domain\\Repository\\BlogPostRepository', $this->subject->getClassName());
    }
}
