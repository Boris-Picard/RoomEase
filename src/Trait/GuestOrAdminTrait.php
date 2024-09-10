<?php

namespace App\Trait;

trait GuestOrAdminTrait
{
    protected function checkAccessGuestOrAdmin(): void
    {
        if (!$this->isGranted('ROLE_GUEST') && !$this->isGranted('ROLE_ADMIN')) {
            throw $this->createAccessDeniedException();
        }
    }
}
