<?php
/**
 * Created by PhpStorm.
 * User: AMIN
 * Date: 1/24/2018
 * Time: 2:15 PM
 */

namespace WriterBundle\Classes\FactoryWriter;


use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use WriterBundle\Classes\FactoryType\AbstractType;



class CsvWriter extends DataWriter
{

    public function write(AbstractType $data){
        //write data in csv
        return $data;

    }

    public function writeSimple(AbstractType $data){
        //write data in csv
        return json_encode($this->write($data));
    }

    function writeFile(AbstractType $instance)
    {

        $fileName = 'example.csv';

//Set the Content-Type and Content-Disposition headers.
        header('Content-Type: application/excel');
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

//A multi-dimensional array containing our CSV data.
        $data = $this->write($instance);

//Open up a PHP output stream using the function fopen.
        $fp = fopen('php://output', 'w');

//Loop through the array containing our CSV data.
        foreach ($data as $row) {
            //fputcsv formats the array into a CSV format.
            //It then writes the result to our output stream.
            fputcsv($fp, $row);
        }

//Close the file handle.
        fclose($fp);
    }


}