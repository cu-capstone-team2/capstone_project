<?php check_user([CHAIR,INSTRUCTOR,STUDENT]) ?>
<h1>Enrollment</h1>
<hr>
<?php 
	$errors = [];
	if($role === STUDENT){
		if(!isset($_SESSION["PIN"])){
			change_page("user.php?feature=enter_pin");
		}
	}

	$s_id = isset($_GET["student_id"])? $_GET["student_id"] : "";

	if($role === STUDENT){
		$s_id = $user["student_id"];
	}
	
	$student = get_student_by_id($s_id);
	if (!$student) {
		change_page("user.php?feature=list_advisees");
	}

?>

<div class="who">


<h3>Student: <?php echo $student["full_name"]?></h3>
<h3>ID: <?php echo $student["student_id"] ?></h3>

<?php
	$credits = get_credits_by_student($student["student_id"]);

	if (isset($_GET["enroll"])) {
		$enrolled_crn = $_GET["enroll"];
		$class_to_enroll = get_class_by_id($enrolled_crn);

		if ($class_to_enroll) {
	 		$is_already_enrolled = get_enrollment_by_student_class($student["student_id"],$class_to_enroll["class_id"]);
             if($credits + $class_to_enroll["credits"] > 18){
                $errors["enrollment"] = "Too many credits too enroll in this course";
             } else if ($is_already_enrolled != false) {
	 			$errors['enrollment'] = "Already enrolled in this class.";
	 		} else{
                 $classes = get_many_class_student_overlap($s_id, $class_to_enroll["days"], $class_to_enroll["time_id"]);
                 if(!empty($classes)){
                    $errors["overlaps"] = "<BR>Class Overlaps with:<BR>";
                    foreach($classes as $classe){
				        $errors['overlaps'] .= "CRN: {$classe['class_id']}, {$classe['course_name']}, {$classe['time']}, {$classe['days']}, {$classe['room']}<BR>";
			        }
                 }
             }
	 		if(empty($errors)){
	 			insert_enrollment($student["student_id"],$class_to_enroll["class_id"]);
	 			$credits = get_credits_by_student($student["student_id"]);
	 			change_page("user.php?feature=enroll&student_id={$student["student_id"]}");
	 		}
	 	}
	}
	if (isset($_GET["drop"])) {
		delete_enrollment($student["student_id"],$_GET["drop"]);
		change_page("user.php?feature=enroll&student_id={$student["student_id"]}");
	}
?>

<?php $classes = get_classes_by_student($student["student_id"]) ?>

<h2>Credit Hours: <?= $credits ?> </h2>
</div>
<?php if(!isset($student["student_id"])): ?>
    <h3>Schedule of <?= $student["student_firstname"] ?> <?= $student["student_lastname"] ?></h3>
<?php endif ?>

<div class="div-table">

    <table>
        <tr>
            <th>CRN</th>
            <th>Course</th>
            <th>Title</th>
            <th>Time</th>
            <th>Days</th>

        </tr>

        <?php foreach($classes as $class): ?>
            <tr class="row">
                <td><?= $class["class_id"] ?></td>
                <td><?= $class["course_title"] ?></td>
                <td><?= $class["course_name"] ?></td>
                <td><?= $class["time"] ?></td>
                <td><?= $class["days"] ?></td>
            </tr>
            <tr>
            <td colspan="100%">
                <div class="info-shown-div">
                <div class="info-shown-div-info">
                    <p><strong>Instructor: </strong><?= $class["instructor"] ?></p>
                    <p><strong>Location: </strong>Howell Hall</p>
                    <p><strong>Credits: </strong><?= $class["credits"] ?></p>
                    <p><strong># of Students: </strong><?= get_class_count($class["class_id"]) ?></p>
                </div>
                <div class="info-shown-div-links">
                	<a class="feature-url" href="user.php?feature=enroll&student_id=<?=$student["student_id"]?>&drop=<?= $class["class_id"] ?>" onclick="return confirm('Are you sure you would like to drop <?= $class["course_title"] ?>?')">Drop</a>
                </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<?= show_error($errors,"enrollment") ?>
