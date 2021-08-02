<?php
/**
 * ----------------------------------------
 * author : Mahmut ÖZDEMİR
 * web    : www.mahmutozdemir.com.tr
 * email  : bilgi@mahmutozdemir.com.tr
 * ----------------------------------------
 * Date   : 2021-08-01 01:51
 * File   : EuroMsgFactory.php
 */

namespace EuroMsg;

use EuroMsg\Entity\Account;

class EuroMsgFactory
{
    /**
     * create euromsg
     *
     * @param Account $account
     * @param string|null $tokenFile
     * @return EuroMsg
     */
    public static function create(Account $account, ?string $tokenFile = null): EuroMsg
    {
        return new EuroMsg($account, $tokenFile);
    }
}
