<?php
/**
 * ----------------------------------------
 * author : Mahmut ÖZDEMİR
 * web    : www.mahmutozdemir.com.tr
 * email  : bilgi@mahmutozdemir.com.tr
 * ----------------------------------------
 * Date   : 2021-08-01 01:07
 * File   : EuroMsg.php
 */

namespace EuroMsg;

use EuroMsg\Entity\Account;
use EuroMsg\Entity\Email;
use EuroMsg\Entity\Token;
use EuroMsg\Exception\AccountMissingException;
use EuroMsg\Exception\EmailMissingException;
use EuroMsg\Exception\TokenMissingException;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

/**
 * Class EuroMsg
 *
 * @package EuroMsg
 */
class EuroMsg
{
    /**
     * account information
     *
     * @var Account
     */
    protected $account;

    /**
     * token object
     *
     * @var Token|null
     */
    protected $token;

    /**
     * token file
     *
     * @var string|null
     */
    protected $tokenFile;

    /**
     * email information
     *
     * @var Email
     */
    protected $email;

    /**
     * http client
     *
     * @var Client
     */
    protected $client;

    /**
     * config
     *
     * @var mixed
     */
    protected $config;

    /**
     * @var object
     */
    protected $response;

    /**
     * EuroMsg constructor.
     *
     * @param Account $account
     * @param string|null $tokenFile
     */
    public function __construct(Account $account, ?string $tokenFile = null)
    {
        $this->config = require __DIR__.'/config.php';

        $this->account = $account;
        $this->token = null;
        $this->tokenFile = $tokenFile;

        if($tokenFile){
            $this->token = Token::createFromJson($tokenFile);
            if(!$this->token || $this->token->isExpired()){
                $this->token = null;
            }
        }

        // client
        $this->client = new Client([
            'base_uri' => $this->config['base_uri']
        ]);
    }

    /**
     * get account
     *
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * get token
     *
     * @return Token|null
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * set email
     *
     * @param Email $email
     * @return $this
     */
    public function setEmail(Email $email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Check token and login
     *
     * @return $this
     * @throws TokenMissingException|AccountMissingException
     */
    public function login()
    {
        if(!$this->account){
            throw new AccountMissingException();
        }

        if(!$this->token){
            $request = $this->client->post($this->config['endpoints']['tokens'], [
                'json' => [
                    'email' => $this->account->getEmail(),
                    'password' => $this->account->getPassword(),
                ]
            ]);

            if($request->getStatusCode() == 201){
                $response = json_decode($request->getBody()->getContents());
                if(isset($response->accountId)){
                    $this->token = new Token($response->accountId, $response->tokenValue, $response->expireTime);
                    Token::save($this->tokenFile, json_encode($response));
                } else {
                    throw new TokenMissingException();
                }
            } else {
                throw new TokenMissingException();
            }
        }

        return $this;
    }

    /**
     * send email
     *
     * @throws AccountMissingException
     * @throws EmailMissingException
     * @throws TokenMissingException
     */
    public function send()
    {
        if(!$this->account){
            throw new AccountMissingException();
        }

        if(!$this->token){
            throw new TokenMissingException();
        }

        if(!$this->email){
            throw new EmailMissingException();
        }

        try{

            $uri = sprintf($this->config['endpoints']['transactional_email'], $this->token->getAccountId());
            $request = $this->client->post($uri, [
                'json' => [
                    'senderProfileId' => $this->email->getSenderProfileId(),
                    'receiverEmailAddress' => $this->email->getReceiverEmailAddress(),
                    'subject' => $this->email->getSubject(),
                    'content' => $this->email->getContent(),
                    'startDate' => $this->email->getStartDate(),
                    'finishDate' => $this->email->getFinishDate(),
                ],
                'headers' => [
                    'Authorization' => 'Bearer '.$this->token->getTokenValue()
                ]
            ]);

            if($request->getStatusCode() == 201){
                $response = $request->getBody()->getContents();
                $this->response = (object) [
                    'status' => true,
                    'message' => 'E-Posta gönderimi başarılı',
                    'data' => json_decode($response)
                ];
            } else {
                $this->response = (object) [
                    'status' => false,
                    'message' => 'E-Posta gönderimi başarısız'
                ];
            }

        } catch (RequestException $e){
            $data = json_decode($e->getResponse()->getBody()->getContents());
            $this->response = (object) [
                'status' => false,
                'message' => $data->message
            ];
        }
    }

    /**
     * is success
     *
     * @return bool
     */
    public function success()
    {
        if(isset($this->response->status) && $this->response->status){
            return true;
        }

        return false;
    }

    /**
     * is error
     *
     * @return bool
     */
    public function error()
    {
        return !$this->success();
    }

    /**
     * @return object
     */
    public function getResponse()
    {
        return $this->response;
    }
}
