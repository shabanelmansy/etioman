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
use Terbilang;

class ReportsController extends Controller
{
    //
    public function index($value='')
    {
    	   $courses = Course::paginate(100);
    	
    	   return view('reports.index' , compact('courses'));
    }

    public function reportlist($course_id='')
    {
        # code...
        $students = Course::findOrFail($course_id)->students()->get(array('name_en as english_name','name_ar as arabic_name', 'mobile as mobile' , 'email as email'))->toArray();
       
       return Excel::create('student_list', function($excel) use ($students) {

            $excel->sheet('mySheet', function($sheet) use ($students)

            {

                $sheet->fromArray($students);

            });

        })->download('xls');
       



    }

    public function allinfo($course_id='')
    {
        # code...
        
        $course = Course::findOrFail($course_id);
        
        if($course->awarding_body=='local')
        {
            $students = Course::findOrFail($course_id)->students()->get(array('student_id as student_id' ,'name_en as english_name','name_ar as arabic_name', 'certificate_no as certificate_no' , 'mobile as mobile' , 'contact as contact' , 'email as email','organaization as organaization'))->toArray();

        }elseif($course->awarding_body=='cips')
        {
            $students = Course::findOrFail($course_id)->students()->get(array('student_id as student_id' ,'name_en as english_name','name_ar as arabic_name', 'certificate_no as certificate_no' , 'mobile as mobile' , 'contact as contact' , 'email as email','organaization as organaization','cips_member_id as member_id','cips_valed_to as valed_to','cips_password as password','cips_u1_exam_date  as u1_exam_date','cips_u1_exam_result as u1_exam_result','cips_u2_exam_date  as u2_exam_date','cips_u2_exam_result as u2_exam_result','cips_u3_exam_date  as u3_exam_date','cips_u3_exam_result as u3_exam_result','cips_u4_exam_date  as u4_exam_date','cips_u4_exam_result as u4_exam_result','cips_u5_exam_date  as u5_exam_date','cips_u5_exam_result as u5_exam_result'))->toArray();

        }elseif($course->awarding_body=='cm')
        {

            $students = Course::findOrFail($course_id)->students()->get(array('student_id as student_id' ,'name_en as english_name','name_ar as arabic_name', 'certificate_no as certificate_no' , 'mobile as mobile' , 'contact as contact' , 'email as email','organaization as organaization','cm_m1_exam_date  as m1_exam_date','cm_m1_exam_result as m1_exam_result','cm_m2_exam_date  as m2_exam_date','cm_m2_exam_result as m2_exam_result','cm_m3_exam_date  as m3_exam_date','cm_m3_exam_result as m3_exam_result'))->toArray();

        }elseif($course->awarding_body=='gafm')
        {
            $students = Course::findOrFail($course_id)->students()->get(array('student_id as student_id' ,'name_en as english_name','name_ar as arabic_name', 'certificate_no as certificate_no' , 'mobile as mobile' , 'contact as contact' , 'email as email','organaization as organaization','gafm_exam_date  as gafm_exam_date','gafm_result as gafm_result'))->toArray();

        }



       return Excel::create('student_allinfo', function($excel) use ($students) {

            $excel->sheet('mySheet', function($sheet) use ($students)

            {

                $sheet->fromArray($students);

            });

        })->download('xls');
       



    }


    public function invoice($course_id='')
    {
                
               $course = Course::findOrFail($course_id);
 
               if($course->organization=='group')
               { 
                    
                    
                    $fees =  $course->fees;
                    $fees_string = Terbilang::make($fees, ' Rial Omany');

                    // Creating the new document...
                    $phpWord = new \PhpOffice\PhpWord\PhpWord();
                    /* Note: any element you append to a document must reside inside of a Section. */
                    // Adding an empty Section to the document...
                    $section = $phpWord->addSection();

                    $header = array('size' => 16, 'bold' => true);
                    $fontStyleName = 'Verdana';

                    $phpWord->addFontStyle($fontStyleName, array('name' => 'AlHor','bold' => false, 'size' => 16));

                    $fontStyleName2 = 'Verdana';
                    $phpWord->addFontStyle($fontStyleName2, array('name' => 'Furat','bold' => false, 'size' => 12 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::RIGHT));

                    $paragraphStyleName = 'pStyle';
                    $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

                    $paragraphStyleName2 = 'pStyle';
                    $phpWord->addParagraphStyle($paragraphStyleName2, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 100));

                    $section->addText('', array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 100));

