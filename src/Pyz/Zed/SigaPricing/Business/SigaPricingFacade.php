<?php

namespace Pyz\Zed\SigaPricing\Business;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \Pyz\Zed\SigaPricing\Business\SigaPricingBusinessFactory getFactory()
 */
class SigaPricingFacade extends AbstractFacade implements SigaPricingFacadeInterface
{
    public function calculateCustomerDiscounts(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()
            ->createCustomerDiscount()
            ->calculate($quoteTransfer);
    }


    public function calculateCustomerVolumeDiscounts(QuoteTransfer $quoteTransfer)
    {
        return $this->getFactory()
            ->createCustomerVolumeDiscount()
            ->calculate($quoteTransfer);
    }


}
