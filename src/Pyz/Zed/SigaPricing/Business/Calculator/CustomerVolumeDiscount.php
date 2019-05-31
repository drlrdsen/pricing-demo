<?php

namespace Pyz\Zed\SigaPricing\Business\Calculator;

use Generated\Shared\Transfer\CustomerDiscountsTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class CustomerVolumeDiscount
{
    public function calculate(QuoteTransfer $quoteTransfer)
    {
        $customer = $quoteTransfer->getCustomer();
        if (!$customer) {
            return $quoteTransfer;
        }

        $this->calculateItemDiscounts($quoteTransfer, $customer->getEmail());
        $this->calculateDiscountTotal($quoteTransfer, $customer->getEmail());
    }


    /**
     * @param \ArrayObject|\Generated\Shared\Transfer\ItemTransfer[] $items $items
     * @param float $discount
     */
    protected function calculateItemDiscounts(QuoteTransfer $quoteTransfer, string $email)
    {
        $subtotal = $quoteTransfer->getTotals()->getSubtotal();
        $customerDiscount = $this->getCustomerDiscountForAmount($email, $subtotal);

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $amount = $itemTransfer->getSumPrice();
            $currentDiscount = $itemTransfer->getSumDiscountAmountAggregation();
            $itemTransfer->setSumDiscountAmountAggregation(
                (int) ($currentDiscount + $amount / 100 * $customerDiscount)
            );
        }
    }

    /**
     * @param QuoteTransfer $quoteTransfer
     * @param int $customerDiscount
     * @param int $subtotal
     */
    protected function calculateDiscountTotal(QuoteTransfer $quoteTransfer, string $email): void
    {
        $subtotal = $quoteTransfer->getTotals()->getSubtotal();
        $customerDiscount = $this->getCustomerDiscountForAmount($email, $subtotal);

        /* Shouldn't be like this */
        if (!$quoteTransfer->getTotals()->getCustomerDiscountTotals()) {
            $quoteTransfer->getTotals()
                ->setCustomerDiscountTotals(new CustomerDiscountsTransfer());
        }

        $discountTotals = $quoteTransfer->getTotals()->getCustomerDiscountTotals();
        $discountTotals
            ->setCustomerVolumeDiscount($customerDiscount / 100 / 100 * $subtotal);
        $discountTotals->setCustomerVolumeDiscountPercents($customerDiscount);

        if ($nextLevel = $this->getNextCustomerDiscountLevelForAmount($email, $subtotal)) {
            $discountTotals->setCustomerVolumeDiscountNextLevelAmount(($nextLevel['threshold'] - $subtotal) / 100);
            $discountTotals->setCustomerVolumeDiscountNextLevelPercents($nextLevel['discount']);
        }
        else {
            $discountTotals->setCustomerVolumeDiscountNextLevelAmount(false);
            $discountTotals->setCustomerVolumeDiscountNextLevelPercents(false);
        }
    }

    /**
     * @param string $email
     * @param int $value
     * @return int|mixed
     */
    protected function getCustomerDiscountForAmount($email, $value) {

        $customerDiscounts = $this->getCustomerDiscountData();
        if (!$email || !isset($customerDiscounts[$email])) {
            return 0;
        }

        $discount = 0;
        foreach ($customerDiscounts[$email] as $discountLevel) {
            if ($value < $discountLevel['threshold']) {
                break;
            }

            $discount = $discountLevel['discount'];
        }

        return $discount;
    }

    /**
     * @param string $email
     * @param int $value
     * @return int|mixed
     */
    protected function getNextCustomerDiscountLevelForAmount($email, $value) {

        $customerDiscounts = $this->getCustomerDiscountData();
        if (!$email || !isset($customerDiscounts[$email])) {
            return false;
        }

        $nextLevel = false;
        foreach ($customerDiscounts[$email] as $discountLevel) {
            if ($value < $discountLevel['threshold']) {
                return $discountLevel;
                break;
            }
        }

        return $nextLevel;
    }

    private function getCustomerDiscountData()
    {
        return array(
            'karl@spryker.com' => array(
                array(
                    'threshold' => 100000,
                    'discount' => 1.0
                ),
                array(
                    'threshold' => 150000,
                    'discount' => 2.0
                ),
                array(
                    'threshold' => 300000,
                    'discount' => 3.0
                )
            ),
            'sonia@spryker.com' => array(
                array(
                    'threshold' => 100000,
                    'discount' => 2.0
                ),
                array(
                    'threshold' => 150000,
                    'discount' => 3.0
                ),
                array(
                    'threshold' => 300000,
                    'discount' => 4.0
                )
            )
        );
    }
}