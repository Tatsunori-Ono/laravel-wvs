<?php

namespace App\Services;

class CheckFormService{

    /**
     * 非ウォーリック学生を確認する関数
     *
     * 渡されたデータオブジェクトのnon_warwick_studentプロパティに基づいて、
     * ウォーリック学生か非ウォーリック学生かを確認し、対応するメッセージを返す。
     *
     * @param object $data チェックするデータオブジェクト。non_warwick_studentプロパティを含む必要がある。
     * @return string ウォーリック学生か非ウォーリック学生に対応するメッセージ。
     */
    public static function checkNonWarwickStudent($data) {

        if($data->non_warwick_student === 0){
            $non_warwick_student = __('contact.warwick-student');
        } else {
            $non_warwick_student = __('contact.non-warwick-student');
        }

        return $non_warwick_student;
    }
}