# Scanner 接口文档

## 目录

1.  <a href="#user-content-login">登录</a>
2.  <a href="#user-content-register">注册</a>
3.  <a href="#user-content-generateOrder">生成订单</a>
4.  <a href="#user-content-appendLogistics">追加物流</a>
5.  <a href="#user-content-getOrder">获取订单</a>
6.  <a href="#user-content-getList">获取列表</a>

***

**1.<a id="user-content-login">登录</a>**

###### 接口功能

> 使用用户名和密码登录系统

###### URL

> [/index.php/Index/login]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> user | 是 | string | 用户名
> pass | 是 | string | 用户密码

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | int | 用户id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/index.php/Index/login]()
> 
> 参数： user=test& pass=123456


``` javascript
{"data":1,"info":"登陆成功!","status":1}
```

**2.<a id="user-content-register">注册</a>**

###### 接口功能

> 使用用户名和密码登录系统

###### URL

> [/index.php/Index/register]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> user | 是 | string | 用户名
> pass | 是 | string | 用户密码
> address | 是 | string | 用户地址(≤100字符)
> mobile | 是 | string | 用户手机(11位)

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | int | 用户id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/index.php/Index/register]()
> 
> 参数： user=test& pass=123456& address=天津市津南区& mobile=13131313131


``` javascript
{"data":1,"info":"注册成功!","status":1}
```

**3.<a id="user-content-generateOrder">生成订单</a>**

###### 接口功能

> 生成快递订单

###### URL

> [/index.php/Index/generateOrder]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> user | 是 | string | 用户名
> pass | 是 | string | 用户密码
> express | 是 | int | 快递编号
> s_name | 是 | string | 寄件人姓名
> s_address | 是 | string | 寄件人地址
> s_mobile | 是 | int | 寄件人手机号
> r_name | 是 | string | 收件人姓名
> r_address | 是 | string | 收件人地址
> r_mobile | 是 | string | 收件人手机号

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | int | 订单id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/index.php/Index/generateOrder]()
> 
> 参数： user=test& pass=123456& express=1234567890123& s_name=sender& s_address=senderAddress& s_mobile=13000000000& r_name=receiver& r_address=receiverAddress& r_mobile=13000000001


``` javascript
{"data":1,"info":"生成成功!","status":1}
```

**4.<a id="user-content-appendLogistics">追加物流</a>**

###### 接口功能

> 为订单追加物流信息

###### URL

> [/index.php/Index/appendLogistics]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> user | 是 | string | 用户名
> pass | 是 | string | 用户密码
> oid | 是 | int 订单id

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | int | 物流id
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/index.php/Index/appendLogistics]()
> 
> 参数： user=test& pass=123456& oid=1


``` javascript
{"data":1,"info":"追加成功!","status":1}
```

**5.<a id="user-content-getOrder">获取订单</a>**

###### 接口功能

> 获取订单详情

###### URL

> [/index.php/Index/getOrder]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> user | 是 | string | 用户名
> pass | 是 | string | 用户密码
> oid | 是 | int 订单id

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
> data | Object | 订单详情
> id | data | 订单id
> express | data | 快递编号
> uid | data | 用户id
> s_name | data | 寄件人姓名
> s_address | data | 寄件人地址
> s_mobile | data | 寄件人手机
> r_name | data | 收件人姓名
> r_address | data | 收件人地址
> r_mobile | data | 收件人手机
> datetime | data | 订单创建日期
> content data | 物流信息
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/index.php/Index/getOrder]()
> 
> 参数： user=test& pass=123456& oid=1


``` javascript
{
  "data": {
    "id": "1",
    "express": "1234567890123",
    "uid": "1",
    "s_name": "sender",
    "s_address": "senderAddress",
    "s_mobile": "13000000000",
    "r_name": "receiver",
    "r_address": "receiverAddress",
    "r_mobile": "13000000001",
    "datetime": "2017-06-07 20:57:53",
    "content": "快递员【test】在【天津市】于【2017-06-07 20:58:05】签收\n"
  },
  "info": "获取成功!",
  "status": 1
}
```

**6.<a id="user-content-getList">获取订单</a>**

###### 接口功能

> 获取订单详情

###### URL

> [/index.php/Index/getList]()

###### 返回格式

> JSON

###### HTTP请求方式

> POST

###### 请求参数

> 参数 | 必选 | 类型 | 说明
> ---|----|----|---
> user | 是 | string | 用户名
> pass | 是 | string | 用户密码

###### 返回字段

> 参数 | 类型 | 说明
> ---|----|---
>- data | Array | 订单详情
>> id | data | 订单id
>> express | data | 快递编号
>> datetime | data | 订单创建日期
> info | string | 提示信息(unicode)
> status | int | 状态代码,0:失败,1:成功

###### 接口示例

> 地址：> [/index.php/Index/getList]()
> 
> 参数： user=test& pass=123456


``` javascript
{
  "data": [
    {
      "id": "1",
      "express": "1234567890123",
      "datetime": "2017-06-07 20:57:53"
    }
  ],
  "info": "获取成功!",
  "status": 1
}
```