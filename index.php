<?php

require __DIR__ . '/vendor/autoload.php';

$config = require __DIR__ . '/config.php';

$c = new \Esia\Config($config);
$esia = new \Esia\OpenId($c);

if ($_GET['code']) {
  $esia->getToken($_GET['code']);

  $personInfo = $esia->getPersonInfo();
  $addressInfo = $esia->getAddressInfo();
  $contactInfo = $esia->getContactInfo();

  file_put_contents(__DIR__.'/log/'.date('Y-m-d-H-i-s.log'), json_encode([
    'personalInfo' => $esia->getPersonInfo(),
    'addressInfo' => $esia->getAddressInfo(),
    'contactInfo' => $esia->getContactInfo()
  ]));

}

?>

<?php if (!$_GET['code']) : ?>
  <a href="<?= $esia->buildUrl() ?>">Войти через портал госуслуги</a>
<?php endif; ?>