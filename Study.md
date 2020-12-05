# 版本 1.0.2

## 增加Restful API

#### 一.操作

- 1.创建文件nginx.htaccess，增加nginx重写，优化URL



```nginx
# api\web\nginx.htaccess 
location / {
    try_files $uri $uri/ /index.php$is_args$args;
}
```

- 2.api\config\main.php配置Restful API

```php
# api\config\main.php 部分代码
'urlManager' => [
            'enablePrettyUrl' => true, // 美化URL
            'showScriptName' => false, // 是否隐藏index.php
            'enableStrictParsing' => false, // 是否开启严格解析
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => ['account/login'],  // 控制器
                    'pluralize' => false,    //设置为false 就可以去掉复数形式了(官方推荐：保留复数形式。但是我个人在开发中，习惯于与控制器一一对应，所以是取消了复数形式)
                    'extraPatterns'=>[
                        'POST send-email' => 'send-email'  // 定义额外路由与控制器中方法的映射关系
                    ],
                ]
            ],
        ],
```

- 3.打印yii\rest\UrlRule中的具体规则，文件位置vendor/yiisoft/yii2/rest/UrlRule.php

```php
# 打印$this->rules
Array
(
    [account/logins] => Array
        (
            [0] => yii\web\UrlRule Object
                (
                    [name] => account/logins/send-email
                    [pattern] => #^account/login/send-email$#u
                    [host] => 
                    [route] => account/login/send-email
                    [defaults] => Array()
                    [suffix] => 
                    [verb] => Array
                        (
                            [0] => POST
                        )
                    [mode] => 1
                    [encodeParams] => 1
                    [normalizer] => 
                    [createStatus:protected] => 
                    [placeholders:protected] => Array()
                    [_template:yii\web\UrlRule:private] => /account/logins/send-email/
                    [_routeRule:yii\web\UrlRule:private] => 
                    [_paramRules:yii\web\UrlRule:private] => Array()
                    [_routeParams:yii\web\UrlRule:private] => Array()
                )
            [1] => yii\web\UrlRule Object
                (
                    [name] => account/logins/<id:\d[\d,]*>
                    [pattern] => #^account/login/(?P<abf396750>\d[\d,]*)$#u
                    [host] => 
                    [route] => account/login/update
                    [defaults] => Array()
                    [suffix] => 
                    [verb] => Array
                        (
                            [0] => PUT
                            [1] => PATCH
                        )
                    [mode] => 1
                    [encodeParams] => 1
                    [normalizer] => 
                    [createStatus:protected] => 
                    [placeholders:protected] => Array
                        (
                            [abf396750] => id
                        )
                    [_template:yii\web\UrlRule:private] => /account/logins/<id>/
                    [_routeRule:yii\web\UrlRule:private] => 
                    [_paramRules:yii\web\UrlRule:private] => Array
                        (
                            [id] => #^\d[\d,]*$#u
                        )
                    [_routeParams:yii\web\UrlRule:private] => Array ()
                )
            [2] => yii\web\UrlRule Object
                (
                    [name] => account/logins/<id:\d[\d,]*>
                    [pattern] => #^account/login/(?P<abf396750>\d[\d,]*)$#u
                    [host] => 
                    [route] => account/login/delete
                    [defaults] => Array()
                    [suffix] => 
                    [verb] => Array
                        (
                            [0] => DELETE
                        )
                    [mode] => 1
                    [encodeParams] => 1
                    [normalizer] => 
                    [createStatus:protected] => 
                    [placeholders:protected] => Array
                        (
                            [abf396750] => id
                        )
                    [_template:yii\web\UrlRule:private] => /account/logins/<id>/
                    [_routeRule:yii\web\UrlRule:private] => 
                    [_paramRules:yii\web\UrlRule:private] => Array
                        (
                            [id] => #^\d[\d,]*$#u
                        )
                    [_routeParams:yii\web\UrlRule:private] => Array()
                )
            [3] => yii\web\UrlRule Object
                (
                    [name] => account/logins/<id:\d[\d,]*>
                    [pattern] => #^account/login/(?P<abf396750>\d[\d,]*)$#u
                    [host] => 
                    [route] => account/login/view
                    [defaults] => Array()
                    [suffix] => 
                    [verb] => Array
                        (
                            [0] => GET
                            [1] => HEAD
                        )
                    [mode] => 
                    [encodeParams] => 1
                    [normalizer] => 
                    [createStatus:protected] => 
                    [placeholders:protected] => Array
                        (
                            [abf396750] => id
                        )
                    [_template:yii\web\UrlRule:private] => /account/logins/<id>/
                    [_routeRule:yii\web\UrlRule:private] => 
                    [_paramRules:yii\web\UrlRule:private] => Array
                        (
                            [id] => #^\d[\d,]*$#u
                        )
                    [_routeParams:yii\web\UrlRule:private] => Array()
                )
            [4] => yii\web\UrlRule Object
                (
                    [name] => account/logins
                    [pattern] => #^account/login$#u
                    [host] => 
                    [route] => account/login/create
                    [defaults] => Array ()
                    [suffix] => 
                    [verb] => Array
                        (
                            [0] => POST
                        )
                    [mode] => 1
                    [encodeParams] => 1
                    [normalizer] => 
                    [createStatus:protected] => 
                    [placeholders:protected] => Array()
                    [_template:yii\web\UrlRule:private] => /account/logins/
                    [_routeRule:yii\web\UrlRule:private] => 
                    [_paramRules:yii\web\UrlRule:private] => Array()
                    [_routeParams:yii\web\UrlRule:private] => Array()
                )
            [5] => yii\web\UrlRule Object
                (
                    [name] => account/logins
                    [pattern] => #^account/login$#u
                    [host] => 
                    [route] => account/login/index
                    [defaults] => Array()
                    [suffix] => 
                    [verb] => Array
                        (
                            [0] => GET
                            [1] => HEAD
                        )
                    [mode] => 
                    [encodeParams] => 1
                    [normalizer] => 
                    [createStatus:protected] => 
                    [placeholders:protected] => Array()
                    [_template:yii\web\UrlRule:private] => /account/logins/
                    [_routeRule:yii\web\UrlRule:private] => 
                    [_paramRules:yii\web\UrlRule:private] => Array()
                    [_routeParams:yii\web\UrlRule:private] => Array()
                )
            [6] => yii\web\UrlRule Object
                (
                    [name] => account/logins/<id:\d[\d,]*>
                    [pattern] => #^account/login/(?P<abf396750>\d[\d,]*)$#u
                    [host] => 
                    [route] => account/login/options
                    [defaults] => Array()
                    [suffix] => 
                    [verb] => Array()
                    [mode] => 
                    [encodeParams] => 1
                    [normalizer] => 
                    [createStatus:protected] => 
                    [placeholders:protected] => Array
                        (
                            [abf396750] => id
                        )
                    [_template:yii\web\UrlRule:private] => /account/logins/<id>/
                    [_routeRule:yii\web\UrlRule:private] => 
                    [_paramRules:yii\web\UrlRule:private] => Array
                        (
                            [id] => #^\d[\d,]*$#u
                        )
                    [_routeParams:yii\web\UrlRule:private] => Array()
                )

            [7] => yii\web\UrlRule Object
                (
                    [name] => account/logins
                    [pattern] => #^account/login$#u
                    [host] => 
                    [route] => account/login/options
                    [defaults] => Array()
                    [suffix] => 
                    [verb] => Array()
                    [mode] => 
                    [encodeParams] => 1
                    [normalizer] => 
                    [createStatus:protected] => 
                    [placeholders:protected] => Array()
                    [_template:yii\web\UrlRule:private] => /account/logins/
                    [_routeRule:yii\web\UrlRule:private] => 
                    [_paramRules:yii\web\UrlRule:private] => Array()
                    [_routeParams:yii\web\UrlRule:private] => Array()
                )
        )
)
```



