<?php

namespace api\controllers\account;

use api\controllers\BaseController;
use common\models\User;

/**
 * Notes: 登录-控制器
 * User: zhangjinyu
 * Email: 363626256@qq.com
 * Time: 2020/11/29 19:43
 */

class LoginController extends BaseController
{

    public function actionSendEmail()
    {
        return $this->success(['key' => 'send_email'], 200);
    }

    /**
     * @Notes: 列表页
     * @return array
     * @Author: zhangjinyu
     * @Email: 363626256@qq.com
     * @Time: 2020/12/5 12:05
     */
    public function actionIndex()
    {
        $list = User::findAll([1]);
        return $this->success($list, 200, '我是列表页');
    }


    /**
     * @Notes: 单条记录展示
     * @param $id
     * @return array
     * @Author: zhangjinyu
     * @Email: 363626256@qq.com
     * @Time: 2020/12/5 12:05
     */
    public function actionView($id)
    {
        return $this->success(['id' => $id], 200, 'view');
    }


//create：创建新的资源；
//update：更新一个存在的资源；
//delete：删除指定的资源；
//options：返回支持的 HTTP 方法。

    public function actionCreate()
    {
        $data = ['a' => 1];
        return $this->success($data,200);
    }

    public function actionUpdate($id)
    {
        $data = ['a' => $id];
        return $this->success($data,200);
    }

    public function actionDelete($id)
    {
        $data = ['a' => $id];
        return $this->success($data,200);
    }


    public function actionOptions()
    {
        $data = ['a' => 888];
        return $this->success($data,200);
    }
}