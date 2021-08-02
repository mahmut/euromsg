<?php
/**
 * ----------------------------------------
 * author : Mahmut ÖZDEMİR
 * web    : www.mahmutozdemir.com.tr
 * email  : bilgi@mahmutozdemir.com.tr
 * ----------------------------------------
 * Date   : 2021-08-01 02:26
 * File   : TokenMissingException.php
 */

namespace EuroMsg\Exception;

use Exception;
use Throwable;

class TokenMissingException extends Exception
{
    /**
     * TokenMissingException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Geçerli oturum bulunamadı", $code = 403, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
