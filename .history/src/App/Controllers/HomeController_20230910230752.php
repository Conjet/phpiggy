<?php

declare(strict_types=1);

namespace App\Controllers;

use Framework\TemplateEngine;
// use App\Config\Paths;
use App\Services\TransactionService;

class HomeController
{

    public function __construct(
        private TemplateEngine $view,
        private TransactionService $transactionService
    ) {
    }

    public function home()
    {
        $page = $_GET['p'] ?? 1;
        $page = (int) $page;
        $length = 3;
        $offset = ($page - 1) * $length;

        $searchTerm = $_GET['s'] ?? null;

        [$transations, $count] = $this->transactionService->getUserTransactions(
            $length,
            $offset
        );

        $lastPage = ceil($count / $length);

        $pages = $lastPage ? range(1, $lastPage) : [];

        $pageLink = array_map();

        echo $this->view->render('/index.php', [
            'transactions' => $transations,
            'currentPage' => $page,
            'previousPageQuery' => http_build_query([
                'p' => $page - 1,
                's' => $searchTerm
            ]),
            'lastPage' => $lastPage,
            'nextPageQuery' =>  http_build_query([
                'p' => $page + 1,
                's' => $searchTerm
            ])
        ]);
    }
}
