<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Routing\ResponseFactory;

class ResponseAPI {
    /**
     * @param $message
     * @param bool|false $data
     * @param int $code
     * @return mixed
     */
    static function success(String $message, Array $data=[], int $code=200){
        return self::responseData([
            'message' => $message,
            'code' => $code,
            'data' => $data
        ]);
    }

    /**
     * @param $message
     * @param bool|false $title
     * @param int $code
     * @param array $data
     * @return mixed
     */
    static function error(String $message, String $title='', int $code=400, Array $data = []){
        return self::responseData([
            'code' => $code < 100 ? 418 : $code,
            'message' => $message,
            'title' => ($title)?$title:'',
            'data' => $data
        ]);
    }
    /**
     * @param $arr
     * @return mixed
     */
    static function responseData(Array $arr){
        $code = $arr['code'];
        unset($arr['code']);
        if(isset($arr['title'])){
            if($arr['title']==''){
                unset($arr['title']);
            }
        }
        if(isset($arr['data'])){
            if($arr['data']==''){
                unset($arr['data']);
            }
        }
        return response()->json($arr, $code);
    }  
}