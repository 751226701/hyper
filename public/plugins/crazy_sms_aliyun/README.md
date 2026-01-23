## ThinkCMF 阿里云短信插件 ver 2.0

### 功能简介

本插件为阿里云短信专用，适用于国内与国际短信发送，均经过测试。

2.0版本使用了阿里云推荐的SDK 2.0。与以往不同，本版废弃了自动生成验证码功能，主要考虑验证码的生成与验证功能应该集成。更多情况请与作者联系：crazys@126.com。

### 准备

为了能够正常使用本插件，在使用之前，你需要开通阿里云短信，并准备好各项参数。本插件使用的参数有4个，分别是：

- AccessKey ID
- AccessKey Secret
- 短信签名名称
- 模板CODE

关于AccessKey的获取，可以参考<a href="https://help.aliyun.com/zh/ram/user-guide/create-an-accesskey-pair">创建AccessKey</a>，
本插件根据阿里云安全提示，优先从环境变量中提取AccessKey，如果将AccessKey保存在环境变量中，其环境变量名必须是：`ALIBABA_CLOUD_ACCESS_KEY_ID`和
`ALIBABA_CLOUD_ACCESS_KEY_SECRET`。其它参数的申请及获取，请参阅阿里云短信的相关资料。

> Tips: 本插件使用了新版PHP语法，最低要求PHP 版本为7！

虽然插件内置了阿里云的SDK，但如果你需要全局使用，请自行安装，方法如下：

1. 确保你的开发环境安装了 Composer 。
1. 确认你的电脑连接到互联网。
1. 在 CMD 运行环境下，进入网站根文件夹，运行下边指令：

```shell
composer require alibabacloud/dysmsapi-20170525 3.1.0
```

注意：如果安装时提示需要登录授权，有可能是镜像地址选择的问题，更新国内镜像地址如下即可：

```shell
composer config -g repo.packagist composer https://packagist.phpcomposer.com
```

> Tips: 如果是 5.0.190312 以前的系统，没有正确安装阿里短信第三方库，则插件预安装失败。5.1以上版本，本插件会自动安装第三方库。

### 安装

1. 将本插件复制到`public\plugins`文件夹下。
1. 进入ThinkCMF后台管理，左侧菜单中找到并点开【应用中心】->【插件管理】，在右侧找到【阿里云短信插件】，点击<kbd>+</kbd>按钮，提示成功表示正确安装。
   如果安装失败，及有可能是因为你的ThinkCMF版本为5.0.x，并且没有安装阿里云第三方库，请参阅准备一节安装。

> Tips：
> 如果是5.1以上版本安装失败，则有可能是插件目录没有写入权限，可以手动解压`data\dysmsapi.zip`至插件目录：`public\plugins\crazy_sms_aliyun`下，再安装。

### 设置

在上述界面安装成功后，点击插件列表右侧操作栏中的“设置”按钮，会弹出设置界面，将相关参数填好保存即可。

### 使用

本插件使用的是系统钩子：`send_mobile_verification_code`。在需要调用的代码处，使用hook_one()函数调用即可。

使用代码示例：

```php
// 发送短信的参数，数组的键值是固定的，不能自定义！
$params = [
    'phoneNumbers' => '接收信息的电话号码，多个号码必须使用数组',
    'templateCode' => '短信模板CODE，不指定则使用后台设置的模板CODE',  // 可选项
    'signName' => '短信签名，不指定则使用后台设置的签名',  // 可选项
    'templateParam' => [ // 可选项，数组中的键值是模板中定义的，不可随意填写
        '键1' => '值1',
        '键2' => '值2'
    ]
]; 
$result = hook_one('send_mobile_verification_code', $params);
```

#### 完整的代码示例

