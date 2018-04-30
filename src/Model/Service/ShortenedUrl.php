<?php
namespace LeoGalleguillos\Bitly\Model\Service;

use LeoGalleguillos\Bitly\Model\Table as BitlyTable;

class ShortenedUrl
{
    public function __construct(
        $username,
        $apiKey,
        BitlyTable\Url $urlTable
    ) {
        $this->username   = $username;
        $this->apiKey     = $apiKey;
        $this->urlTable = $urlTable;
    }

    public function getShortenedUrl($url)
    {
        $bitlyArray = $this->urlTable->getArrayFromLongUrl($url);
        if (!empty($bitlyArray['shortened_url'])) {
            $shortenedUrl = $bitlyArray['shortened_url'];
        } else {
            $bitlyUrl     = $this->getBitlyUrl($url);
            $xml          = $this->getXml($bitlyUrl);
            $shortenedUrl = (string) $xml->{'results'}->{'nodeKeyVal'}->{'shortUrl'};
            $this->urlTable->insertIgnore($url, $shortenedUrl);
        }

        return $shortenedUrl;
    }

    private function getBitlyUrl($url)
    {
        return 'http://api.bit.ly/shorten?version=2.0.1'
               . '&login='   . $this->username
               . '&apiKey='  . $this->apiKey
               . '&longUrl=' . urlencode($url)
               . '&format=xml';
    }

    private function getXml($bitlyUrl)
    {
        $xmlString = file_get_contents($bitlyUrl);
        return simplexml_load_string($xmlString);
    }
}
