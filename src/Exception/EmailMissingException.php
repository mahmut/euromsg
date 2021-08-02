<?php
/**
 * ----------------------------------------
 * author : Mahmut ÖZDEMİR
 * web    : www.mahmutozdemir.com.tr
 * email  : bilgi@mahmutozdemir.com.tr
 * ----------------------------------------
 * Date   : 2021-08-01 02:26
 * File   : EmailMissingException.php
 */

namespace EuroMsg\Exception;

use Exception;
use Throwable;

class EmailMissingException extends Exception
{
    /**
     * EmailMissingException constructor.
     *
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "Gönderilecek e-posta bulunamadı", $code = 400, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