                    $invoice_no = date('y').$course->id.str_pad(1, 3 , '0', STR_PAD_LEFT).'  : (Invoice No) الرقم';

                    $section->addText($invoice_no, array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 100));

                    
                    $invoice_date = date('Y/m/d').'  : (Date ) التاريخ ';

                    $section->addText($invoice_date, array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 100));  
                    
                    $section->addText('Invoice - فاتورة ', $fontStyleName, $paragraphStyleName);

                    $company_name =" الأفاضل / "." ".$course->org_name;

                    $section->addText($company_name, array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 100));

                    ////////////////////////////////////
                   
                    $fancyTableStyleName = 'Fancy Table';
                    $fancyTableStyle = array('borderSize' => 2, 'borderColor' => '006699', 'cellMargin' => 8, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
                    $fancyTableFirstRowStyle = array('borderBottomSize' => 3, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF' ,'textAlign'=>'center');
                    $fancyTableCellStyle = array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER , ''=>'');
                    $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_TBRL);
                    $fancyTableFontStyle = array('bold' => true,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT);

                    $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
                    $table = $section->addTable($fancyTableStyleName, array('align'=>'right'));
                    $table->addRow(500);

                    
                    $table->addCell(6000, $fancyTableCellStyle)->addText('Subject                  البيان',array('name' => 'AlHor','bold' => true, 'size' => 10), $paragraphStyleName); 
                    $table->addCell(3650, $fancyTableCellStyle)->addText('Amount(RO)                     المبلغ (ر.ع)  ', array('name' => 'AlHor','bold' => true, 'size' => 10) , $fancyTableFontStyle);



                    $table->addRow(500);

                    $table->addCell(6000,$fancyTableCellStyle)->addText($course->title , array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER ,'bold' => true ), $paragraphStyleName);

                    $table->addCell(3650, $fancyTableCellStyle)->addText(number_format((float)$course->fees, 3 , '.', ''),array('name' => 'AlHor','bold' => true, 'size' => 10), $paragraphStyleName);


                    $table->addRow(300);
                    
                    $from_to = 'From '.$course->start_at." to ".$course->end_at;

                    $table->addCell(6000,$fancyTableCellStyle)->addText($from_to, array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER ), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

                    $table->addCell(3650, $fancyTableCellStyle)->addText('', array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER ) , $fancyTableFontStyle);


                     $table->addRow(500);

                    $table->addCell(6000,$fancyTableCellStyle)->addText($fees_string, array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER ,'bold' => true ), $paragraphStyleName);

                    $table->addCell(3650, $fancyTableCellStyle)->addText(number_format((float)$course->fees, 3 , '.', '') ,array('name' => 'AlHor','bold' => true, 'size' => 10), $paragraphStyleName);

                    $section->addTextBreak(2);

                    //////////////////////////////////////////////////////////////////////////////////////////////

                    $fancyTableStyleName = 'Colspan Rowspan';
                    $fancyTableStyle = array('borderSize' => 2, 'borderColor' => '006699', 'cellMargin' => 8, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
                    $fancyTableFirstRowStyle = array('borderBottomSize' => 3, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF' ,'textAlign'=>'center');
                    
                    $fancyTableCellStyle = array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER , ''=>'');
                    $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_TBRL);
                    $fancyTableFontStyle = array('bold' => true,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT);

                    $phpWord->addTableStyle(null, null,null);
                    $table = $section->addTable($fancyTableStyleName, array('align'=>'right'));
                    
                    $table->addRow(500);

                    $table->addCell(4825, $fancyTableCellStyle)->addText('Account Name: Excellent Efficiency Trading',array('name' => 'AlHor','bold' => true, 'size' => 10), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100)); 

                    $table->addCell(4825, $fancyTableCellStyle)->addText('اسم الحساب : الكفاءة المميزة للتجارة ', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , $fancyTableFontStyle);


                    $table->addRow(500);

                    $table->addCell(4825, $fancyTableCellStyle)->addText('Bank Name : Dofar Bank - Main Branch',array('name' => 'AlHor','bold' => true, 'size' => 10),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100)); 

                    $table->addCell(4825, $fancyTableCellStyle)->addText('البنك والفرع : بنك ظفار - الفرع الرئيسي ', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , $fancyTableFontStyle); 

                    /////////////////////////////////////////////////////////////////////////////////////////////

                    $fancyTableStyleName = 'Colspan Rowspan';
                    $fancyTableStyle = array('borderSize' => 2, 'borderColor' => '006699', 'cellMargin' => 8, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
                    $fancyTableFirstRowStyle = array('borderBottomSize' => 3, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF' ,'textAlign'=>'center');
                    
                    $fancyTableCellStyle = array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER , ''=>'');
                    $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_TBRL);
                    $fancyTableFontStyle = array('bold' => true,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT);

                    $phpWord->addTableStyle(null, null,null);
                    $table = $section->addTable($fancyTableStyleName, array('align'=>'right'));
                    
                    $table->addRow(500);

                    $table->addCell(3216, $fancyTableCellStyle)->addText('Account NO : ',array('name' => 'AlHor','bold' => true, 'size' => 10, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100)); 

                    $table->addCell(3216, $fancyTableCellStyle)->addText('0104-060 2322-001', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

                    $table->addCell(3216, $fancyTableCellStyle)->addText(': رقم الحساب ', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , $fancyTableFontStyle);

                    ////////////////////////

                    $table->addRow(500);

                    $table->addCell(3216, $fancyTableCellStyle)->addText('Swift Code : ',array('name' => 'AlHor','bold' => true, 'size' => 10, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100)); 

                    $table->addCell(3216, $fancyTableCellStyle)->addText('BDOFOMRUXXX', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

                    $table->addCell(3216, $fancyTableCellStyle)->addText(': سوفت كود ', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , $fancyTableFontStyle);

                    ///////////////////////

                    $table->addRow(500);

                    $table->addCell(3216, $fancyTableCellStyle)->addText('Beneficiary No : ',array('name' => 'AlHor','bold' => true, 'size' => 10, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100)); 

                    $table->addCell(3216, $fancyTableCellStyle)->addText('11154401', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

                    $table->addCell(3216, $fancyTableCellStyle)->addText(': رقم المستفيد ', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , $fancyTableFontStyle);

                    
                    /////////////////////////////////////////////////////////////////////////////////////////////
                    $section->addTextBreak(10);
                    $section->addText('        Signature and Stamp', array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::LEFT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100));  

                    $section->addText('            الختم والتوقيع', array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::LEFT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100));  
                  
                }else
                {

                    $students = Course::findOrFail($course_id)->students()->get();

                    // Creating the new document...
                    $phpWord = new \PhpOffice\PhpWord\PhpWord();

                    foreach($students as $student)
                    {
                        $fees =  $course->fees;
                        $fees_string = Terbilang::make($student->fee, ' Rial Omany');
                        
                        
                        /* Note: any element you append to a document must reside inside of a Section. */
                        // Adding an empty Section to the document...
                        $section = $phpWord->addSection();

                        $header = array('size' => 16, 'bold' => true);
                        $fontStyleName = 'Verdana';

                        $phpWord->addFontStyle($fontStyleName, array('name' => 'AlHor','bold' => false, 'size' => 16));

                        $fontStyleName2 = 'Verdana';
                        $phpWord->addFontStyle($fontStyleName2, array('name' => 'Furat','bold' => false, 'size' => 12 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::RIGHT));

                        $paragraphStyleName = 'pStyle';
                        $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

                        $paragraphStyleName2 = 'pStyle';
                        $phpWord->addParagraphStyle($paragraphStyleName2, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 100));

                        $section->addText('', array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 100));

                        $invoice_no = date('y').$course->id.str_pad($student->id, 3 , '0', STR_PAD_LEFT).'  : (Invoice No) الرقم';

                        $section->addText($invoice_no, array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 100));

                        
                        $invoice_date = date('Y/m/d').'  : (Date ) التاريخ ';

                        $section->addText($invoice_date, array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 100));  
                        
                        $section->addText('Invoice - فاتورة ', $fontStyleName, $paragraphStyleName);

                        $company_name =" الأفاضل / "." ".$student->name_ar;

                        $section->addText($company_name, array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 100));

                        ////////////////////////////////////
                       
                        $fancyTableStyleName = 'Fancy Table';
                        $fancyTableStyle = array('borderSize' => 2, 'borderColor' => '006699', 'cellMargin' => 8, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
                        $fancyTableFirstRowStyle = array('borderBottomSize' => 3, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF' ,'textAlign'=>'center');
                        $fancyTableCellStyle = array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER , ''=>'');
                        $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_TBRL);
                        $fancyTableFontStyle = array('bold' => true,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT);

                        $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
                        $table = $section->addTable($fancyTableStyleName, array('align'=>'right'));
                        $table->addRow(500);

                        
                        $table->addCell(6000, $fancyTableCellStyle)->addText('Subject                  البيان',array('name' => 'AlHor','bold' => true, 'size' => 10), $paragraphStyleName); 
                        $table->addCell(3650, $fancyTableCellStyle)->addText('Amount(RO)                     المبلغ (ر.ع)  ', array('name' => 'AlHor','bold' => true, 'size' => 10) , $fancyTableFontStyle);



                        $table->addRow(500);

                        $table->addCell(6000,$fancyTableCellStyle)->addText($course->title , array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER ,'bold' => true ), $paragraphStyleName);

                        $table->addCell(3650, $fancyTableCellStyle)->addText(number_format((float)$student->fee, 3 , '.', ''),array('name' => 'AlHor','bold' => true, 'size' => 10), $paragraphStyleName);


                        $table->addRow(300);
                        
                        $from_to = 'From '.$course->start_at." to ".$course->end_at;

                        $table->addCell(6000,$fancyTableCellStyle)->addText($from_to, array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER ), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER));

                        $table->addCell(3650, $fancyTableCellStyle)->addText('', array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER ) , $fancyTableFontStyle);


                         $table->addRow(500);

                        $table->addCell(6000,$fancyTableCellStyle)->addText($fees_string, array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER ,'bold' => true ), $paragraphStyleName);

                        $table->addCell(3650, $fancyTableCellStyle)->addText(number_format((float)$student->fee, 3 , '.', '') ,array('name' => 'AlHor','bold' => true, 'size' => 10), $paragraphStyleName);

                        $section->addTextBreak(2);

                        //////////////////////////////////////////////////////////////////////////////////////////////

                        $fancyTableStyleName = 'Colspan Rowspan';
                        $fancyTableStyle = array('borderSize' => 2, 'borderColor' => '006699', 'cellMargin' => 8, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
                        $fancyTableFirstRowStyle = array('borderBottomSize' => 3, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF' ,'textAlign'=>'center');
                        
                        $fancyTableCellStyle = array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER , ''=>'');
                        $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_TBRL);
                        $fancyTableFontStyle = array('bold' => true,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT);

                        $phpWord->addTableStyle(null, null,null);
                        $table = $section->addTable($fancyTableStyleName, array('align'=>'right'));
                        
                        $table->addRow(500);

                        $table->addCell(4825, $fancyTableCellStyle)->addText('Account Name: Excellent Efficiency Trading',array('name' => 'AlHor','bold' => true, 'size' => 10), array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100)); 

                        $table->addCell(4825, $fancyTableCellStyle)->addText('اسم الحساب : الكفاءة المميزة للتجارة ', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , $fancyTableFontStyle);


                        $table->addRow(500);

                        $table->addCell(4825, $fancyTableCellStyle)->addText('Bank Name : Dofar Bank - Main Branch',array('name' => 'AlHor','bold' => true, 'size' => 10),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100)); 

                        $table->addCell(4825, $fancyTableCellStyle)->addText('البنك والفرع : بنك ظفار - الفرع الرئيسي ', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , $fancyTableFontStyle); 

                        /////////////////////////////////////////////////////////////////////////////////////////////

                        $fancyTableStyleName = 'Colspan Rowspan';
                        $fancyTableStyle = array('borderSize' => 2, 'borderColor' => '006699', 'cellMargin' => 8, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
                        $fancyTableFirstRowStyle = array('borderBottomSize' => 3, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF' ,'textAlign'=>'center');
                        
                        $fancyTableCellStyle = array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER , ''=>'');
                        $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_TBRL);
                        $fancyTableFontStyle = array('bold' => true,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT);

                        $phpWord->addTableStyle(null, null,null);
                        $table = $section->addTable($fancyTableStyleName, array('align'=>'right'));
                        
                        $table->addRow(500);

                        $table->addCell(3216, $fancyTableCellStyle)->addText('Account NO : ',array('name' => 'AlHor','bold' => true, 'size' => 10, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100)); 

                        $table->addCell(3216, $fancyTableCellStyle)->addText('0104-060 2322-001', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

                        $table->addCell(3216, $fancyTableCellStyle)->addText(': رقم الحساب ', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , $fancyTableFontStyle);

                        ////////////////////////

                        $table->addRow(500);

                        $table->addCell(3216, $fancyTableCellStyle)->addText('Swift Code : ',array('name' => 'AlHor','bold' => true, 'size' => 10, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100)); 

                        $table->addCell(3216, $fancyTableCellStyle)->addText('BDOFOMRUXXX', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

                        $table->addCell(3216, $fancyTableCellStyle)->addText(': سوفت كود ', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , $fancyTableFontStyle);

                        ///////////////////////

                        $table->addRow(500);

                        $table->addCell(3216, $fancyTableCellStyle)->addText('Beneficiary No : ',array('name' => 'AlHor','bold' => true, 'size' => 10, 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100)); 

                        $table->addCell(3216, $fancyTableCellStyle)->addText('11154401', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

                        $table->addCell(3216, $fancyTableCellStyle)->addText(': رقم المستفيد ', array('name' => 'AlHor','bold' => true, 'size' => 13 , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT) , $fancyTableFontStyle);

                        
                        /////////////////////////////////////////////////////////////////////////////////////////////
                        $section->addTextBreak(10);
                        $section->addText('        Signature and Stamp', array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::LEFT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100));  

                        $section->addText('            الختم والتوقيع', array('name' => 'Furat','bold' => false, 'size' => 16 ,'alignment' =>\PhpOffice\PhpWord\SimpleType\Jc::LEFT) , array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT, 'spaceAfter' => 100));
                    }

                }

                // Saving the document as HTML file...
                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                $objWriter->save('invoice.docx');

                $file= public_path(). "/invoice.docx";
                $headers = array(
                          'Content-Type: application/docx',
                        );

                return Response::download($file, 'invoice.docx', $headers);


    }

    public function certificate($course_id=0)
    {
        # code...
        $students = Course::findOrFail($course_id)->students()->get();
        $course = Course::findOrFail($course_id);


        if($course->lanquage =="ar"){   
                // Creating the new document...
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                /* Note: any element you append to a document must reside inside of a Section. */
                // Adding an empty Section to the document...

                foreach($students as $student)
                {


                    $section = $phpWord->addSection(array('orientation' => 'landscape'));

                    $header = array('size' => 16, 'bold' => true);


                    $fontStyleName = 'Verdana';
                    $phpWord->addFontStyle($fontStyleName, array('name' => 'AlHor','bold' => false, 'size' => 25, 'allCaps' => true));


                    $fontStyleName2 = 'Verdana';
                    $phpWord->addFontStyle($fontStyleName2, array('name' => 'Furat','bold' => false, 'size' => 25, 'allCaps' => true ,'color' => '996699'));

                    $paragraphStyleName = 'pStyle';
                    $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 10));

                    
                    //$section->addTextBreak(1);
                    
                    
                    $section->addText('نشهد بأن', $fontStyleName, $paragraphStyleName);
                    

                    
                    $section->addText( $student->name_ar,array('name' => 'Furat','bold' => false, 'size' => 25, 'allCaps' => true ,'color' => 'a9600c'), $paragraphStyleName);
                     
                    if($student->gender=='male')
                        $gender=' أتم ';
                    else
                        $gender=' أتمت ';

                    $course_name = 'قد'.$gender.'بنجاح متطلبات دورة';
                    $section->addText($course_name , $fontStyleName, $paragraphStyleName);
                     
                    $section->addText( $course->title ,array('name' => 'Furat','bold' => false, 'size' => 25, 'allCaps' => true ,'color' => 'a9600c'), $paragraphStyleName);

                    $venue = 'المنعقدة ب'.$course->venue.' خلال الفترة من '.$course->start_at.' الى '.$course->end_at;

                    $section->addText( $venue ,$fontStyleName, $paragraphStyleName);
                     
                    $organization = ' بالتعاون مع '.$course->org_name;

                    $section->addText( $organization ,$fontStyleName, $paragraphStyleName);
                    
                    $certificate_no = 'شهاده رقم'.date('y').$course->id.$student->id.' صادرة في '.date('Y-m-d');

                    $section->addText( $certificate_no ,$fontStyleName, $paragraphStyleName);


                    $section->addTextBreak(1);
                    $section->addTextBreak(1);

                    $section->addText( $course->instructor.' الخزانى                                                                                               أمجد رجا قسايمه',array('name' => 'Furat','bold' => false, 'size' => 18, 'allCaps' => true),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 10));

                    $section->addText( '          مدرب البرنامج                                                                                                       المدير العام',array('name' => 'Furat','bold' => false, 'size' => 18, 'allCaps' => true),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 10));

                    
                }

                // Saving the document as HTML file...
                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                $objWriter->save('certificate_ar.docx');

                $file= public_path(). "/certificate_ar.docx";
                $headers = array(
                          'Content-Type: application/docx',
                        );

                return Response::download($file, 'certificate_ar.docx', $headers);


                

        }else {
                 // Creating the new document...
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                /* Note: any element you append to a document must reside inside of a Section. */
                // Adding an empty Section to the document...
                
                foreach($students as $student)
                {
                    $section = $phpWord->addSection(array('orientation' => 'landscape'));

                    $header = array('size' => 16, 'bold' => true);


                    $fontStyleName = 'Verdana';
                    $phpWord->addFontStyle($fontStyleName, array('name' => 'AlHor','bold' => false, 'size' => 25, 'allCaps' => false));


                    $fontStyleName2 = 'Verdana';
                    $phpWord->addFontStyle($fontStyleName2, array('name' => 'Furat','bold' => false, 'size' => 25, 'allCaps' => false ,'color' => '996699'));

                    $paragraphStyleName = 'pStyle';
                    $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 10));

                    
                    //$section->addTextBreak(1);
                    
                    
                    $section->addText('Certificate', $fontStyleName, $paragraphStyleName);
                    

                    $section->addText( ' This is to certify that ',array('name' => 'Furat','bold' => false, 'size' => 25, 'allCaps' => true ,'color' => 'a9600c'), $paragraphStyleName);
                     
                    $section->addText($student->name_en , $fontStyleName, $paragraphStyleName);
                     
                    $section->addText( ' Has successfully completed a training course in ',array('name' => 'Furat','bold' => false, 'size' => 25, 'allCaps' => true ,'color' => 'a9600c'), $paragraphStyleName);

                    $section->addText( $course->title ,$fontStyleName, $paragraphStyleName);
                     
                    $org_name = 'Held at '.$course->org_name.' from '.$course->start_at.' to '.$course->end_at ; 

                    $section->addText( $org_name ,$fontStyleName, $paragraphStyleName);
                    
                    $certificate_no = 'Certificate No '.date('y').$course->id.$student->id.' , issue date '.date('Y-m-d');

                    $section->addText( $certificate_no ,$fontStyleName, $paragraphStyleName);


                    $section->addTextBreak(1);
                     

                    $section->addText( $course->instructor.'                                                                   Amjad Qasaimeh',array('name' => 'Furat','bold' => false, 'size' => 18, 'allCaps' => true),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 10));

                    $section->addText( '  The Trainer                                                                          General Manager',array('name' => 'Furat','bold' => false, 'size' => 18, 'allCaps' => true),array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::RIGHT, 'spaceAfter' => 10));

                    
                }

                // Saving the document as HTML file...
                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                $objWriter->save('certificate_ar.docx');

                $file= public_path(). "/certificate_ar.docx";
                $headers = array(
                          'Content-Type: application/docx',
                        );

                return Response::download($file, 'certificate_ar.docx', $headers);


        }
    }

    public function absants($course_id='')
    {
    	
    	$students = Course::findOrFail($course_id)->students()->get();
        $course = Course::findOrFail($course_id);

        if($course->lanquage =="ar"){   
                // Creating the new document...
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                /* Note: any element you append to a document must reside inside of a Section. */
                // Adding an empty Section to the document...
                $section = $phpWord->addSection();

                $header = array('size' => 16, 'bold' => true);


                $fontStyleName = 'Verdana';
                $phpWord->addFontStyle($fontStyleName, array('name' => 'Andalus','bold' => false, 'size' => 16, 'allCaps' => true, 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR));


                $fontStyleName2 = 'Verdana';
                $phpWord->addFontStyle($fontStyleName2, array('name' => 'Andalus','bold' => false, 'size' => 12, 'allCaps' => true));

                $paragraphStyleName = 'pStyle';
                $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100,'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_BTLR));

                
                $section->addText('كشف حضور والانصراف لبرنامج', $fontStyleName, $paragraphStyleName);
                $section->addText( $course->title , $fontStyleName, $paragraphStyleName);
                $section->addText( $course->instructor , $fontStyleName, $paragraphStyleName);

                $course_details = ' خلال الفتره من '.$course->start_at.' الى  '.$course->end_at.' المنعقد ب'.$course->venue;
                $section->addText( $course_details ,null, $paragraphStyleName);


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
                
                // Saving the document as HTML file...
                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                $objWriter->save('absants_ar.docx');

                $file= public_path(). "/absants_ar.docx";
                $headers = array(
                          'Content-Type: application/docx',
                        );

                return Response::download($file, 'absants_ar.docx', $headers);


                

        }else {
                # code...
                // Creating the new document...
                $phpWord = new \PhpOffice\PhpWord\PhpWord();
                /* Note: any element you append to a document must reside inside of a Section. */
                // Adding an empty Section to the document...
                $section = $phpWord->addSection();

                $header = array('size' => 16, 'bold' => true);


                $fontStyleName = 'Times New Roman (Headings CS)';
                $phpWord->addFontStyle($fontStyleName, array('name' => 'Times New Roman (Headings CS)','bold' => false, 'size' => 16));


                $fontStyleName3 = 'Times New Roman (Headings CS) bold';
                $phpWord->addFontStyle($fontStyleName3, array('name' => 'Times New Roman (Headings CS)','bold' => true, 'size' => 18));


                $fontStyleName2 = 'Times New Roman (Headings CS)';
                $phpWord->addFontStyle($fontStyleName2, array('name' => 'Furat','bold' => false, 'size' => 12, 'allCaps' => true));

                $paragraphStyleName = 'pStyle';
                $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 50));

                
                $section->addText('Attendance', $fontStyleName3, $paragraphStyleName);
                $section->addText('', $fontStyleName3, $paragraphStyleName);
                $section->addText( $course->title , $fontStyleName, $paragraphStyleName);
                $section->addText('', $fontStyleName3, $paragraphStyleName);
                $section->addText( $course->instructor , $fontStyleName, $paragraphStyleName);

                $course_details = ' From : '.$course->start_at.' To :  '.$course->end_at.' In : '.$course->venue;
                $section->addText( $course_details ,null, $paragraphStyleName);


                $section->addTextBreak(1);
                //$section->addText('Fancy table', $header);

                $fancyTableStyleName = 'Fancy Table';
                $fancyTableStyle = array('borderSize' => 2, 'borderColor' => '006699', 'cellMargin' => 8, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER);
                $fancyTableFirstRowStyle = array('borderBottomSize' => 3, 'borderBottomColor' => '0000FF', 'bgColor' => '66BBFF' ,'textAlign'=>'center');
                $fancyTableCellStyle = array('valign' => 'center' , 'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER , ''=>'');
                $fancyTableCellBtlrStyle = array('valign' => 'center', 'textDirection' => \PhpOffice\PhpWord\Style\Cell::TEXT_DIR_TBRL);
                $fancyTableFontStyle = array('bold' => true,'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT);

                $phpWord->addTableStyle($fancyTableStyleName, $fancyTableStyle, $fancyTableFirstRowStyle);
                $table = $section->addTable($fancyTableStyleName, array('align'=>'right'));
                $table->addRow(900);

                
                $table->addCell(600, $fancyTableCellStyle)->addText('#', $fancyTableFontStyle);
                $table->addCell(4000, $fancyTableCellStyle)->addText('Name', null, $fancyTableFontStyle); 
                $table->addCell(1000, $fancyTableCellStyle)->addText('   /     /    ', $fancyTableFontStyle);
                $table->addCell(1000, $fancyTableCellStyle)->addText('   /     /    ', $fancyTableFontStyle);
                $table->addCell(1000, $fancyTableCellStyle)->addText('   /     /    ', $fancyTableFontStyle);
                $table->addCell(1000, $fancyTableCellStyle)->addText('   /     /    ', $fancyTableFontStyle);
                $table->addCell(1000, $fancyTableCellStyle)->addText('   /     /    ', $fancyTableFontStyle);
               
                


                foreach($students as $student)
                {

                    $table->addRow(500);
                     

                    $table->addCell(400,$fancyTableCellStyle)->addText($student->id);
                    $table->addCell(600,$fancyTableCellStyle)->addText($student->name_en, null, $fancyTableFontStyle);
                    $table->addCell(1000,$fancyTableCellStyle)->addText("");
                    $table->addCell(1000,$fancyTableCellStyle)->addText("");
                    $table->addCell(1000,$fancyTableCellStyle)->addText("");
                    $table->addCell(1000,$fancyTableCellStyle)->addText("");
                    $table->addCell(1000,$fancyTableCellStyle)->addText("");
                    
                    

                }
                
                // Saving the document as HTML file...
                $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
                $objWriter->save('absants_en.docx');

                $file= public_path(). "/absants_en.docx";
                $headers = array(
                          'Content-Type: application/docx',
                        );

                return Response::download($file, 'absants_en.docx', $headers);

        }    	
    	
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
