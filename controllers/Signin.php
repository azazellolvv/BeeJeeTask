<?php

namespace controllers;

use Rakit\Validation\Validator;

class Signin extends Controller
{
    public function login()
    {

        $validator = new Validator;
        $params = $_GET;
        $params = array_map(function($e){
            return htmlspecialchars($e);
        }, $params);

        if (!empty($_POST)) {
            $validation = $validator->make($_POST, [
                'name' => 'required',
                'password' => 'required',
            ]);

            // then validate
            $validation->validate();

            if ($validation->fails()) {
                // handling errors
                $errors = $validation->errors();
                $firstError = $errors->firstOfAll();
                $params['errorMessage'] = array_shift($firstError);
            } else {
                // validation passes
                if ($_POST['name'] == 'admin' && $_POST['password'] == '123') {

                    $_SESSION['adminLogin'] = true;
                    $this->redirect('tasks-index', '&successMessage=' . urlencode('Success login!'));

                } else {
                    $params['errorMessage'] = 'Incorrect access data!';
                }
            }
        }

        $this->render('signin/login.php', $params);
        exit;
    }

    public function logout()
    {
        $_SESSION['adminLogin'] = false;
        $this->redirect('tasks-index', '&successMessage=' . urlencode('Success logout!'));
    }
}