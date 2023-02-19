<?php
function removeSession($session){
    if(\Session::has($session)){
        \Session::forget($session);
    }
    return true;
}

function activeRoute($route, $isClass = false): string
{
    $requestUrl = request()->fullUrl() === $route ? true : false;

    if($isClass) {
        return $requestUrl ? $isClass : '';
    } else {
        return $requestUrl ? 'active' : '';
    }
}

function httpRequest($path, $method = "GET", $data = []) 
{
    $token = session()->get('token');
    $tokenDecrypt = \Crypt::decryptString($token);
    $http = \Http::withHeaders($headers = [
        'Accept' => 'application/vnd.api+json', 
        'Content-type' => 'application/vnd.api+json',
        'Authorization' => 'Bearer ' . $tokenDecrypt,
    ]);
    $response = null;

    switch($method) {
        case "post":
            $response = $http->post(env("APP_URL") . $path, $data);
        break;
        case "patch":
            $response = $http->patch(env("APP_URL") . $path, $data);
        break;
        default:
            $response = $http->get(env("APP_URL") . $path);
        break;
    }

    return json_decode($response->body(), true);
}

function buildFormData($data, $model, $format, $id = null) 
{
    $formattedData = [];
    foreach($data as $k => $value) {
        if(!array_key_exists($k, $format)) continue; 

        if($k == 'password' && !$value) continue;

        switch($format[$k]) {
            case "string":
                $formattedData[$k] = (string)$value;
                break;
            case "integer":
                $formattedData[$k] = (int)$value;
                break;
            case "boolean":
                $formattedData[$k] = (bool)$value;
                break;
            case "float":
                $formattedData[$k] = floatval($value);
                break;
            case "double":
                $formattedData[$k] = doubleval($value);
                break;
        }
    }

    $form = [
        "data" => [
            "type" => $model,
            "attributes" => $formattedData
        ]
    ];

    if($id != null) {
        $form['data']['id'] = $id;
    }

    return $form;
}

function getToken() {
    $token = session()->get('token');
    $tokenDecrypt = \Crypt::decryptString($token);
    return $tokenDecrypt;
}

function getAvailableKlien() {
    $kliens = \App\Models\User::where('is_admin', false)->get()->toArray();
    $result = [];

    foreach($kliens as $value) {
        $result[$value['uuid']] = $value['name'];
    }

    return $result;
}