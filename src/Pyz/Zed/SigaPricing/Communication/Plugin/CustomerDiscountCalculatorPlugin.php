<?php


namespace Pyz\Zed\SigaPricing\Communication\Plugin;


use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Calculation\Dependency\Plugin\CalculatorPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \Pyz\Zed\SigaPricing\Communication\SigaPricingCommunicationFactory getFactory()
 * @method \Pyz\Zed\SigaPricing\Business\SigaPricingFacade getFacade()
 * @method \Pyz\Zed\SigaPricing\SigaPricingConfig getConfig()
 */
class CustomerDiscountCalculatorPlugin  extends AbstractPlugin implements CalculatorPluginInterface
{
    public function recalculate(QuoteTransfer $quoteTransfer)
    {
        $this->getFacade()->calculateCustomerDiscounts($quoteTransfer);
    }

}