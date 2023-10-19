<?php
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
if(isset($_GET['cx'])){
			// 要提交的数据
			$data = array('ApiRequest' => $_GET['ApiRequest']);

			// 初始化 curl 对象
			$ch = curl_init();

			// 设置请求选项
			curl_setopt($ch, CURLOPT_URL, 'http://global-tide.nmdis.org.cn/Api/Service.ashx');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			// 执行请求并获取返回的数据
			$response = curl_exec($ch);

			// 关闭 curl 对象
			curl_close($ch);

			// 处理返回的数据
			echo $response;
		}else{
			// 要请求的 URL
			$url = 'https://api.openweathermap.org/data/2.5/weather?lon='.$_GET['lon'].'&lat='.$_GET['lat'].'&appid=dfd932ab2b1ee2b826b854aea12e6713&lang=zh_cn';

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