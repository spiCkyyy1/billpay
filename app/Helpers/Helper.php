<?php

namespace App\Helpers;
use Library\Response;

class Helper
{
    public function toObject($array): object
    {
        $object = new \stdClass();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $value = self::toObject($value);
            }
            $object->$key = $value;
        }

        return $object;
    }

    /**
     * @param $dotedArray
     * @return array
     */
    public function expandDotArray($dotedArray): array
    {
        if (!is_array($dotedArray)) {
            return false;
        }

        $array = [];
        foreach ($dotedArray as  $key => $val) {
            array_set($array, $key, $val);
        }

        return $array;
    }


    public function response()
    {
        return new Response();
    }

    // validation messages
    public function getValidationMessages()
    {
        return [
            'required'              => ':Attribute field is required',
            'digits'                => ':attribute must be of 11 digits',
            'date'                  => ':attribute should be a date',
            'name.required'         => 'Please enter the name.',
            'email.required'        => 'Please enter the email.',
            'email.email'           => 'Please enter correct email format.',
            'email.unique'          => 'User with this email already exist.',
            'password.required'     => 'Please enter the password.',
            'password.confirmed'    => 'Password does not match.'
        ];
    }

    // check validation and return
    public function runValidation($rules)
    {
        $validator = \Illuminate\Support\Facades\Validator::make(request()->all(), $rules, $this->getValidationMessages());

        if ($validator->fails()) {
            $this->response()->setCode('219')->setMessage($validator->errors()->first())->send($validator->errors(),true);
        }
    }

    public function phoneNumber0to92($mobileNo)
    {
        $zero = $mobileNo[0];

        if($zero != '0'){ //if number starting without 0
            $mobileNo = str_pad($mobileNo, 11, '0', STR_PAD_LEFT); //appending 0 at the starting of mobile

            $zero = $mobileNo[0];
        }

        if ($zero == '0') {
            return substr_replace($mobileNo, '92', 0, 1);
        }

        return $mobileNo;
    }


    function getRequiredIndexByValue($data, $field, $value)
    {
        foreach ($data as $key => $datum) {
            if ($datum->{$field} == $value)
                return $datum->id;
        }
        return false;
    }


}
