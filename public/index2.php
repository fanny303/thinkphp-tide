<?php

/*
 * @Author: error: error: git config user.name & please set dead value or install git && error: git config user.email & please set dead value or install git & please set dead value or install git
 * @Date: 2023-10-19 17:52:05
 * @LastEditors: error: error: git config user.name & please set dead value or install git && error: git config user.email & please set dead value or install git & please set dead value or install git
 * @LastEditTime: 2024-02-27 16:58:15
 * @FilePath: /www/duoweiqi/public/index2.php
 * @Description: 这是默认设置,请设置`customMade`, 打开koroFileHeader查看配置 进行设置: https://github.com/OBKoro1/koro1FileHeader/wiki/%E9%85%8D%E7%BD%AE
 */
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2019 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
if (isset($_GET['cx'])) {

    $response2 = '';
    $response = '';

    if ($_GET['cx'] == 3) {
        // 要提交的数据
        $point = $_GET['point'];
        $data = ['areaName' => $point];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.oceanguide.org.cn/hyyj2/fisheryport/tideThirtyAging',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                'Accept: */*',
                'Host: www.oceanguide.org.cn',
                'Connection: keep-alive',
                'Content-Type: multipart/form-data;',
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        if (strstr($response, '获取成功') && isset($_GET['ApiRequest'])) {

            // 要提交的数据
            $data = array('ApiRequest' => $_GET['ApiRequest']);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://global-tide.nmdis.org.cn/Api/Service.ashx',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                    'Accept: */*',
                    'Host: global-tide.nmdis.org.cn',
                    'Connection: keep-alive',
                    'Content-Type: multipart/form-data;',
                    'Cookie: ASP.NET_SessionId=dt3bh3sejcy31b2q55ynel3x'
                ),
            ));

            $response2 = curl_exec($curl);

            curl_close($curl);
            echo '{"State":"true","Response":' . $response . ',"Response2":' . $response2 . '}';
            exit;
        }
        echo   '{"State":"false","Response":' . $response . ',"Response2":' . $response2 . '}';
        exit;
    }
} else {
    // 要请求的 URL
    $url = 'https://api.openweathermap.org/data/2.5/weather?lon=' . $_GET['lon'] . '&lat=' . $_GET['lat'] . '&appid=dfd932ab2b1ee2b826b854aea12e6713&lang=zh_cn';

    // 初始化 curl 对象
    $ch = curl_init();

    // 设置请求选项
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // 执行请求并获取返回的数据
    $response = curl_exec($ch);

    // 关闭 curl 对象
    curl_close($ch);

    // 处理返回的数据
    echo $response;
}
