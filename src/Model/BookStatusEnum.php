<?php


namespace App\Model;

enum BookStatusEnum: string
{
    case PUBLISHED = "Published";
    case REVIEWED = "Reviewed";
    case COMPLETED = "Complete";
}
