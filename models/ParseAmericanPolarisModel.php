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
class ParseAmericanPolarisModel extends Model
{

    public $urlArray = [];
    public $urlPrefix = 'https://rzr.polaris.com';

    function getParsingResult(&$headArray) {
        $resultArray = [];
        foreach ($this->urlArray as $url) {
            $newResultArray = $this->getParsingResultByUrl($url, $headArray);
            //echo 'newResultArray ' . count($newResultArray) . "\n";
            $resultArray = array_merge($resultArray, $newResultArray);
            //echo 'resultArray ' . count($resultArray) . "\n";
        }
        return $resultArray;
    }

    private function getParsingResultByUrl($url, &$headArray) {
        $resultArray = [];
        $result = file_get_contents($url);
        $html = HtmlDomParser::str_get_html($result);
        $htmlOnePage = '';
        $htmlSpecPage = '';
        $i = 1;
        $productsLinks = $html->find('.wholegood-listing-block__wholegood-item a');
        foreach ($productsLinks as $linkElement) {
            $newArray = [];
            $href = $this->urlPrefix . $linkElement->href;
            $name = $linkElement->find(".wholegood-listing-block__wholegood-name")[0]->innertext;
            $newArray['name'] = $name;
            $resultOnePage = file_get_contents($href);
            $htmlOnePage = HtmlDomParser::str_get_html($resultOnePage);
            foreach ($htmlOnePage->find('.wholegood-sub-navigation-menu__link-list a') as $menuLink) {		
                if (trim($menuLink->innertext) == 'Specs') {
                    $resultSpecPage = file_get_contents($this->urlPrefix  . $menuLink->href);
                    $htmlSpecPage = HtmlDomParser::str_get_html($resultSpecPage);
                    foreach ($htmlSpecPage->find('div.specs-full__spec') as $divSpec) {
                        $specName = $divSpec->find('.specs-full__spec-heading')[0]->innertext;
                        $specValue = $divSpec->find('.specs-full__spec-value')[0]->innertext;
                        if (!in_array($specName, $headArray)) {
                            $headArray[] = $specName;
                        }
                        $newArray[$specName] = $specValue;
                    }			
                    $htmlSpecPage->clear();
                    break;
                }
            }
            $i++;
            $htmlOnePage->clear();
            $resultArray[] = $newArray;
        }
        unset($htmlOnePage);
        unset($htmlSpecPage);
        $html->clear();
        unset($html);
        return $resultArray;
    }

}