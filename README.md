conohaDNS

===============

conohaDNSはconohaのapi通じて あなたのドメインを管理する\
conohaのDNS管理パネルが粗末だから、俺はこのプログラムを書きました。\
今は以下のタイプのレコードだけをサポートします
+ A
+ AAAA
+ CNAME
+ MX
+ TXT
+ NS
+ PTR

GREBをサポートしていない

> このプログラムは、PHPバージョンが7.0より大きいと要求されています。

## 使い方

-------

> このプログラムはcomposerを使う必要がある

+ `composer install`
+ `application\extra`開く、`setting.php.example`の名前を`setting.php`に変更する、内部の内容を変更します
+ ウェブワーク目録を`public`に設定する
+ rewriteを設定する


### rewrite

-------

> Apache

~~~
<IfModule mod_rewrite.c>
  Options +FollowSymlinks -Multiviews
  RewriteEngine On

  RewriteCond %{REQUEST_FILENAME} !-d
  RewriteCond %{REQUEST_FILENAME} !-f
  RewriteRule ^(.*)$ index.php/$1 [QSA,PT,L]
</IfModule>
~~~

* Apacheのrewriteは`.htaccess`として保存され、通常は直接使用できます。

> nginx

~~~
location / {
	if (!-e $request_filename){
		rewrite  ^(.*)$  /index.php?s=$1  last;   break;
	}
}
~~~

## 引用された第三者資源

-------


+ [SB-Admin2](https://github.com/BlackrockDigital/startbootstrap-sb-admin-2)
+ [ThinkPHP](https://thinkphp.cn)

***
Power By [Kagurazaka Shira](https://blog.ni-co.moe/)
