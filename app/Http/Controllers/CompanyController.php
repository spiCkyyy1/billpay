<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Helpers\Helper;
class CompanyController extends Controller
{

    protected $_helper;
    public function __construct()
    {
        $this->_helper = new Helper();
    }

    public function index(){
        $request = request();

        $companies = new \App\Company;

        $companies = $companies->with('category')->where(function($query) use ($request){
            $query->where('name', 'LIKE', '%'.$request->SearchQuery.'%');
            $query->orWhere('email', 'LIKE', '%'.$request->SearchQuery.'%');
        });

        $this->_helper->response()->setHttpCode(200)->send($companies->orderBy('id', request()->orderBy)->paginate());
    }

    public function approve(){
        $request = request();

        $company = new \App\Company;

        $company = $company->find($request->companyId);

        $company->status = 1;

        $company->save();

        $user = new \App\User;

        if($company->email){
            $user = $user->where('email', $company->email)->count();
            if($user > 0){
                $this->_helper->response()->setMessage('Email should be unique')->setCode(219)->send('');
            }
            $this->_helper->response()->setMessage('Email should be unique')->setCode(219)->send('');
        }

        $user = $user->create([
            'name' => $company->name,
            'email' => $company->email,
            'password' => bcrypt($company->password)
        ]);

        $user->assignRole('company');

        $this->_helper->response()->setHttpCode(200)->send('');
    }

    public function disapprove(){
        $request = request();

        $company = new \App\Company;

        $company = $company->find($request->companyID);

        $company->status = 0;

        $company->save();

        $user = new \App\User;

        if($company->email){
            $user = $user->where('email', $company->email)->count();
            if($user > 0){
                $this->_helper->response()->setMessage('Email should be unique')->setCode(219)->send('');
            }
        }

        $user = $user->where('email', $company->email);

        $user->delete();

        $this->_helper->response()->setHttpCode(200)->send('');
    }

    public function delete(){
        $request = request();

        $company = new \App\Company;

        $company = $company->find($request->id);

        $company->delete();

        $this->_helper->response()->setHttpCode(200)->send('');
    }
    public function store(){

        $request = request();

        $validator = Validator::make($request->all(),[
            'category_id' => 'bail|required|exists:categories,id',
            'name' => 'bail|required',
            'email' => 'bail|required|email|unique:companies,email',
            'password' => 'bail|required|min:6',
            'address' => 'bail|required',
            'country' => 'bail|required',
            'state' => 'bail|required',
            'city' => 'bail|required',
            'zip_code' => 'bail|required',
            'paypal_id' => 'bail|required|unique:companies,paypal_id',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $company = new \App\Company;

        $company->create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'country' => $request->country,
            'state' => $request->state,
            'city' => $request->city,
            'address' => $request->address,
            'zip_code' => $request->zip_code,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'paypal_id' => $request->paypal_id,
            'status' => 0,
        ]);

        return redirect()->back()->with(['companyCreated' => 'Please wait till admin approves your company.']);
    }
}
