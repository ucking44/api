<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongsToUser extends Exception
{
    public function render()
    {
        return ['errors' => 'Product Do Not Belong To This User'];
    }
}
