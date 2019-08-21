<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Request;
use App\Models\Log as LogModel;

class Log implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    private $log;

    private $secretData = ['password', 'password_confirmation'];

    /**
     * 用户日志队列.
     *
     * @param array $response 返回数据
     *
     * @return void
     */
    public function __construct($response)
    {
        $requestAll = Request::all();

        // 隐私数据过滤
        foreach ($this->secretData as $v) {
            if (key_exists($v, $requestAll)) {
                $requestAll[$v] = '***';
            }
        }

        switch($response['guard']) {
            case 'admin':
                $userId = getAdminUserId();
                break;

            case 'web' :
                $userId = getWebUserId();
                break;

            case 'api' :
                if (isset($requestAll['token'])) {
                    $userId = getApiUserId($requestAll['token']);
                } else {
                    $userId = 0;
                }
                break;
                
            case 'weapp' :
                $token = Request::header('token');
                if ($token) {
                    $userId = getWeappUserId($token);
                } else {
                    $userId = 0;
                }
                break;

            default :
                $userId = 0;
        }

        $this->log = array(
            'guard' => $response['guard'],
            'user_id' => $userId,
            'request_method' => Request::server('REQUEST_METHOD'),
            'request_url' => urldecode(Request::url()),
            'request_params' => json_encode($requestAll, JSON_UNESCAPED_UNICODE),

            'response_code' => $response['code'],
            'response_message' => $response['message'],
            'response_data' => json_encode($response['data'], JSON_UNESCAPED_UNICODE),

            'user_ip' => Request::Ip(),
            'user_agent' => Request::server('HTTP_USER_AGENT'),
            'server_ip' => Request::server('SERVER_ADDR'),

            'request_time_float' => Request::server('REQUEST_TIME_FLOAT'),
            'pushed_time_float' => getMillisecond(),
        );
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        $this->log['poped_time_float'] = getMillisecond();
        $this->log['created_time_float'] = getMillisecond();
        $this->log['created_at'] = getNowTime();

        LogModel::create($this->log);
    }
}
