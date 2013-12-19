<?php

class SimplePaypalModule extends CWebModule {

    const PAYPAL_PRODUCTION = 'https://www.paypal.com/cgi-bin/webscr';
    const ENDPOINT_PRODUCTION = 'https://api-3t.paypal.com/nvp';
    const PAYPAL_SANDBOX = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    const ENDPOINT_SANDBOX = 'https://api-3t.sandbox.paypal.com/nvp';

    /**
     * @var string|array
     * The url to return the customer after a successful payment
     */
    public $returnUrl;

    /**
     * @var string|array The url to return the customer if payment was cancelled
     */
    public $cancelUrl;

    /**
     * @var string|array The url to notify url for the paypal
     */
    public $notifyUrl;

    /**
     * @var string Default currency to use
     */
    public $currency = 'USD';

    /**
     * @var string|array server URL which you have to connect for submitting your API request
     */
    public $endPoint;

    /**
     * @var string
     * Define the PayPal URL. This is the URL that the buyer is
     * first sent to to authorize payment with their paypal account
     * change the URL depending if you are testing on the sandbox
     * or going to the live PayPal site
     * For the sandbox, the URL is
     * https://www.sandbox.paypal.com/cgi-bin/webscr
     * For the live site, the URL is
     * https://www.paypal.com/cgi-bin/webscr
     */
    public $paypalUrl;

    /**
     * @var string paypal business/merchant email
     */
    public $businessEmail;
    public $paypalSandbox;

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'SimplePaypal.models.*',
            'SimplePaypal.components.*',
        ));

        if (!PaypalSetting::model()->findByPk(1)) {
            $model = new PaypalSetting;
            $model->currency = 'USD';
            $model->save(false);
        }

        $model = PaypalSetting::model()->findByPk(1);

        $this->paypalSandbox = (bool) $model->sandbox;

        if ((bool) $model->sandbox === false) {
            $this->paypalUrl = self::PAYPAL_PRODUCTION;
            $this->endPoint = self::ENDPOINT_PRODUCTION;
        } else {
            $this->paypalUrl = self::PAYPAL_SANDBOX;
            $this->endPoint = self::ENDPOINT_SANDBOX;
        }

        $this->returnUrl = $model->return_url;
        $this->cancelUrl = $model->cancel_url;
        $this->notifyUrl = $model->notify_url;
        $this->currency = $model->currency;
        $this->businessEmail = $model->business_email;
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

}
