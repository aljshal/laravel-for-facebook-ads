<?php

namespace App\Http\Controllers;

require __DIR__.'/../../../vendor/autoload.php';

use App\Catalogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Ixudra\Curl\Facades\Curl;

class CatalogsController extends Controller
{
    /**
     * 입력에 따라 페이스북 카탈로그를 생성
     * @param Request $request
     * return catalog id
     */
    public function store(Request $request)
    {
        $business_id = $request->input('business_id');

        $response = Curl::to('https://graph.facebook.com/v4.0/'.$business_id.'/owned_product_catalogs')
            ->withData($request->input())
            ->asJson(true)
            ->post();

        print_r($response);

        $email = DB::table('users')->where('business_id', $business_id)->value('email');
        DB::table('catalogs')->insert(
            ['email' => $email, 'business_id' => $business_id, 'catalog_id' => $response['id']]
        );
    }

    /**
     * Catalog 값 얻기
     * @param $id
     * @return Catalog
     */
    public function show($id)
    {
        $catalog = Catalogs::find($id);
        return $catalog;
    }
}
