<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PayPal\Api\Payee;
use Auth;
class PaymentController extends Controller
{
    protected $_api_context;
    protected $_admin_commission;
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);
        $this->_admin_commission = 1;
    }

    public function payWithpaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');


        $item_1 = new Item();
        $item_1->setName($request->category)/** item name **/
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($request->get('amount'));


        /** unit price **/
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));


//        $commission = ($request->amount / 100) * $this->_admin_commission;
//        $amountToPay = $request->amount - $commission;
//        $amount = new Amount();
//        $amount->setCurrency('USD')
//            ->setDetails(['handling_fee' => $commission])
//            ->setTotal($amountToPay);
        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($request->amount);


        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Transaction of '.$amount->getTotal().' '.$amount->getCurrency().'For '.$request->category);


        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::route('status'))/** Specify return URL **/
        ->setCancelUrl(URL::route('status'));

        //paying to company email address
//        $company = new \App\Company;
//
//        $company = $company->find($request->company_id);
//
//
//        $payee = new Payee();
//        $payee->setEmail($company->email);

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
//         dd($payment->create($this->_api_context));


        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\Config::get('app.debug')) {
                \Session::put('error', 'Connection timeout');
                return Redirect::route('paywithpaypal');
            } else {
                \Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('paywithpaypal');
            }
        }
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }
        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirect_url)) {
            /** redirect to paypal **/
            return Redirect::away($redirect_url);
        }
        \Session::put('error', 'Unknown error occurred');
        return Redirect::route('paywithpaypal');
    }

    public function getPaymentStatus(Request  $request)
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');


        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty($request->get('PayerID')) || empty($request->get('token'))) {
            \Session::put('error', 'Payment failed');
            return Redirect::route('/');
        }


        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->get('PayerID'));
        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);
        if ($result->getState() == 'approved') {
            \Session::put('success', 'Payment success');

            $transaction = new \App\Transaction;

            $transaction->create([
                'user_id' => Auth::user()->id,
                'user_email' => Auth::user()->email,
                'payment_id' => $result->getId(),
                'payment_status' => $result->getState(),
                'payer_id' => $result->getPayer()->payer_info->getPayerId(),
                'payer_email' => $result->getPayer()->payer_info->getEmail(),
                'payer_name' => $result->getPayer()->payer_info->getFirstName() .' '. $result->getPayer()->payer_info->getLastName(),
                'payer_country_code' => $result->getPayer()->payer_info->getCountryCode(),
                'transaction_amount' => $result->getTransactions()[0]->amount->getTotal(),
                'transaction_currency' => $result->getTransactions()[0]->amount->getCurrency(),
                'transaction_description' => $result->getTransactions()[0]->getDescription(),
                'merchant_id' => $result->getTransactions()[0]->getPayee()->getMerchantId(),
                'merchant_email' => $result->getTransactions()[0]->getPayee()->getEmail(),
                'commission' => null,
                'transaction_create_time' => $result->getCreateTime(),
                'transaction_update_time' => $result->getUpdateTime(),
            ]);

            return Redirect::route('/');
        }
        \Session::put('error', 'Payment failed');
        return Redirect::route('/');
    }
}
