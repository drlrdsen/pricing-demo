<?php

namespace Pyz\Zed\SigaPricing\Business\Calculator;

use Generated\Shared\Transfer\CustomerDiscountsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CustomerDiscount
{
    public function calculate(QuoteTransfer $quoteTransfer)
    {
        $customer = $quoteTransfer->getCustomer();
        if (!$customer) {
            return $quoteTransfer;
        }

        $customerDiscount = $this->getCustomerData($customer->getEmail());
        $this->calculateItemDiscounts($quoteTransfer->getItems(), $customerDiscount);
        $this->calculateDiscountTotal($quoteTransfer, $customerDiscount);
    }


    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[] $items $items
     * @param float $discount
     */
    protected function calculateItemDiscounts(\ArrayObject $items, float $discount)
    {
        foreach ($items as $itemTransfer) {
            $amount = $itemTransfer->getSumPrice();
            $currentDiscount = $itemTransfer->getSumDiscountAmountAggregation();
            $itemTransfer->setSumDiscountAmountAggregation(
                (int) ($currentDiscount + $amount / 100 * $discount)
            );
        }
    }


    /**
     * @param QuoteTransfer $quoteTransfer
     * @param int $customerDiscount
     */
    protected function calculateDiscountTotal(QuoteTransfer $quoteTransfer, int $customerDiscount): void
    {
        $subtotal = $quoteTransfer->getTotals()->getSubtotal();

        /* Shouldn't be like this */
        if (!$quoteTransfer->getTotals()->getCustomerDiscountTotals()) {
            $quoteTransfer->getTotals()
                ->setCustomerDiscountTotals(new CustomerDiscountsTransfer());
        }

        $discountTotals = $quoteTransfer->getTotals()->getCustomerDiscountTotals();
        $discountTotals->setOnlineDiscount($customerDiscount / 100 / 100 * $subtotal);
        $discountTotals->setOnlineDiscountPercents($customerDiscount);

    }


    /**
     * @param string $email
     * @return int|mixed
     */
    private function getCustomerData($email) {
        $customerDiscounts = array(
            'karl@spryker.com' => 1.0,
            'sonia@spryker.com' => 2.0
        );

        if (!$email || !isset($customerDiscounts[$email])) {
            return 0;
        }

        return $customerDiscounts[$email];
    }
}