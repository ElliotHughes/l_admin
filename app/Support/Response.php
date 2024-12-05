<?php
/**
 *  统一返回数据
 */
namespace App\Support;

use AllowDynamicProperties;
use Illuminate\Support\Facades\DB;

class Response
{

    /**
     * 返回码 200
     *
     * @var int
     */
    public $code = Code::SUCC_HTTP_OK;

    /**
     * 异常
     *
     * @var
     */
    public $exception;

    /**
     * 数据
     *
     * @var
     */
    public $data;

    /**
     * 元信息
     *
     * @var array
     */
    public $meta = [];

    /**
     * 时间
     *
     * @var
     */
    public $time;

    /**
     * 返回码
     *
     * @var
     */
    public $headerCode;

    /**
     * 输出内容
     *
     * @var
     */
    private $output;

    private $orginResponse;

    /**
     * @return \Illuminate\Http\Response
     */
    public function getOrginResponse()
    {
        return $this->orginResponse;
    }

    /**
     * @param mixed $orginResponse
     */
    public function setOrginResponse($orginResponse): void
    {
        $this->orginResponse = $orginResponse;
    }


    public function __construct()
    {
        $this->setOrginResponse(response(''));
    }

    /**
     * 设置数据
     * @param array $data 原始数据
     * @throws \Exception
     * @return void
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * 设置异常信息
     *
     * @param object $exception 异常对象
     */
    public function setException(object $exception)
    {
        $this->exception = $exception;
    }

    /**
     * 组合接口数据
     */
    public function prepare()
    {
        $output = [];

        if (!is_null($this->data)) {
            $output['data'] = $this->data;
            if (!isset($output['data']['meta'])) {
                $output['data']['meta'] = [];
            }
            $output['data']['meta'] = array_merge(
                $output['data']['meta'],
                $this->meta
            );
        } elseif (!empty($this->meta)) {
            $output['data']['meta'] = $this->meta;
        }

        if (empty($output['data']['meta'])) {
            unset($output['data']['meta']);
        }

        if (config('app.debug')) {
            $detail = Code::getDetail();
            if (!is_null($detail)) {
                $output['detail'] = $detail;
            }

            if ($this->exception instanceof \Exception) {
                $output['exception'] = get_class($this->exception) . ':' . $this->exception->getMessage();
            }

            $connections = array_keys(
                config(
                    'database.connections',
                    []
                )
            );
            $output['query'] = [];
            foreach ($connections as $connection) {
                $logs = DB::connection($connection)
                    ->getQueryLog();
                if (!empty($logs)) {
                    $output['query'][$connection] = $logs;
                }
            }
        }

        [
            $code,
            $msg,
        ] = Code::getCode();
        $output['code'] = $code;
        $output['msg'] = $msg;
        $output['time'] = date('Y-m-d H:i:s');
        $output['trace_id'] = request()->get('trace_id');
        $this->output = $output;
    }

    /**
     * 返回 json 数据
     *
     * @param null $data
     * @param null $fields
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function send($data = null, $fields = null)
    {
        if (is_null($data)) {
            $this->setData(
                []
            );
        }
        if (!is_null($data) && !is_bool($data)) {
            $this->setData(
                $data
            );
        }

        $this->prepare();
        $headerCode = $this->headerCode ?: $this->code;

        return response()->json(
            $this->output,
            $headerCode,
            ['Content-type' => 'application/json; charset=utf-8'],
            JSON_UNESCAPED_UNICODE
        );
    }


}
