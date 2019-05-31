<?php

namespace Pyz\Zed\SigaPricing\Business;

use Pyz\Zed\SigaPricing\Business\Calculator\CustomerDiscount;
use Pyz\Zed\SigaPricing\Business\Calculator\CustomerVolumeDiscount;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \Pyz\Zed\SigaPricing\SigaPricingConfig getConfig()
 * @method \Pyz\Zed\SigaPricing\Persistence\SigaPricingQueryContainer getQueryContainer()
 */
class SigaPricingBusinessFactory extends AbstractBusinessFactory
{

    public function createCustomerDiscount()
    {
        return new CustomerDiscount();
    }

    public function createCustomerVolumeDiscount()
    {
        return new CustomerVolumeDiscount();
    }

}
