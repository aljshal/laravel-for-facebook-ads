<?php

namespace App\Http\Controllers;

require_once __DIR__ . '/../../../vendor/autoload.php';

use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;

class ProductSetController extends Controller
{
    public function show($id)
    {
        echo $id;
    }

    public function store(Request $request)
    {
        $catalog_id = $request->input('catalog_id');
        $access_tocken = $request->input('access_tocken');

        // filter json_encoded string으로 정리
        // e.g. {"product_type":{"i_contains":"shirt"}}
        $filter = trim($request->input('filter'));
        $filterArr = explode(' ', $filter);

        $compareKey = $this->filterConvert($filterArr[1]); // e.g. like, >=
        $rightValue = array($compareKey => $filterArr[2]); // e.g. shirt, 30000
        $fullValue = json_encode(array($filterArr[0] => $rightValue));
        $request['filter'] = $fullValue;

        $response = Curl::to('https://graph.facebook.com/v4.0/'.$catalog_id.'/product_sets/')
            ->withData($request->all())
            ->withHeaders( array( 'Authorization: Bearer '.$access_tocken) )
            ->asJson(true)
            ->post();

        print_r($response);
    }

    private function filterConvert($filter)
    {
        $filter = strtolower($filter);

        $convert = array(
            'i_contains' => 'like',
            'i_not_contains' => 'not like',
            'eq' => '=',
            'neq' => '!=',
            'lt' => '<',
            'lte' => '<=',
            'gt' => '>',
            'gte' => '>='
        );

        if(array_search($filter,$convert))
            $filter = array_search($filter,$convert);
        return $filter;
    }
}
