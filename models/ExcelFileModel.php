<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * LoginForm is the model behind the login form.
 *
 *
 */
class ExcelFileModel extends Model
{

    public $headArray = [];
    public $resultArray = [];
    public $fileName = 'specifications_2.xls';

    public function saveFile() {
        $sheet = array(
            $this->headArray
        );
        foreach ($this->resultArray as $row) {
            $rowArray = array();
            foreach($this->headArray as $specName) {
                $rowArray[] = $row[$specName];
            }
            $sheet[] = $rowArray;
        }
        $doc = new \PHPExcel();
        $doc->setActiveSheetIndex(0);
        $doc->getActiveSheet()->fromArray($sheet, null, 'A1');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="your_name.xls"');
        header('Cache-Control: max-age=0');
        $writer = \PHPExcel_IOFactory::createWriter($doc, 'Excel5');
        $writer->save($this->fileName);
    }

}