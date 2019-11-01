<?php

namespace controllers;

use models\Tasks as MTasks;
use Rakit\Validation\Validator;
use Zebra_Pagination;

class Tasks extends Controller
{
    private $taskModel;

    public function __construct()
    {
        $this->taskModel = new MTasks($GLOBALS['mysqli']);
    }

    public function index()
    {
        $records_per_page = 3;
        $params = $_GET;
        $params = array_map(function($e){
            return htmlspecialchars($e);
        }, $params);

        $countTask = $this->taskModel->getCount();
        $pageCount = (integer)($countTask / $records_per_page);
        $pageCount = ($countTask % $records_per_page) ? $pageCount + 1 : $pageCount;

        if(isset($params['page'])) {
            $params['page'] = $params['page'] <= 0 ? 1 : $params['page'];
            $params['page'] = $params['page'] > $pageCount ? $pageCount : $params['page'];
        } else {
            $params['page'] = 1;
        }

        if(isset($params['sort']) && !empty($params['sort'])) {
            $sort = str_replace('-', ' ', $params['sort']);
        } else {
            $sort = 'name asc';
        }

//        var_dump($pageCount);die;
        $taskList = $this->taskModel->getList($params['page'], $records_per_page, $sort);

        $params['taskList'] = $taskList;
        $params['pageCount'] = $pageCount;

        $this->render('tasks/index.php', $params);

    }

    public function edit()
    {
        $validator = new Validator;
        $params['isEdit'] = false;

var_dump($_POST);
        if (!empty($_POST)) {

            if (isset($_POST['isEdit'])) {
                if(!$_SESSION['adminLogin']) {
                    $this->redirect('signin-login', '&errorMessage=' . urlencode("Forbidden!"));
                }
                $validation = $validator->make($_POST, [
                    'text' => 'required',
                ]);

            } else {

                $validation = $validator->make($_POST, [
                    'name' => 'required',
                    'email' => 'required|email',
                    'text' => 'required',
                ]);
            }

                // then validate
                $validation->validate();

                if ($validation->fails()) {
                    // handling errors
                    $errors = $validation->errors();
                    $firstError = $errors->firstOfAll();
                    $key = key($firstError);
                    $params[$key . 'Error'] = true;
                    $params['errorMessage'] = array_shift($firstError);
                    $params['text'] = $_POST['text'];
                    if (!isset($_POST['isEdit'])) {
                        $params['name'] = $_POST['name'];
                        $params['email'] = $_POST['email'];
                    }
                } else {
                    // validation passes
                    if (isset($_POST['isEdit'])) {
                        $did = isset($_POST['did']) ? 1: 0;
                        $this->taskModel->updateTask($_POST['email'], $_POST['text'], $did);
                    } else {
                        $this->taskModel->saveTask($_POST['name'], $_POST['email'], $_POST['text']);
                    }
                    $this->redirect('tasks-index', '&successMessage=' . urlencode("Success save!"));
                }

        }

        if (isset($_GET['email']) || isset($_POST['isEdit'])) {
            if(!$_SESSION['adminLogin']) {
                $this->redirect('signin-login', '&errorMessage=' . urlencode("Forbidden!"));
            }

            $email = isset($_GET['email']) ? $_GET['email'] : $_POST['email'];
            $params2 = $this->taskModel->searchTask($email);
            $params = $params + $params2;
            $params['isEdit'] = true;
            if (isset($_POST['isEdit'])) {
                $params['text'] = $_POST['text'];
            }
        }

        $this->render('tasks/edit.php', $params);
    }
}