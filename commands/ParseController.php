<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\ParseAmericanPolarisModel;
use app\models\ParseVoevodaModel;
use app\models\ExcelFileModel;
use Sunra\PhpSimple\HtmlDomParser;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class ParseController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     * @return int Exit code
     */
    public function actionAmerican_rzr()
    {
        define('MAX_FILE_SIZE', 100000000); 
        $headArray = [];
        $headArray[] = 'name'; 

        $parseModel = new ParseAmericanPolarisModel();
        $parseModel->urlArray = ["https://rzr.polaris.com/en-us/trail-sport/",  
        "https://rzr.polaris.com/en-us/multi-terrain/", "https://rzr.polaris.com/en-us/special-editions/", "https://rzr.polaris.com/en-us/4-seater/"];
        //$parseModel->urlArray = ["https://rzr.polaris.com/en-us/trail-sport/", "https://rzr.polaris.com/en-us/side-by-sides/"];
        $resultArray = $parseModel->getParsingResult($headArray);

        $excelFileModel = new ExcelFileModel();
        $excelFileModel->headArray = $headArray;
        $excelFileModel->resultArray = $resultArray;
        $excelFileModel->fileName = 'specifications_5.xls';
        $excelFileModel->saveFile();
        return ExitCode::OK;
    }

    public function actionAmerican_ranger()
    {
        define('MAX_FILE_SIZE', 100000000); 
        $headArray = [];
        $headArray[] = 'name'; 

        $parseModel = new ParseAmericanPolarisModel();
        $parseModel->urlArray = ["https://ranger.polaris.com/en-us/2-seater/", "https://ranger.polaris.com/en-us/full-size/", "https://ranger.polaris.com/en-us/special-editions/", "https://ranger.polaris.com/en-us/crew/"];
        $parseModel->urlPrefix = "https://ranger.polaris.com";
        $resultArray = $parseModel->getParsingResult($headArray);
        $excelFileModel = new ExcelFileModel();
        $excelFileModel->headArray = $headArray;
        $excelFileModel->resultArray = $resultArray;
        $excelFileModel->fileName = 'rangers.xls';
        $excelFileModel->saveFile();
        return ExitCode::OK;
    }

    /**
     * @deprecated
     */
    public function actionAmerican_general_1()
    {
        define('MAX_FILE_SIZE', 100000000); 
        $headArray = [];
        $headArray[] = 'name'; 

        $parseModel = new ParseAmericanPolarisModel();
        $parseModel->urlArray = ["https://general.polaris.com/en-us/2-seater/", "https://general.polaris.com/en-us/4-seater/"];
        $parseModel->urlPrefix = "https://general.polaris.com";
        $resultArray = $parseModel->getParsingResult($headArray);
        $excelFileModel = new ExcelFileModel();
        $excelFileModel->headArray = $headArray;
        $excelFileModel->resultArray = $resultArray;
        $excelFileModel->fileName = 'general.xls';
        $excelFileModel->saveFile();
        return ExitCode::OK;
    }

    public function actionAmerican_general()
    {
        define('MAX_FILE_SIZE', 100000000); 
        $headArray = [];
        $headArray[] = 'name'; 

        $parseModel = new ParseAmericanPolarisModel();
        $parseModel->urlArray = ["https://general.polaris.com/en-us/rec-utility-sxs/"];
        $parseModel->urlPrefix = "https://general.polaris.com";
        $resultArray = $parseModel->getParsingResult($headArray);
        $excelFileModel = new ExcelFileModel();
        $excelFileModel->headArray = $headArray;
        $excelFileModel->resultArray = $resultArray;
        $excelFileModel->fileName = 'general.xls';
        $excelFileModel->saveFile();
        return ExitCode::OK;
    }

    public function actionAmerican_atv()
    {
        define('MAX_FILE_SIZE', 100000000); 
        $headArray = [];
        $headArray[] = 'name'; 

        $parseModel = new ParseAmericanPolarisModel();
        $parseModel->urlArray = ["https://atv.polaris.com/en-us/atvs/"];
        $parseModel->urlPrefix = "https://atv.polaris.com";
        $resultArray = $parseModel->getParsingResult($headArray);
        $excelFileModel = new ExcelFileModel();
        $excelFileModel->headArray = $headArray;
        $excelFileModel->resultArray = $resultArray;
        $excelFileModel->fileName = 'atv.xls';
        $excelFileModel->saveFile();
        return ExitCode::OK;
    }

    public function actionAmerican_snowmobiles()
    {
        define('MAX_FILE_SIZE', 100000000); 
        $headArray = [];
        $headArray[] = 'name'; 

        $parseModel = new ParseAmericanPolarisModel();
        $parseModel->urlArray = ["https://snowmobiles.polaris.com/en-us/sleds/"];
        $parseModel->urlPrefix = "https://snowmobiles.polaris.com";
        $resultArray = $parseModel->getParsingResult($headArray);
        $excelFileModel = new ExcelFileModel();
        $excelFileModel->headArray = $headArray;
        $excelFileModel->resultArray = $resultArray;
        $excelFileModel->fileName = 'snowmobiles.xls';
        $excelFileModel->saveFile();
        return ExitCode::OK;
    }

    public function actionAmerican_rzr_one_page()
    {
        define('MAX_FILE_SIZE', 100000000); 
        $headArray = [];
        $headArray[] = 'name'; 

        $parseModel = new ParseAmericanPolarisModel();
        $parseModel->urlArray = ["https://rzr.polaris.com/en-us/side-by-sides/"];
        $parseModel->urlPrefix = "https://rzr.polaris.com";
        $resultArray = $parseModel->getParsingResult($headArray);
        $excelFileModel = new ExcelFileModel();
        $excelFileModel->headArray = $headArray;
        $excelFileModel->resultArray = $resultArray;
        $excelFileModel->fileName = 'rzr_one_page.xls';
        $excelFileModel->saveFile();
        return ExitCode::OK;
    }

    public function actionAmerican_ranger_one_page()
    {
        define('MAX_FILE_SIZE', 100000000); 
        $headArray = [];
        $headArray[] = 'name'; 

        $parseModel = new ParseAmericanPolarisModel();
        $parseModel->urlArray = ["https://ranger.polaris.com/en-us/utvs/"];
        $parseModel->urlPrefix = "https://ranger.polaris.com";
        $resultArray = $parseModel->getParsingResult($headArray);
        $excelFileModel = new ExcelFileModel();
        $excelFileModel->headArray = $headArray;
        $excelFileModel->resultArray = $resultArray;
        $excelFileModel->fileName = 'ranger_one_page.xls';
        $excelFileModel->saveFile();
        return ExitCode::OK;
    }

    public function actionParse_voevoda() {
        define('MAX_FILE_SIZE', 100000000); 
        $headArray = array('name', 'article', 'price');
        $parseModel = new ParseVoevodaModel();
        $resultArray = $parseModel->getParsingResult("https://voevoda24.ru/shop/snegohody");
        
        $excelFileModel = new ExcelFileModel();
        $excelFileModel->headArray = $headArray;
        $excelFileModel->resultArray = $resultArray;
        $excelFileModel->fileName = 'voevoda_3.xls';
        $excelFileModel->saveFile();
        return ExitCode::OK;
    }

}