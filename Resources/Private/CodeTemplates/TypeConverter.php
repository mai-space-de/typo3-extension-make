<?php

declare(strict_types=1);

namespace {{NAMESPACE}};

use TYPO3\CMS\Extbase\Property\PropertyMappingConfigurationInterface;
use TYPO3\CMS\Extbase\Property\TypeConverter\AbstractTypeConverter;

class {{NAME}} extends AbstractTypeConverter
{
    /**
     * @var array<string>
     */
    protected array $sourceTypes = ['string'];

    protected string $targetType = '';

    protected int $priority = 10;

    public function convertFrom(
        mixed $source,
        string $targetType,
        array $convertedChildProperties = [],
        ?PropertyMappingConfigurationInterface $configuration = null,
    ): mixed {
        // Convert $source to $targetType here
        return null;
    }
}
