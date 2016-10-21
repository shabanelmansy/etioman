<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    //
    protected $table = 'students';

    protected $fillable = [
    'course_id',
    'user_id',
    'student_id',
    'name_en',
    'name_ar',
    'certificate_no',
    'mobile',
    'contact',
    'email',
    'gender',
    'organaization',
    'fee',
    'level',
    'mark',
    'cips_member_id',
    'cips_valed_to',
    'cips_password',
    'cips_u1_exam_date',
    'cips_u1_exam_result',
    'cips_u2_exam_date',
    'cips_u2_exam_result',
    'cips_u3_exam_date',
    'cips_u3_exam_result',
    'cips_u4_exam_date',
    'cips_u4_exam_result',
    'cips_u5_exam_date',
    'cips_u5_exam_result',
    'cips_comments',
    'cm_m1_exam_date',
    'cm_m1_exam_result',
    'cm_m2_exam_date',
    'cm_m2_exam_result',
    'cm_m3_exam_date',
    'cm_m3_exam_result',
    'cm_comments',
    'gafm_exam_date',
    'gafm_result',
    'gafm_comments'
    ];   

    public function course()
    {
        # code...
        $this->belongsTo('App\Course');
    }

     
}
