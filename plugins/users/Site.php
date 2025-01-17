<?php

namespace Plugins\Users;

use Systems\SiteModule;

class Site extends SiteModule
{
    public function init()
    {
        $this->tpl->set('users', function () {
            $result = [];
            $users = $this->db('mlite_users')->select(['id', 'username', 'fullname', 'description', 'avatar', 'email'])->toArray();

            foreach ($users as $key => $value) {
                $result[$value['id']] = $users[$key];
                $result[$value['id']]['avatar'] = url('uploads/users/' . $value['avatar']);
            }
            return $result;
        });
    }

    public function routes()
    {
      $this->route('login', function () {
        echo '<!DOCTYPE html>
        <html>
        <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
        <title>RS Sinar Kasih Toraja</title>
        <link rel="icon" href="'.url().'/favicon.png" type="image/ico">
        <link href="'.url().'/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="'.url().'/themes/admin/css/style.css" rel="stylesheet">
        <style>
        body{
            background-color: #fff;
        }
        .error-page {
            height: 100%;
            position: fixed;
            width: 100%;
        }
        .error-body {
            padding-top: 5%;
        }
        .error-body h1 {
            font-size: 210px;
            font-weight: 700;
            text-shadow: 4px 4px 0 #f5f6fa, 6px 6px 0 #33cabb;
            line-height: 210px;
            color: #33cabb;
        }
        .error-body h4 {
            margin: 30px 0px;
        }
        </style>
        </head>

        <body>
        <section class="error-page">
          <div class="error-box">
            <div class="error-body text-center">
              <h1>403</h1>
              <h4>Akses dibatasi. Silahkan login dulu!!</h4>
              <a href="'.url([ADMIN]).'" class="btn btn-danger">Login</a>
            </div>
          </div>
        </section>
        </body>
        </html>';
        exit();
      });
    }

}
