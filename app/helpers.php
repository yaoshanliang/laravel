<?php

/**
 * api格式化
 *
 * @param int    $code    返回码
 * @param string $message 返回说明
 * @param object|array $data    返回数据
 *
 * @return array
 */
function apiFormat($code, $message, $data = [])
{
    $res['code'] = $code;
    $res['message'] = $message;
    if (empty($data) && is_array($data)) {
        $data = (object)$data;
    }
    $res['data'] = $data;

    return $res;
}
/**
 * api统一返回
 *
 * @param int    $code    返回码
 * @param string $message 返回说明
 * @param object|array $data    返回数据
 *
 * @return \Illuminate\Http\JsonResponse
 */
function apiReturn($code, $message, $data = [])
{
    return response()->json(apiFormat($code, $message, $data), 200);
}

/**
 * 获取当前时间
 *
 * @return string
 */
function getNowTime()
{
    return date('Y-m-d H:i:s');
}

/**
 * curl get
 *
 * @param string $url 地址
 *
 * @return string
 */
function curlGet($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_USERAGENT, 'user_agent');
    $return = curl_exec($curl);
    curl_close($curl);

    return $return;
}

/**
 * curl get
 *
 * @param string $url 地址
 * @param array $data 数据
 *
 * @return string
 */
function curlPost($url, $data) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, 0);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($curl, CURLOPT_USERAGENT, 'user_agent');
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    $return = curl_exec($curl);
    curl_close($curl);

    return $return;
}

/**
 * 获取当前登录管理员ID
 *
 * @return int
 */
function getAdminUserId()
{
    $user = auth()->guard('admin')->user();
    if (isset($user)) {
        return $user->id;
    }

    return 0;
}

/**
 * 生成token
 *
 * @return string
 */
function generateToken()
{
    return md5(time().rand(1000, 9999));
}

/**
 * 获取当前登录管理员角色key
 *
 * @return int
 */
function getAdminUserRoleKey()
{
    $user = auth()->guard('admin')->user();
    if (isset($user)) {
        return $user->role_key;
    }

    return '';
}

/**
 * 判断是否为某种角色
 *
 * @return int
 */
function isRole($roleKey)
{
    $user = auth()->guard('admin')->user();
    if (isset($user)) {
        if ($user->role_key == $roleKey) {
            return true;
        }
    }

    return false;
}