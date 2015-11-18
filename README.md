li_magento

Path "li_magento/app/etc" must be writable.
Path "li_magento/media" must be writable.
Path "li_magento/media/customer" must be writable.
Path "li_magento/media/dhl" must be writable.
Path "li_magento/media/dhl/logo.jpg" must be writable.
Path "li_magento/media/xmlconnect" must be writable.
Path "li_magento/media/xmlconnect/original" must be writable.
Path "li_magento/media/xmlconnect/original/ok.gif" must be writable.
Path "li_magento/media/xmlconnect/system" must be writable.
Path "li_magento/media/xmlconnect/system/ok.gif" must be writable.
Path "li_magento/media/xmlconnect/custom" must be writable.
Path "li_magento/media/xmlconnect/custom/ok.gif" must be writable.
Path "li_magento/media/downloadable" must be writable.


In php.ini, the max_post was set to 100M to enable the uploader of product image.

******************** Unknown cipher in list: TLSv1 ********************

In downloader/lib/Mage/HTTP/Client/Curl.php, try changing:
$this->curlOption(CURLOPT_SSL_CIPHER_LIST, 'TLSv1');
to
$this->curlOption(CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);