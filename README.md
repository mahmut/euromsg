# EuroMsgExpress Transactional Email Api

euromsgexpress.com bilgileriniz ile kolayca email gönderebilirsiniz.

## Kurulum
```sh
composer require mahmut/euromsg
```

## Örnek
```php
use EuroMsg\EuroMsgFactory;
use EuroMsg\Email;
use EuroMsg\Account;

// euromsg.com üzerinde hesap e-posta adresiniz
$accountEmail = 'eposta@eposta.com';
// euromsg.com üzerindeki hesap şifreniz
$accountPassword = 'deneme';
// euromsg.com konsol üzerinde kullanmak istediğiniz profil id. Ayarlar > Gönderici Profili > Gönderici Profili Id
$senderProfileId = 1;

$euroMsg = EuroMsgFactory::create(new Account($accountEmail, $accountPassword), './cache/euromsg.json');
$euroMsg->setEmail(new Email($senderProfileId, 'alici@eposta.com', 'E-Posta Konusu', 'E-Posta içeriği html'));

try {   
    $euroMsg->login()->send();
    $response = $euroMsg->getResponse();
    
    if($euroMsg->success()){
        echo "E-Posta gönderimi başarılı";
        print_r($response->data); 
        /*
        array(
            "id" => "000-11-22....", 
            "accountId" => "", 
            "senderProfileId" => 1, 
            "receiverEmailAddress" => "alici@eposta.com", 
            "subject" => "E-Posta Konusu", 
            "content" => "E-Posta içeriği html", 
            "startDate" => "2021-08-01T12:00:00.00Z", 
            "finishDate" => null, 
            "transactionalEmailStatus" => 100 
        );
        */
    } else {
        echo "E-Posta gönderilemedi. Hata: ".$response->message;
    }
} catch (AccountMissingException $e) {
} catch (EmailMissingException $e) {
} catch (TokenMissingException $e) {
}
```
