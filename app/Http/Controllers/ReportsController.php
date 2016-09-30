<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Course;
use Carbon\Carbon;
use App\User;
use Auth;
use Excel;
use Input;
use App\Student;
use Response;

class ReportsController extends Controller
{
    //
     public function index($value='')
    {
    	   $courses = Course::paginate(100);
    	
    	   return view('reports.index' , compact('courses'));
    }

    public function absants($course_id='')
    {
    	# code...

    	$students = Course::findOrFail($course_id)->students()->get();
        $course = Course::findOrFail($course_id);

        
        // Creating the new document...
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        /* Note: any element you append to a document must reside inside of a Section. */

         // Adding an empty Section to the document...
        $section = $phpWord->addSection();

        $header = array('size' => 16, 'bold' => true);


        $fontStyleName = 'Verdana';
        $phpWord->addFontStyle($fontStyleName, array('name' => 'AlHor','bold' => false, 'size' => 16, 'allCaps' => true));


        $fontStyleName2 = 'Verdana';
        $phpWord->addFontStyle($fontStyleName2, array('name' => 'Furat','bold' => false, 'size' => 12, 'allCaps' => true));

        $paragraphStyleName = 'pStyle';
        $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

        
        $section->addText('كشف حضور والانصراف لبرنامج', $fontStyleName, $paragraphStyleName);
        $section->addText( $course->title , $fontStyleName, $paragraphStyleName);
        $section->addText( $course->venue , $fontStyleName, $paragraphStyleName);

        $course_details = ' خلال الفتره من '.$course->start_at.' الى  '.$course->end_at.' المنعقد ب'.$course->venue;
        $section->addText( $course_details ,null, $paragraphStyleName);


      
        // 2. Advanced table

        $section->addTextBreak(1);
        //$section->addText('Fancy table', $header);

        $fancyTableStyleName = 'Fancy Table';
        $fancyTableStyle = array('borderSize' => 2, 'borderColor' => '006699', 'cellMargin' => 8, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
        $fancyTableFirstRowStyle = array('borderBottomSize' => 3, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF' ,'textAlign'=>'center');
        $fancyTableCellStyle = array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER , ''=>'');
        $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_TBRL);
        $fancyTableFontStyle = array('bold' => true,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT);

        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
        $table = $section->addTable($fancyTableStyleName, array('align'=>'right'));
        $table->addRow(900);

        
        
        $table->addCell(1000, $fancyTableCellStyle)->addText('   /     /    ', $fancyTableFontStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('   /     /    ', $fancyTableFontStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('   /     /    ', $fancyTableFontStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('   /     /    ', $fancyTableFontStyle);
        $table->addCell(1000, $fancyTableCellStyle)->addText('   /     /    ', $fancyTableFontStyle);
        $table->addCell(4000, $fancyTableCellStyle)->addText('الاسم', null, $fancyTableFontStyle); 
        $table->addCell(600, $fancyTableCellStyle)->addText('الرقم', $fancyTableFontStyle);


        foreach($students as $student)
        {

            $table->addRow(500);
             

            $table->addCell(1000,$fancyTableCellStyle)->addText("");
            $table->addCell(1000,$fancyTableCellStyle)->addText("");
            $table->addCell(1000,$fancyTableCellStyle)->addText("");
            $table->addCell(1000,$fancyTableCellStyle)->addText("");
            $table->addCell(1000,$fancyTableCellStyle)->addText("");
            $table->addCell(600,$fancyTableCellStyle)->addText($student->name_ar, null, $fancyTableFontStyle);
            $table->addCell(400,$fancyTableCellStyle)->addText($student->id);

        }
        /*for ($i = 1; $i <= 8; $i++) {
            $table->addRow();

            $table->addCell(1000)->addText("{$i}");
            $table->addCell(1000)->addText("{$i}");
            $table->addCell(1000)->addText("{$i}");
            $table->addCell(1000)->addText("{$i}");
            $table->addCell(1000)->addText("{$i}");
            $table->addCell(600)->addText("{$i}");
            $table->addCell(400)->addText("{$i}");

             
        }*/




        // Saving the document as HTML file...
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('absants.docx');
    	
    	
    }

    public function getDownload()
    {
        //PDF file is stored under project/public/download/info.pdf
        $file= public_path(). "/helloWorld.docx";

        $headers = array(
                  'Content-Type: application/docx',
                );

        return Response::download($file, 'helloWorld.docx', $headers);
    }


}
