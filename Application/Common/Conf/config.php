<?php
return array(
	//'配置项'=>'配置值'
    'DATA_AUTH_KEY' => 'weianzhifu', //默认数据加密KEY
    'COOKIE_EXPIRE' => 3600,
    'COOKIE_SECURE' => false,
    'COOKIE_HTTPONLY' => true,
    'LOAD_EXT_CONFIG' => 'database,mail',//
//    'URL_MODULE_MAP' => array('choudd'=>'Ladmin'), //设置模块映射 '模块映射名'=>'实际模块名'   不建议使用
    'MODULE_ALLOW_LIST' => array('Home','Ladmin'),//允许访问的模块
    'MODULE_DENY_LIST'=>  array('Common','Runtime'),    //禁止访问的模块
    /* 全局过滤配置 */
    'DEFAULT_FILTER' =>  'strip_tags,htmlspecialchars',
    /* URL配置 */
    'URL_CASE_INSENSITIVE' => True, //默认false 表示URL区分大小写 true则表示不区分大小写
    'URL_MODEL'            => 2, //URL模式
    'URL_PATHINFO_DEPR' => '_', //PATHINFO URL分割符

    'SESSION_AUTO_START' => true, //是否开启session

    /* 模板引擎设置 */
    'TMPL_TEMPLATE_SUFFIX' => '.html',

    'URL_HTML_SUFFIX' => '.html',
    'TOKEN_ON'      =>    true,
    'TMPL_L_DELIM' => '<{',
    'TMPL_R_DELIM' => '}>',
    'SHOW_PAGE_TRACE'=>false,
    'INVITECODE' => 4,//验证码的长度
    'user'=>'user',//普通用户url
    'agent'=>'agent',//代理url
);