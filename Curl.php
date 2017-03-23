<?php

class Curl{

    //GET request to a particular url
    public function request($url, $request_type='GET', $request_body = '', $headers = '', $file = 0) {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        if ($headers != '') {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
        }

        curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);
        //curl_setopt($ch, CURLOPT_VERBOSE, TRUE);

        switch($request_type){
            case 'POST' :
                if($file == 1){
                    $body = $request_body;
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                }
                else{
                    $body = json_encode($request_body);
                }

                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                break;
            case 'PUT' :
                $body = json_encode($request_body);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                break;
            case 'PUT' :
                $body = json_encode($request_body);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                break;
            case 'DELETE' :
                $body = json_encode($request_body);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
                break;
            default:
                break;
        }

        $response = curl_exec($ch);
        $httpresponse = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $myresponse = array($httpresponse, $response);

        curl_close($ch);

        return $myresponse;
    }

    public function standard_request($url) {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, TRUE);

        $response = curl_exec($ch);
        $httpresponse = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $myresponse = array($httpresponse, $response);

        curl_close($ch);

        return $myresponse;
    }
}