- 4.创建基类控制器

```php
# api\controllers\BaseController.php
   /**
     * @Notes: 资源控制器中的所有路径方法
     * @return array
     * @Author: zhangjinyu
     * @Email: 363626256@qq.com
     * @Time: 2020/12/5 11:25
     */
    public function actions()
    {
        $actions = parent::actions(); // TODO: Change the autogenerated stub
        // 销毁对应路由，由控制器进行自定义返回格式
        unset(
            $actions['index'],
            $actions['view'],
            $actions['options'],
            $actions['create'],
            $actions['delete'],
            $actions['update']
        );

        return $actions;
    }
```

- 5.创建登录控制器 api\controllers\account\LoginController

```PHP
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

}
```

- 6.访问并返回

```json
// URL：http://advanced1.api.com/account/login/send-email   POST方式
{
    "data": {
        "key": "send_email"
    },
    "status": 200,
    "message": "OK"
}

// URL：http://advanced1.api.com/account/login  GET方式
{
    "data": [
        {
            "id": 1,
            "username": "1",
            "auth_key": "1",
            "password_hash": "1",
            "password_reset_token": null,
            "email": "1",
            "status": 10,
            "created_at": 1,
            "updated_at": 1,
            "verification_token": null
        }
    ],
    "status": 200,
    "message": "我是列表页"
}

// URL：http://advanced1.api.com/account/login/2  GET方式
{
    "data": {
        "id": "2"
    },
    "status": 200,
    "message": "view"
}
```

- 7.总结

| 路径                     | 请求方式 | 控制器        | 方法            | 作用                              | 性质           |
| ------------------------ | -------- | ------------- | --------------- | --------------------------------- | -------------- |
| account/login/send-email | POST     | account/login | actionSendEmail | 自定义路由                        | 自定义         |
| account/login            | GET      | account/login | actionIndex     | 用于获取列表资源                  | 安全、幂等     |
| account/login/$id        | GET      | account/login | actionView      | 用于获取单个资源                  | 安全、幂等     |
| account/login            | POST     | account/login | actionCreate    | 用于创建子资源                    | 非安全、非幂等 |
| account/login/$id        | PUT      | account/login | actionUpdate    | 全量更新                          | 非安全、幂等   |
| account/login/$id        | PATCH    | account/login | actionUpdate    | 部分更新                          | 非安全、幂等   |
| account/login/$id        | DELETE   | account/login | actionDelete    | 删除资源                          | 非安全、幂等； |
| account/login/           | OPTIONS  | account/login | actionOption    | 用于url验证，验证接口服务是否正常 | 安全、幂等     |

