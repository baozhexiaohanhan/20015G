<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101800717602",

		//商户私钥
		'merchant_private_key' => "MIIEvwIBADANBgkqhkiG9w0BAQEFAASCBKkwggSlAgEAAoIBAQCJDUAbGOVFJR3DnfmtxLCn2jssWvVtb2DeoPWP1RvXM/lEO/51vZxf/oXng2XaEZBfIX5gwAcf96B+P8djKwLlYIoZSYpL1J+GsRnIyaIKt7AmmcnMu/IFkkakqBTScDnx/8kU1wIxZ2CY3d4iavRBOI32ZI1rIN+Y7RCpui1trIgHTp6WcDn0WFua6RHnmKMvZjLQdV+5XRqW4FSiEbtfMSFVJbx91cLoxBOn0rv9r1pnUl3xedc5eOlp6IjlaYgWb5fO+a5Kvq2unkpf4C8ZVgrQZYG3zyCFzmJuNqOfr4d0uteqUKEwnQHsRWCn1Yj3aNG8y/U2J4zLrqwwGRkrAgMBAAECggEBAIPpXAV4zdvioKZS3CmTwlCc7Q2BMu61IDDIDfL1tIlK/iXd9MqQyP1gNrQhtZvSAfp+e2xWB8WOC0zYyGm70VrDs8gpD1JzgWQb++xVnoDgUkylAyXq1ETmiNYc7YWq/Sre/kTvua2hick464CHHzfTXliEadVt26kOrFYg227OBTKvQ2etqOV7feQxTxD28eYLy4AR/lAYP9984J7Md5S/CDZlR3VX11mxZ5nE/X2t7yNn+8vYk4+FA83M3VvCYt17PKOhnQI8JX0s14SPIKTfKX6dZcTp6bjpXLGiUzpa7ljOu8VMcKjVVEihzs9G8UIx1b+TWTWAnNzFosyPmtECgYEA+J80QMweuNCdrL9geuhqKbkwVXTNe+WEnqmoyjH5rDQ4HN3+39GRTzQYMKORWSDT1T3pKWlo1ccimOmzX3JQmI0uoJ2vVz+uF/hIedrZjY3mRP+D7OlLvF4oFwy/b9ug2qAzdMDEIgRArnv0/X1rts+7pOpNVssTKiW0Tq3gVtkCgYEAjR5w7HKNFFhq+4vh7SjekbHMEF9pciB/m/gCXwbFG6aQmVWDhihMkOM21UhDhAqgXqNVP8xfNJLxsGjku1nIOUQEWlTtG5egfzUEVMb9EpqJ6VHbj6Sk3MNh4SbsT+I+OofHspIMfaiMPjajweFd/yI6zjLr/2oqznl4tYryFaMCgYEA9JPxXHkxE9Ct/B28NMzkey0hvj+MUYDFSSxPzrEBE4W/Wa6Np/LKhucRkO+n8c0YduNTtxhqODuQ7mqguZmEbb4di4Xz0tnjUtM9wRopAFcCmwfd6TbL+X+K4rn4rXqar9f/JrDngSs70ipBJQm35/xNdPvFn0dhEApNaUUlt2kCgYBeQDWVhlB5hTA2v09usTwtvL0ZNlBb3B6+kd8rjn75H7812epVIPc6UbberjwBpYNEkfwu9xWjLH1loDkcdDOJI8dweYY/Rn74VvWElb6SvUpc3cIx5voBRDFMSk3McMO1HdifiHH1PywjpSSsKhQ4gaka7OG4HjVm37RiM+HJ1wKBgQDzokJX8KZ3vJc/Ip9HS+V/m+0KDLEHL2+Q3AaAK6Zcjbacsiht4o4k4V7vF57dIvDT5L9gsPSmln2BBPNGbRMX6xpRM6B7FtRofk8wc7nSyQ4Tq6KkFCrILZaph6FaZEdyc7DzoCrAxhPgv6InzGmBA15nEo1T2KFiidV9hZqP2A==",
		
		//异步通知地址
		'notify_url' => "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://localhost/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAku0yh1UHI1hwhprhECuAIf8p8X21h71xJenmR5HDVz1BPa4c+HPH16V97QVZZODSlSxDGc66VPN7k4LSNcPW7WFdxPOn+jYVXS/D2OHQZp8DBv7P0ZG7aUfb3r/vP8uFo5slELINt6/c2e4btyoRe8EP7wsBbEIrOOYGpN1pYaojD6e2ScYEhsOhOJb3MzhC4iD0dPIw0+NnRnV1eQwJH6ub89FTffCZ91L4nurGGA1y9JSo4w7u1NVOeFMJGYkWhroBbag6NkFMTwQzEGS3YJkYGwzHnrg7y4fYG5vABZCQq/Lx6xdXUKEQkqpC7p9UnfYsSBQSVbHaB02lfL9NZQIDAQAB",
);