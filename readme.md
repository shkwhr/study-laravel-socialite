# readme

## 目的
Laravel環境でSocialiteを使用してSalesforce OAuth認証が可能となる環境を作成する。

## テスト環境
* Mac OS X
* PHP 7.0
* Laravel 5.5
* PostgreSQL 10

## Laravel導入からパッケージ追加まで
### laravel framework installer
```
# composer global require "laravel/installer"
```

### create project
```
# composer create-project laravel/laravel test-laravel-socialite
```

### edit chmod
```
# cd test-laravel-socialite
# chmod -R 775 ./storage
# chmod -R 775 ./bootstrap/cache
```

-----
### install socialite & sfdc package
```
// socialite
# composer require laravel/socialite
// sfdc
# composer require socialiteproviders/salesforce
```

* app.php
```
'providers' => [
    // a whole bunch of providers
    // remove 'Laravel\Socialite\SocialiteServiceProvider',
    \SocialiteProviders\Manager\ServiceProvider::class, // add
],

'aliases' => [
  // Other aliases...
  'Socialite' => Laravel\Socialite\Facades\Socialite::class, ],
```

* .env
```
SALESFORCE_KEY={接続アプリケーション.コンシューマ鍵}
SALESFORCE_SECRET={接続アプリケーション.コンシューマの秘密}
SALESFORCE_REDIRECT_URI={接続アプリケーション.コールバックURL}
```

* and read this site
  * [Github] (https://github.com/laravel/socialite/tree/2.0)
  * [socialite providers] (https://socialiteproviders.github.io/)
  * [Salesforce 接続アプリケーションの作成] (https://help.salesforce.com/articleView?id=connected_app_create.htm)
-----


### Setup
#### compser package install
```
# composer install
# php artisan key:generate
# php artisan vendor:publish
```
#### npm package install
```
# npm install
```
#### Vue.js Build
```
# npm run dev
```
-----

### migration
#### migration file
```
# php artisan make:migration {file_name} --create={table_name}
```
* {file_name} : migration作成ファイル名
* --create={table_name} : テーブル作成コマンド

#### execute
```
# php artisan migrate
```
-----

### ログイン認証処理作成準備
#### 基本認証処理生成
```
# php artisan make:auth
```
#### 認証コントローラー作成
```
# php artisan make:controller Auth/AuthController
```

-----
### Create File
#### create model
```
# php artisan make:model モデル 名
```

#### create controller
```
# php artisan make:controller
```
