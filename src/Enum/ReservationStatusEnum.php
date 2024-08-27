<?php

namespace App\Enum;

enum ReservationStatusEnum: string
{
    case Available = 'Available';
    case Pending = 'Pending';
    case Reserved = 'Reserved';
}
