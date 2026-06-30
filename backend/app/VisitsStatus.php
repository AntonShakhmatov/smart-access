<?php

namespace App;

enum VisitsStatus: string
{
    case CREATED = 'created';
    case APPROVED = 'approved';
    case DENIED = 'denied';
    case CHECKED_IN = 'checked_in';
    case CHECKED_OUT = 'checked_out';
}
