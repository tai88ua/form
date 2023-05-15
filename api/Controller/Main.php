<?php

namespace App\Controller;


use App\Dto\Form;
use App\Service\Registration;
use App\View\View;
use Psr\Log\LoggerInterface;

class Main
{
    protected View $view;
    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index(Registration $registration): void
    {
        $form = new Form();
        $form->setFirstName(filter_input(INPUT_POST, 'firstName'));
        $form->setSecondName(filter_input(INPUT_POST, 'secondName'));
        $form->setEmail(filter_input(INPUT_POST, 'email'));
        $form->setPassword(filter_input(INPUT_POST, 'password'));
        $form->setPasswordRepeat(filter_input(INPUT_POST, 'passwordRepeat'));

        $data = [
            'error' => false,
            'message' => '',
        ];

        try {
            $registration->addUser($form);
            $data['message'] = Registration::MSG_OK;

        } catch (\Exception $exception) {
            $data['message'] = $exception->getMessage();
            $data['error'] = true;
        }

        $this->view->setData($data)->renderJson();
    }
}
