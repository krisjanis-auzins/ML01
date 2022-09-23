<?php

namespace Magebit\AttributesFilter\ViewModel;

use \Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Filtered display attributes view model
 */
class AttributesFilter implements ArgumentInterface
{
    /**
     * Returns prepared display attributes data array
     *
     * @param array $primaryAttributes
     * @param array $productAttributes
     * @param int $attributeRenderCount
     * @return array
     */
    public function getDisplayAttributes(array $primaryAttributes, array $productAttributes, int $attributeRenderCount): array
    {
        $displayAttributes = [];

        foreach ($primaryAttributes as $attributeCode) {
            if (array_key_exists($attributeCode, $productAttributes)) {
                $displayAttributes[$attributeCode] = $productAttributes[$attributeCode];
            }
        }

        if (count($displayAttributes) < $attributeRenderCount) {
            foreach ($productAttributes as $attribute) {
                if (!array_key_exists($attribute['code'], $displayAttributes) && count($displayAttributes) < $attributeRenderCount) {
                    $displayAttributes[$attribute['code']] = $productAttributes[$attribute['code']];
                }
            }
        }
        return $displayAttributes;
    }
}
