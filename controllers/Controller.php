<?php

namespace controllers;


abstract class Controller
{
    protected function render($template, $params)
    {
        $valueName = ['sort', 'page', 'errorMessage', 'name', 'email', 'password', 'nameError', 'emailError',
            'textError', 'message', 'taskList'];
        foreach ($valueName as $value) {
            if (!isset($params[$value])) {
                $params[$value] = '';
            }
        }

        ob_start();

        include __DIR__ . '/../views/' . $template;

        $content = ob_get_contents();
        ob_end_clean();

        include __DIR__ . '/../views/layouts.php';
    }

    protected function redirect($r, $paramsText = '')
    {
        header("Location: /index.php?r={$r}{$paramsText}");
        exit;
    }
}