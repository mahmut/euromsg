<?php
/**
 * ----------------------------------------
 * author : Mahmut ÖZDEMİR
 * web    : www.mahmutozdemir.com.tr
 * email  : bilgi@mahmutozdemir.com.tr
 * ----------------------------------------
 * Date   : 2021-08-01 01:37
 * File   : Token.php
 */

namespace EuroMsg\Entity;

/**
 * Class Token
 * @package EuroMsg\Entity
 */
class Token
{
    /**
     * @var string|null
     */
    protected $accountId;

    /**
     * @var string|null
     */
    protected $tokenValue;

    /**
     * @var \DateTime|null
     */
    protected $expireTime;

    /**
     * Token constructor.
     *
     * @param string|null $accountId
     * @param string|null $tokenValue
     * @param string|null $expireTime
     */
    public function __construct(?string $accountId = null, ?string $tokenValue = null, ?string $expireTime = null)
    {
        $this->accountId = $accountId;
        $this->tokenValue = $tokenValue;
        $this->expireTime = $expireTime;
    }

    /**
     * @return mixed
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param mixed $accountId
     * @return Token
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTokenValue()
    {
        return $this->tokenValue;
    }

    /**
     * @param mixed $tokenValue
     * @return Token
     */
    public function setTokenValue($tokenValue)
    {
        $this->tokenValue = $tokenValue;
        return $this;
    }

    /**
     * @return string
     */
    public function getExpireTime()
    {
        return $this->expireTime;
    }

    /**
     * @param mixed $expireTime
     * @return Token
     */
    public function setExpireTime($expireTime)
    {
        $this->expireTime = $expireTime;
        return $this;
    }

    /**
     * is token valid
     * @return bool
     */
    public function isExpired()
    {
        if(time() > $this->expireTime) return true;
        return false;
    }

    /**
     * create from json
     *
     * @param $file
     * @return Token|null
     */
    public static function createFromJson($file)
    {
        if($file && file_exists($file))
        {
            $data = json_decode(file_get_contents($file));
            if (json_last_error() === 0)
            {
                $token = new self();
                if(isset($data->accountId)) $token->setAccountId($data->accountId);
                if(isset($data->tokenValue)) $token->setTokenValue($data->tokenValue);
                if(isset($data->expireTime)) $token->setExpireTime($data->expireTime);

                return $token;
            }
        }

        return null;
    }

    /**
     * save
     *
     * @param $file
     * @param $content
     */
    public static function save($file, $content)
    {
        file_put_contents($file, $content);
    }
}
