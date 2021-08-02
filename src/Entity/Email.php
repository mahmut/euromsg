<?php
/**
 * ----------------------------------------
 * author : Mahmut ÖZDEMİR
 * web    : www.mahmutozdemir.com.tr
 * email  : bilgi@mahmutozdemir.com.tr
 * ----------------------------------------
 * Date   : 2021-08-01 01:34
 * File   : Email.php
 */

namespace EuroMsg\Entity;

/**
 * Class Email
 * @package EuroMsg\Entity
 */
class Email
{
    /**
     * Gönderici Profil ID
     *
     * @var int|null
     */
    protected $senderProfileId;

    /**
     * Alıcı e-posta adresi
     *
     * @var string|null
     */
    protected $receiverEmailAddress;

    /**
     * E-Posta konusu
     *
     * @var string|null
     */
    protected $subject;

    /**
     * E-Posta içeriği - html
     *
     * @var string|null
     */
    protected $content;

    /**
     * E-Posta gönderiminin başlayacağı tarih. E-posta hemen gitmesi isteniyorsa bu alan boş bırakılmalıdır
     *
     * @var string
     */
    protected $startDate = "";

    /**
     * E-Posta gönderiminin biteceği tarih. Bu tarihe kadar gönderim işlemi tamamlanamamışsa işlem iptal edilecektir. Eğer kritik bir sonlanma tarihi yok ise bu alan boş geçilebilir.
     *
     * @var string
     */
    protected $finishDate = "";

    /**
     * Email constructor.
     *
     * @param int|null $senderProfileId
     * @param string|null $receiverEmailAddress
     * @param string|null $subject
     * @param string|null $content
     */
    public function __construct(?int $senderProfileId = null, ?string $receiverEmailAddress = null, ?string $subject = null, ?string $content = null)
    {
        $this->senderProfileId = $senderProfileId;
        $this->receiverEmailAddress = $receiverEmailAddress;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getSenderProfileId()
    {
        return $this->senderProfileId;
    }

    /**
     * @param mixed $senderProfileId
     * @return Email
     */
    public function setSenderProfileId($senderProfileId)
    {
        $this->senderProfileId = $senderProfileId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReceiverEmailAddress()
    {
        return $this->receiverEmailAddress;
    }

    /**
     * @param mixed $receiverEmailAddress
     * @return Email
     */
    public function setReceiverEmailAddress($receiverEmailAddress)
    {
        $this->receiverEmailAddress = $receiverEmailAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     * @return Email
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     * @return Email
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @param string $startDate
     * @return Email
     */
    public function setStartDate(string $startDate)
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getFinishDate(): string
    {
        return $this->finishDate;
    }

    /**
     * @param string $finishDate
     * @return Email
     */
    public function setFinishDate(string $finishDate)
    {
        $this->finishDate = $finishDate;
        return $this;
    }
}