```php
// 组织短信参数（使用默认签名与模板）
$param = [
    // 电话号码可以是单个或多个，例如：'13900000000,13800000000'，
    // 也可以是数组，如：['13900000000', '13800000000']
    'phoneNumbers'  => '13900000000',
    'templateCode'  => 'SMS_170980463', // 可选项，模板CODE，默认使用后台设置
    'templateParam' => [ // 可选项，只有模板中有变量时使用
        'name'    => '惠达浪', // 设置变量内容，与短信模板中的`${name}`对应
        'content' => '本信息是为了测试' // 设置变量内容，与短信模板中的`${content}`对应
    ]
    'signName'      => '短信签名', // 可选项，短信签名，默认使用后台设置
];

// 调用插件，获取返回结果
$result = hook_one('send_mobile_verification_code', $param);
```

#### 返回结果说明

返回结果是一个数组，结构如下：

```text
array(2) {
   ["error"] => int(0)
   ["message"] => array(4) {
      ["BizId"] => string(20) "729217030970776018^0"
      ["Code"] => string(2) "OK"
      ["Message"] => string(2) "OK"
      ["RequestId"] => string(36) "960D39BD-8235-51E0-B9EB-A9B0F13A6B5F"
   }
}
```

- error: 错误代码，0 表示成功，1 表示失败。
- message: 阿里云返回的信息，可以根据开发需要调用。

错误处理代码示例：

```php
if (empty($result['error'])) {
    // 发送成功逻辑
} else {
    // 发送失败逻辑
}
```

> 如果运行时返回如下错误：
> cURL error 60: SSL certificate problem: unable to get local issuer certificate (see https://curl.haxx.se/libcurl/c/libcurl-errors.html)
>
> 此问题的出现是由于没有配置信任的服务器HTTPS验证。下载一个cacert.pem文件，在php.ini中找到curl.cainfo，设置好即可。
>
> `curl.cainfo = D:\PHP\extras\ssl\cacert.pem`
>
> 路径必须为完整的路径

### 联系作者

E-mail: crazys@126.com

作者微信：

<img src="https://www.qdcrazy.cn/upload/default/20190607/cbe2d6766c9eccf5ee3c004d166ae275.jpg" alt="wxcrazys">

### 更新记录

2.0.0

2024.11.07

- 按阿里云的改动，将SDK更改为Dysmsapi，版本3.1.0，重构代码
- 将验证码与消息短信合并，适用有多个模板的情况
- 适配ThinkCMF 8
- 内置阿里云SDK

---
1.1.8

2020.07.27

- 升级阿里云SDK，版本为1.5.29
- 同时更新其它依赖至最新版本

---
1.1.7

2020.07.27

- 升级阿里云SDK，版本为1.5.27
- 同时更新其它依赖至最新版本

---
1.1.6

2020.06.28

- 升级阿里云SDK，版本为1.5.24
- 同时更新其它依赖至最新版本

---

1.1.5

2020.01.19

- 升级阿里云SDK，版本为1.5.20
- 更新其它依赖至最新版本

---

1.1.4

2019.12.17

- 升级阿里云SDK，版本为1.5.19
- 更新其它依赖至最新版本
- 修正说明文件中的错误
- 修复AccessKey说明中，链接在本页打开的bug

---

1.1.3

2019.08.01

- 调整数据结构，模板参数单独处理
- 新增对多模板的支持
- 升级阿里云SDK，版本为1.5.14

---
1.1.2

2019.07.24

- 更新自动安装阿里云SDK的逻辑判断，最低版本为 5.0.190312

---
1.1.1

2019.07.22

- 验证码返回值中，增加`expire_time`键值，以兼容ThinkCMF用户验证

---
1.1.0

2019.07.21

- 重构代码逻辑，让代码更简洁，为未来功能扩展打下基础
- 更新验证码部分，支持由插件生成验证码并发送
- 更新安装逻辑，如果ThinkCMF版本为5.0，并且系统没有安装阿里云SDK，插件无法安装

---
1.0.0

2019.07.16 正式版发布！