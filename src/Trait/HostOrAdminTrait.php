<?php

namespace App\Trait;

trait HostOrAdminTrait
{
    protected function checkAccessHostOrAdmin(): void
    {
        if (!$this->isGranted('ROLE_HOST') && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        }
    }
}
