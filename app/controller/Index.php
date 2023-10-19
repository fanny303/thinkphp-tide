<?php
// +----------------------------------------------------------------------
// | 文件: index.php
// +----------------------------------------------------------------------
// | 功能: 提供todo api接口
// +----------------------------------------------------------------------
// | 时间: 2021-11-15 16:20
// +----------------------------------------------------------------------
// | 作者: rangangwei<gangweiran@tencent.com>
// +----------------------------------------------------------------------

namespace app\controller;

use Error;
use Exception;
use app\model\Counters;
use think\response\Html;
use think\response\Json;
use think\facade\Log;

class Index
{

    /**
     * 主页静态页面
     * @return Html
     */
    public function index(): Html
    {
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
    }


    /**
     * 获取todo list
     * @return Json
     */
    public function getCount(): Json
    {
        try {
            $data = (new Counters)->find(1);
            if ($data == null) {
                $count = 0;
            }else {
                $count = $data["count"];
            }
            $res = [
                "code" => 0,
                "data" =>  $count
            ];
            Log::write('getCount rsp: '.json_encode($res));
            return json($res);
        } catch (Error $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("查询计数异常" . $e->getMessage())
            ];
            Log::write('getCount rsp: '.json_encode($res));
            return json($res);
        }
    }


    /**
     * 根据id查询todo数据
     * @param $action `string` 类型，枚举值，等于 `"inc"` 时，表示计数加一；等于 `"reset"` 时，表示计数重置（清零）
     * @return Json
     */
    public function updateCount($action): Json
    {
        try {
            if ($action == "inc") {
                $data = (new Counters)->find(1);
                if ($data == null) {
                    $count = 1;
                }else {
                    $count = $data["count"] + 1;
                }
    
                $counters = new Counters;
                $counters->create(
                    ["count" => $count, 'id' => 1],
                    ["count", 'id'],
                    true
                );
            }else if ($action == "clear") {
                Counters::destroy(1);
                $count = 0;
            }

            $res = [
                "code" => 0,
                "data" =>  $count
            ];
            Log::write('updateCount rsp: '.json_encode($res));
            return json($res);
        } catch (Exception $e) {
            $res = [
                "code" => -1,
                "data" => [],
                "errorMsg" => ("更新计数异常" . $e->getMessage())
            ];
            Log::write('updateCount rsp: '.json_encode($res));
            return json($res);
        }
    }
}