<?= show_error($errors,"overlaps") ?>
<div class="who">
    <h1>Offered Classes</h1>
</div>
<?php 
$offered_classes = get_all_classes($_GET);
$times = get_all_class_time();
$days = ["MW","TR","MTWR","F","SS","MR"];
$input = clean_array($_GET);
$orders = ["course_n"=>"Course#","title"=>"Title","time"=>"Time","days"=>"Days","crn"=>"CRN"];
$majors = get_all_majors();
?>
<!-- Beginning of search form -->

<button class="search-button">Search</button>

<div class="backdrop"></div>

<form method="GET" class="search-form">
    <input type="text" name="feature" value="enroll" hidden />
    <?php if($role !== STUDENT): ?>
        <input type="text" name="student_id" value="<?= $student["student_id"] ?>" hidden />
    <?php endif ?>
    <div>
        <label>CRN: </label>
        <input type="text" name="crn" value="<?= show_value($input,'crn') ?>"/>
    </div>
    <div>
        <label>Instructor: </label>
        <input type="text" name="instructor" value="<?= show_value($input,'instructor') ?>"/>
    </div>
	<div>
		<label>Subject: </label>
		<select name="major">
		<option value="all">All</option>
		<?php foreach($majors as $major): ?>
			<option value="<?= $major["major_id"] ?>" <?= check_select($input,'major',$major["major_id"]) ?>><?= $major["short_name"] ?></option>
		<?php endforeach ?>
		</select>
	</div>
    <div>
        <label>Days: </label>
        <select name="days">
            <option value="all">All</option>
            <?php foreach($days as $day): ?>
                <option value="<?= $day ?>" <?= check_select($input,'days',$day) ?>><?= $day ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div>
        <label>Time: </label>
        <select name="time">
            <option value="all">All</option>
            <?php foreach($times as $time): ?>
                <option value="<?= $time["time_id"] ?>" <?= check_select($input,'time',$time["time_id"]) ?>><?= $time["time"] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div>
        <label>Order By: </label>
        <select name="order">
            <?php foreach($orders as $key=>$value): ?>
                <option value="<?= $key ?>" <?= check_select($input,'order',$key) ?>><?= $value ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <input type="submit" />
</form>

<script src="js/search_form.js"></script>

<!-- End of search form -->


<div class="div-table">
    <table>
        <tr>
            <th>CRN</th>
            <th>Course</th>
            <th>Title</th>
            <th>Time</th>
            <th>Days</th>
        </tr>
        <?php foreach($offered_classes as $class): ?>
            <tr class="row">
                <td><?= $class["class_id"] ?></td>
                <td><?= $class["course_title"] ?></td>
                <td><?= $class["course_name"] ?></td>
                <td><?= $class["time"] ?></td>
                <td><?= $class["days"] ?></td>
            </tr>
            <tr>
            <td colspan="100%">
                <div class="info-shown-div">
	                <div class="info-shown-div-info">
	                    <p><strong>Instructor: </strong><?= $class["instructor"] ?></p>
	                    <p><strong>Location: </strong>Howell Hall</p>
	                    <p><strong>Credits: </strong><?= $class["credits"] ?></p>
	                </div>
	                <div class="info-shown-div-links">
	                    <?php if(($role === CHAIR || $role === STUDENT) && ($credits + $class["credits"] <= 18)): ?>
                            <?php if(get_enrollment_by_student_class($student["student_id"],$class["class_id"])): ?>
                                <p class="error">Already enrolled</p>
                            <?php elseif(get_many_class_student_overlap($s_id, $class["days"], $class["time_id"])): ?>
                                <p class="error">Class overlaps with another</p>
                            <?php else: ?>
    	                        <a class="feature-url" href="user.php?feature=enroll&student_id=<?=$student["student_id"] ?>&enroll=<?= $class["class_id"] ?>">Enroll</a>
                            <?php endif ?>
                        <?php else: ?>
                            <p class="error">Too Many Credits to Enroll, (Max: 18)</p>
	                    <?php endif ?>
	                </div>
                </div>
            </td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<br>
<br>