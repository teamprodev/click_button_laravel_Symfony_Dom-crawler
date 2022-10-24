<?php

require "vendor/autoload.php";

use Symfony\Component\DomCrawler\Crawler;

// 1. инициализация
$url = "https://sandbox.bookingcore.org/";
$ch = curl_init();
if (isset($_GET['url'])) {
    $url = $_GET['url'];
}

// 2. указываем параметры, включая url
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/4.0 (compatible; MSIE 6.0; Windows 98)');

// 3. получаем HTML в качестве результата
$subject = curl_exec($ch);

// 4. закрываем соединение
curl_close($ch);

$html = <<<'HTML'
<!DOCTYPE html>
<html>
    <body>
        <p class="message">Hello World!</p>
        <p>Hello Crawler!</p>
    </body>
</html>
HTML;

$crawler = new Crawler($html);

foreach ($crawler as $domElement) {
    echo($domElement->textContent);
}
