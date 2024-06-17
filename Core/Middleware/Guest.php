<?php

namespace Core\Middleware;

class Guest
{
    public function handle(): void
    {
        if (isset($_SESSION['user']) ?? false) {
            header('location: /');
            exit();
        }
    }
}
