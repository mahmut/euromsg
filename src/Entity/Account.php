<?php
/**
 * ----------------------------------------
 * author : Mahmut ÖZDEMİR
 * web    : www.mahmutozdemir.com.tr
 * email  : bilgi@mahmutozdemir.com.tr
 * ----------------------------------------
 * Date   : 2021-08-01 01:42
 * File   : Account.php
 */

namespace EuroMsg\Entity;

/**
 * Class Account
 *
 * @package EuroMsg\Entity
 */
class Account
{
    /**
     * euromsg hesap e-posta adresi
     *
     * @var string
     */
    protected $email;

    /**
     * euromsg hesap parolası
     *
     * @var string
     */
    protected $password;

    /**
     * Account constructor.
     *
     * @param string $email
     * @param string $password
     */
    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Account
     */
    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Account
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
        return $this;
    }
}
