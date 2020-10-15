<?php

namespace App\Http\Controllers;
use App\Helpers\Helper;
use App\Transaction;
use App\User;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected $_helper;
    public function __construct()
    {
        $this->_helper = new Helper();
    }

    public function index()
    {
        return view('admin.dashboard.index');
    }

    public function getChartData(){
        $companies = [];
        $companiesMonthCount = [];
        $companiesArr = [];
        $showCompaniesChart = false;
        if(Auth::user()->hasRole('admin')){
            $companies = new \App\Company;

            $companies = $companies->get()->groupBy(function($data) {
                return Carbon::parse($data->created_at)->format('m');
            });

            foreach ($companies as $key => $value) {
                $companiesMonthCount[(int)$key] = count($value);
            }

            for($i = 1; $i <= 12; $i++){
                if(!empty($companiesMonthCount[$i])){
                    $companiesArr[$i] = $companiesMonthCount[$i];
                }else{
                    $companiesArr[$i] = 0;
                }
            }
            $showCompaniesChart = true;
        }else{
            for($i = 1; $i <= 12; $i++){
                $companiesArr[$i] = 0;
            }
        }

        $userWithTransactions = Transaction::where('user_id', Auth::user()->id)->get()->groupBy(function($date){
            return Carbon::parse($date->created_at)->format('m');
        });

        $transactionsMonthCount = [];
        $transactionsArr = [];
        for($i = 1; $i <= 12; $i++){
            $transactionsArr[$i] = 0;
        }
        if($userWithTransactions->count() > 0){
            foreach($userWithTransactions as $key => $transaction){
                $transactionsMonthCount[(int)$key] = count($transaction);
            }
            for($i = 1; $i <= 12; $i++){
                if(!empty($transactionsMonthCount[$i])){
                    $transactionsArr[$i] = $transactionsMonthCount[$i];
                }else{
                    $transactionsArr[$i] = 0;
                }
            }
        }

        $this->_helper->response()->send([
            'transactions' => $transactionsArr,
            'companies' => $companiesArr,
            'showCompaniesChart' => $showCompaniesChart
        ]);

    }
}
