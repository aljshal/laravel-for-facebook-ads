<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataFeedsController extends Controller
{
    public function download()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://sampleDownload.com",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $this->export(json_decode($response,true));
        }
    }

    private function export($response)
    {
        $csv = tmpfile();

        $filename = "products_".date("Y-m-d").".csv";
        $rowHeader = true;
        $is_sold_out = 'discontinued';

        // 전체 컬럼
        $columns = array('id', 'title', 'brand', 'description', 'availability', 'condition', 'price', 'sales_price', 'link', 'image_link');
        foreach ($response['data'] as $row)
        {
            // 제목 행 삽입
            if ($rowHeader)
            {
                fputcsv($csv, $columns);
                $rowHeader = false;
            }

            if((int)$row['is_sold_out'] > 0)
                $is_sold_out = 'in stock';

            $brand = $row['brand'];
            if($row['brand'] == "")
            {
                $brand = $row['mall_id'];
            }

            fputcsv($csv, array($row['product_code'], $row['name'], $brand, 'description', $is_sold_out, 'new', $row['base_price'], $row['sale_price'], $row['detail_url'], $row['big_image_url']));
        }

        rewind($csv);

        $fstat = fstat($csv);
        
        // 헤더 세팅
        $this->setHeader($filename, $fstat['size']);

        fpassthru($csv);
        fclose($csv);
    }

    private function setHeader($filename, $filesize)
    {
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header('Content-Type: text/x-csv;charset=UTF-8;');

        if (isset($filename) && strlen($filename) > 0)
            header("Content-Disposition: attachment;filename={$filename}");

        if (isset($filesize))
            header("Content-Length: ".$filesize);

        header("Content-Transfer-Encoding: binary");
        header("Connection: close");

        echo "\xEF\xBB\xBF";
    }
}
