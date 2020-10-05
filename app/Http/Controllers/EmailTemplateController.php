<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;

class EmailTemplateController extends Controller
{
    protected $_helper;
    public function __construct()
    {
        $this->_helper = new Helper();
    }

    public function index(){

        $request = request();

        $emailTemplate = new \App\EmailTemplate;

        $emailTemplate = $emailTemplate->where(function($query) use ($request){
            $query->where('name', 'LIKE', '%'.$request->SearchQuery.'%');
        });

        $this->_helper->response()->setHttpCode(200)->send($emailTemplate->orderBy('id', request()->orderBy)->paginate());
    }

    public function create(){
        $request = request();

        $this->_helper->runValidation([
            'name' => 'bail|required|string',
            'slug' => 'bail|required|string|unique:email_templates,slug',
            'subject' => 'bail|required|string|unique:email_templates,subject',
            'body' => 'bail|required',
            'status' => 'bail|required',
        ]);

        $emailTemplate = new \App\EmailTemplate;

        $emailTemplate->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'subject' => $request->subject,
            'body' => $request->body,
            'status' => $request->status
        ]);

        $this->_helper->response()->setMessage('Email Template Created Successfully.')->setHttpCode(200)->send('');
    }

    public function edit(){
        $request = request();

        $emailTemplate = new \App\EmailTemplate;

        $emailTemplate = $emailTemplate->find($request->id);

        $this->_helper->response()->setHttpCode(200)->send($emailTemplate);
    }

    public function update(){
        $request = request();

        $this->_helper->runValidation([
            'name' => 'bail|required|string',
            'slug' => 'bail|required|string|unique:email_templates,slug,' . $request->id,
            'subject' => 'bail|required|string|unique:email_templates,subject,' . $request->id,
            'body' => 'bail|required',
            'status' => 'bail|required',
        ]);

        $emailTemplate = new \App\EmailTemplate;

        $emailTemplate = $emailTemplate->find($request->id);

        $emailTemplate->name = $request->name;
        $emailTemplate->slug = $request->slug;
        $emailTemplate->subject = $request->subject;
        $emailTemplate->body = $request->body;
        $emailTemplate->status = $request->status;
        $emailTemplate->save();

        $this->_helper->response()->setMessage('Email Template Updated Successfully.')->setHttpCode(200)->send('');
    }

    public function delete(){
        $request = request();

        $this->_helper->runValidation([
            'id' => 'required'
        ]);
        
        $emailTemplate = new \App\EmailTemplate;

        $emailTemplate = $emailTemplate->find($request->id);

        $emailTemplate->delete();

        $this->_helper->response()->setMessage('Email Template Deleted Successfully.')->setHttpCode(200)->send('');


    }
}
