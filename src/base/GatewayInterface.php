<?php

namespace craft\commerce\base;

use craft\base\SavableComponentInterface;
use craft\commerce\models\payments\BasePaymentForm;
use craft\commerce\models\PaymentSource;
use craft\commerce\models\Transaction;
use craft\web\Response as WebResponse;

/**
 * GatewayInterface defines the common interface to be implemented by gateway classes.
 * A class implementing this interface should also use [[SavableComponentTrait]] and [[GatewayTrait]].
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since 2.0
 */
interface GatewayInterface extends SavableComponentInterface
{
    // Public Methods
    // =========================================================================

    /**
     * Makes an authorize request.
     *
     * @param Transaction $transaction The authorize transaction
     * @param BasePaymentForm $form A form filled with payment info
     * @return RequestResponseInterface
     */
    public function authorize(Transaction $transaction, BasePaymentForm $form): RequestResponseInterface;

    /**
     * Makes a capture request.
     *
     * @param Transaction $transaction The capture transaction
     * @param string $reference Reference for the transaction being captured.
     * @return RequestResponseInterface
     */
    public function capture(Transaction $transaction, string $reference): RequestResponseInterface;

    /**
     * Makes a complete authorize request.
     *
     * @param Transaction $transaction The transaction
     * @return RequestResponseInterface
     */
    public function completeAuthorize(Transaction $transaction): RequestResponseInterface;

    /**
     * Makes a complete purchase request.
     *
     * @param Transaction $transaction The transaction
     * @return RequestResponseInterface
     */
    public function completePurchase(Transaction $transaction): RequestResponseInterface;

    /**
     * Creates a payment source from source data
     *
     * @param BasePaymentForm $sourceData
     * @return PaymentSource
     */
    public function createPaymentSource(BasePaymentForm $sourceData): PaymentSource;

    /**
     * Deletes a payment source on the gateway by its token.
     *
     * @param string $token
     * @return bool
     */
    public function deletePaymentSource($token): bool;

    /**
     * Makes a purchase request.
     *
     * @param Transaction $transaction The purchase transaction
     * @param BasePaymentForm $form A form filled with payment info
     * @return RequestResponseInterface
     */
    public function purchase(Transaction $transaction, BasePaymentForm $form): RequestResponseInterface;

    /**
     * Makes an refund request.
     * @param Transaction $transaction The refund transaction
     * @return RequestResponseInterface
     */
    public function refund(Transaction $transaction): RequestResponseInterface;

    /**
     * Processes a webhook and return a response
     *
     * @return WebResponse
     */
    public function processWebHook(): WebResponse;

    /**
     * Returns true if gateway supports authorize requests.
     *
     * @return bool
     */
    public function supportsAuthorize(): bool;

    /**
     * Returns true if gateway supports capture requests.
     *
     * @return bool
     */
    public function supportsCapture(): bool;

    /**
     * Returns true if gateway supports completing authorize requests
     *
     * @return bool
     */
    public function supportsCompleteAuthorize(): bool;

    /**
     * Returns true if gateway supports completing purchase requests
     *
     * @return bool
     */
    public function supportsCompletePurchase(): bool;

    /**
     * Returns true if gateway supports payment sources
     *
     * @return bool
     */
    public function supportsPaymentSources(): bool;

    /**
     * Returns true if gateway supports purchase requests.
     *
     * @return bool
     */
    public function supportsPurchase(): bool;

    /**
     * Returns true if gateway supports refund requests.
     *
     * @return bool
     */
    public function supportsRefund(): bool;

    /**
     * Returns true if gateway supports partial refund requests.
     *
     * @return bool
     */
    public function supportsPartialRefund(): bool;

    /**
     * Returns true if gateway supports webhooks.
     *
     * @return bool
     */
    public function supportsWebhooks(): bool;
}
