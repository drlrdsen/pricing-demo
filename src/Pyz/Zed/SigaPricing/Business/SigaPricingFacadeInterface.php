<?php

namespace Pyz\Zed\SigaPricing\Business;

use Generated\Shared\Transfer\QuoteTransfer;

interface SigaPricingFacadeInterface
{

    /**
     * Specification:
     * - Finds all customer-specific discounts.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    public function calculateCustomerDiscounts(QuoteTransfer $quoteTransfer);


}
