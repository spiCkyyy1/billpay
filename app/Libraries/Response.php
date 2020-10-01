<?php

namespace Library;

use Illuminate\Pagination\LengthAwarePaginator;
use InvalidArgumentException;
use Illuminate\Support\Collection;

class Response
{

    protected $_data = [];

    protected $_HttpCode = '200';

    protected $_msg = 'Success';

    protected $_code = '200';

    protected $_responseArray;


    public function setHttpCode($code)
    {
        $this->_code = $code;
        $this->_HttpCode = $code;

        return $this;
    }

    public function setCode($code)
    {
        $this->_code = $code;

        return $this;
    }

    public function setMessage($msg)
    {
        $this->_msg = $msg;

        return $this;
    }

    public function setCodeAndMessage($codeAndMessage)
    {
        $this->_code = isset($codeAndMessage['code']) ? $codeAndMessage['code'] : $this->_code;
        $this->_msg = isset($codeAndMessage['msg']) ? $codeAndMessage['msg'] : $this->_msg;

        return $this;
    }

    public function send($data = false, $log = false)
    {
        if ($data instanceof LengthAwarePaginator) {

            $data = $data->toArray();
            $array['data'] = $data['data'];
            unset($data['data']);
            $this->_responseArray['meta'] = $data;
            $this->_data = $array;
        } else if (is_array($data)) {

            $i = 0;
            foreach ($data as $key => $val) {
                if ($val instanceof LengthAwarePaginator) {
                    $i++;
                    $val = $val->toArray();
                    $array = $val['data'];
                    unset($val['data']);
                    $this->_responseArray['meta'] = $val;
                    $data[$key] = $array;
                }
            }

            if ($i > 1) {
                throw new InvalidArgumentException('One LengthAwarePaginator is allowed only.');
            }

            $this->_data = $data;
        } else if ($data instanceof Collection) {

            $this->_data['data'] = $data->toArray();
        } else if (is_object($data)) {

            $this->_data['data'] = $data->toArray();
        } else if ($data) {

            $this->_data['data'] = $data;
        }

        $this->_responseArray['code'] = (string) $this->_code;

        $this->_responseArray['msg'] = (string) $this->_msg;

        $this->_responseArray = array_merge($this->_responseArray, $this->_data);


        if($log){
            $this->log();
        }


        response()->json($this->_responseArray, $this->_HttpCode)->send();

        die();
    }
}
