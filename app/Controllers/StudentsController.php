<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentsModel;

class StudentsController extends BaseController
{
    public function __construct(){
        $this->students = new \App\Models\StudentsModel();
        $this->db = db_connect();
    }

     // for listing
     public function index()
     {
        //  fetch student
        $data["students"] = $this->students->findAll();
         return view("students/list",$data);
     }
 
     // add the student 
     public function createStudent()
     {
         $data["studentNumber"] = "20000_".uniqid();
         return view("students/add",$data);
     }
 
     public function storeStudent()
     {

        if($img = $this->request->getFile("studentProfile")){
            if($img->isValid() && !$img->hasMoved()){
                $imageName = $img->getRandomName();
                $img->move("uploads/",$imageName);
            }
        }
        // echo $this->request->getPost("studentNum");
        // exit;
        $data = array(
            "student_name" => $this->request->getPost("studentName"),
            "student_section" => $this->request->getPost("studentSection"),
            "student_course" => $this->request->getPost("studentCourse"),
            "student_batch" => $this->request->getPost("studentBatch"),
            "student_grade_level" => $this->request->getPost("studentLevel"),
            "student_profile" => $imageName,
            "student_number" => $this->request->getPost("studentNum")
        );
        // insert the data

        $this->students->insert($data);
        return redirect()->to("/students")->with("success","Student Added Successfully");

         // store in the student

     }
     // edit student
     public function editStudent($id)
     {
        // get the data in the model
        // select all where id = $id and get the first data only
        $data["student"] = $this->students->where("id",$id)->first();
        return view("students/edit",$data);
     }
 
     public function updateStudent($id)
     {
         // update student
         if($img = $this->request->getFile("studentProfile")){
            if($img->isValid() && !$img->hasMoved()){
                $imageName = $img->getRandomName();
                $img->move("uploads/",$imageName);
            }
        }
        if(!empty($_FILES["studentProfile"]["name"])){
            $this->db->query("UPDATE tbl_students SET student_profile = '$imageName' WHERE id = '$id'");
        }

        $data = array(
            "student_name" => $this->request->getPost("studentName"),
            "student_section" => $this->request->getPost("studentSection"),
            "student_course" => $this->request->getPost("studentCourse"),
            "student_batch" => $this->request->getPost("studentBatch"),
            "student_grade_level" => $this->request->getPost("studentLevel"),
            "student_number" => $this->request->getPost("studentNum")
        );

        // update it
        $this->students->update($id,$data);
        return redirect()->to("/students")->with("success","Student Updated Successfully");
     }
 
     public function deleteStudent($id)
     {
         // delete student
         $this->students->delete($id);
         return redirect()->to("/students")->with("success","Student Deleted Successfully");
     }
}
