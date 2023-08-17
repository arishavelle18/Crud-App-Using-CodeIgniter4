<?php

$this->extend("layout/main");
$this->section("body");

?>
<?php if(session()->getFlashdata("success")) :?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
         <?= session()->getFlashdata("success")?>
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif;?>

<h1>Student List</h1>
<a href="/students/create/" class="btn btn-primary">Add Student</a>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Student Name</th>
            <th scope="col">Student Number</th>
            <th scope="col">Student Section</th>
            <th scope="col">Student Course</th>
            <th scope="col">Student Batch</th>
            <th scope="col">Student Grade Level</th>
            <th scope="col">Student Profile</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php $count = 1;?>
        <?php foreach($students as $student) :?>
            <tr>
                <th class="row"><?php echo $count;?></th>
                <td><?php echo $student["student_name"];?></td>
                <td><?php echo $student["student_number"];?></td>
                <td><?php echo $student["student_section"];?></td>
                <td><?php echo $student["student_course"];?></td>
                <td><?php echo $student["student_batch"];?></td>
                <td><?php echo $student["student_grade_level"];?></td>
                <td><img src="/uploads/<?php echo $student['student_profile'];?>" alt="" width="100"></td>
                <td>
                    <a href="/students/edit/<?php echo $student['id'];?>" class="btn btn-primary">Edit</a>
                    <a href="/students/delete/<?php echo $student['id'];?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            <?php $count = $count + 1 ;?>
        <?php endforeach;?>
    </tbody>
</table>

<?php $this->endSection();?>