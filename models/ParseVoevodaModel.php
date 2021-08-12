<?php

namespace app\models;

use Yii;
use yii\base\Model;
use Sunra\PhpSimple\HtmlDomParser;

/**
 * LoginForm is the model behind the login form.
 *
 *
 */
class ParseVoevodaModel extends Model
{

    private $urlPrefix = "https://voevoda24.ru";

/*
    public function getParsingResult($url)
    {
        $resultArray = [];
        $result = file_get_contents($url);
        $html = HtmlDomParser::str_get_html($result);
        $productsLinks = $html->find('.shop-product-item');
        foreach ($productsLinks as $linkElement) {
            $newArray = [];
            $newArray['name'] = $linkElement->find('.product-name a')[0]->innertext;
            $articleElement = $linkElement->find('.product-article')[0];
            $articleElement->find('span')[0]->outertext = "";

            $newArray['article'] = $articleElement->innertext;
            $newArray['price'] = $linkElement->find('.price-current strong')[0]->innertext;
            $resultArray[] = $newArray;
        }
        return $resultArray;
    }
*/

public function getParsingResult($initialUrl)
{
    $resultArray = [];

    $hasNext = true;
    $pageUrl = $initialUrl;

    while ($hasNext) {
        $result = file_get_contents($pageUrl);
        $html = HtmlDomParser::str_get_html($result);
        $productsLinks = $html->find('.shop-product-item');
        foreach ($productsLinks as $linkElement) {
            $newArray = [];
            $newArray['name'] = $linkElement->find('.product-name a')[0]->innertext;
            $articleElement = $linkElement->find('.product-article')[0];
            $articleElement->find('span')[0]->outertext = "";

            $newArray['article'] = $articleElement->innertext;
            $newArray['price'] = $linkElement->find('.price-current strong')[0]->innertext;
            $resultArray[] = $newArray;
        }

        $pageList = $html->find('.shop2-pagelist')[0];
        if ($pageList) {
            $nextLink = $pageList->find('.page-next a')[0];
            if ($nextLink) {
                $pageUrl = $this->urlPrefix . $nextLink->href;
            } else {
                $hasNext = false;
            }
        } else {
            $hasNext = false;
        }
    }

    return $resultArray;
}

}