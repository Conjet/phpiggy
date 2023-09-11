<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
use App\Services\{
    ValidatorService,
    TransactionService
};


class TransactionController
{
    public function __construct(
        private TemplateEngine $view,
        private ValidatorService $validatorService,
        private TransactionService $transactionService
    ) {
    }

    public function createView()
    {
        echo $this->view->render("transactions/create.php");
    }

    public function create()
    {
        $this->validatorService->validateTransaction($_POST);
        $this->transactionService->create($_POST);
        redirectTo('/');
    }

    public function editView(array $params)
    {
        $transaction = $this->transactionService->getUserTransaction($params['transaction']);
        dd($transaction);

        if (!$transaction) {
            redirectTo('/');
        }

        echo $this->view->render('transaction/edit.php', [
            'transaction' => $transaction
        ]);
    }
}
