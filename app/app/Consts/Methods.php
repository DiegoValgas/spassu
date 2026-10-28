<?php

/**
 * HTTP methods.
 */

namespace App\Consts;

enum Methods: string
{
    case Get = 'GET';
    case Post = 'POST';
    case Put = 'PUT';
    case Delete = 'DELETE';
}
