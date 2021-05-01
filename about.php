<?php require_once("includes/all.php") ?>

<?php logout() ?>


<?php require_once("partials/home/header.php") ?>


<!--
THE ABOUT PAGE 
used to summarize our project for anyone that wants to go on this website.
Includes the Purpose, Requirements, Design, Features, Languages, and Developers
-->

<div class="about-info">
	<h1>About Page</h1>
	<hr>

	<h2 class='center'>Purpose</h2>
	<div class='show-container'>
	<button class='show-more-button'></button>
	<div class='about-info-content'>
		<p>The purpose of our team is to design and create a working web application for Dr. Chao Zhao. This application includes a MySQL database and login authentication using PHP, along with other features Dr. Zhao requests. Each member was assigned specific roles to complete this project. We showcased the skills we learned at Cameron as Computer Science majors.</p>
	</div>
	</div>

	<hr>	
	<h2 class='center'>User Requirements</h2>
	<div class='show-container'>
	<button class='show-more-button'></button>
	<div class='about-info-content'>
		<h3>Student</h3>
		<p></p>
		<ul class="role-privileges">
			<li>Contact advisor for enrollment</li>
			<li>List courses</li>
			<li>Request enrollment PIN</li>
			<li>Enroll classes</li>
			<li>Print schedule</li>
		</ul>
		<h3>Instructor</h3>
		<p></p>
		<ul class="role-privileges">
			<li>List advisees</li>
			<li>List classes</li>
			<li>Find teaching schedule</li>
			<li>Find class rosters</li>
			<li>Print student schedule</li>
			<li>Enroll a student</li>
			<li>Contact students</li>
			<li>Create/Cancel Appointments</li>
		</ul>
		<h3>Secretary</h3>
		<p></p>
		<ul class="role-privileges">
			<li>List CS Students</li>
			<li>List IT Students</li>
			<li>List advisers</li>
			<li>Sign a student to an adviser</li>
			<li>Contact faculty</li>
			<li>Contact student</li>
		</ul>
		<h3>Chair</h3>
		<p></p>
		<ul class="role-privileges">
			<li>List CS Students</li>
			<li>List IT students</li>
			<li>List advisers</li>
			<li>List faculty teaching schedules</li>
			<li>Enroll a student</li>
			<li>Sign a student to an adviser</li>
			<li>Contact faculty</li>
			<li>Contact student</li>
			<li>Find class listing</li>
		</ul>
		<h3>Administrator</h3>
		<p></p>
		<ul class="role-privileges">
			<li>Create and edit users</li>
			<li>Deactivate users</li>
			<li>Create and edit courses</li>
			<li>Create and edit classes</li>
			<li>Create majors</li>
			<li>Contact those who contacted us</li>
		</ul>
	</div>
	</div>

	<hr>
	<h2 class='center'>Design</h2>
	<div class='show-container'>
	<button class='show-more-button'></button>
	<div class='about-info-content'>
		<div class='use-case-buttons'>
		<button class='use-case-button' imgsrc="use-case-student.png">Students</button>
		<button class='use-case-button' imgsrc="use-case-instructor.png">Instructors</button>
		<button class='use-case-button' imgsrc="use-case-secretary.png">Secretary</button>
		<button class='use-case-button' imgsrc="use-case-secretary.png">Chair</button>
		<button class='use-case-button' imgsrc="use-case-admin.png">Admin</button>
		</div>
	</div>
	</div>

	
	<hr>
	<h2 class='center'>Overall Features</h2>
	<div class='show-container'>
	<button class='show-more-button'></button>
	<div class='about-info-content'>
	<?php
		$table = [
			["Add Appointment",			0,0,1,0,0],
			["Add Class",						1,0,0,0,0],
			["Add Course",					1,0,0,0,0],
			["Add Faculty",					1,0,0,0,0],
			["Add Major",						1,0,0,0,0],
			["Add Student",					1,0,0,0,0],
			["Add Student Request",	1,0,0,0,0],
			["Change Advisor",			0,1,0,1,0],
			["Class Roster",				0,1,1,0,0],
			["Contact Advisor",			0,1,0,1,1],
			["Contact Chair",				0,0,1,0,0],
			["Contact Requester",		1,0,0,0,0],
			["Contact Student",			0,1,1,1,0],
			["Delete Class",				1,0,0,0,0],
			["Delete Request",			1,0,0,0,0],
			["Edit Appointment",		0,0,1,0,0],
			["Edit Class",					1,0,0,0,0],
			["Edit Course",					1,0,0,0,0],
			["Edit Faculty",				1,0,0,0,0],
			["Edit Info",						1,1,1,1,1],
			["Edit Student",				1,0,0,0,0],
			["Enroll",							0,1,1,0,1],
			["Enter PIN",						0,0,0,0,1],
			["List Advisees",				0,1,1,1,0],
			["List Advisors",				0,0,1,0,0],
			["List Apply Request",	0,0,1,0,0],
			["List Classes",				1,1,1,0,1],
			["List Contact Us",			1,0,0,0,0],
			["List Courses",				1,0,0,0,0],
			["List Faculty",				1,0,0,0,0],
			["List Major",					1,0,0,0,0],
			["List Students",				1,1,0,1,0],
			["Pick Major",					0,1,0,1,0],
			["Print Instr. Sche.",	0,1,1,1,0],
			["Print Stude. Sche.",	0,1,1,1,1],
			["Teaching Schedule",		0,1,1,1,0],
			["View Appointments",		0,0,1,0,0],
			["View Schedule",				0,1,1,0,1]
		];
	function fill($i){
		if($i === 1){
			return ' fill-cell';
		}
	}
	?>
		<div class="feature-table-div">
			<table>
				<tr class='center'>
					<td></td>
					<td>ADMIN</td>
					<td>CHAIR</td>
					<td>INSTR</td>
					<td>SECRE</td>
					<td>STUDE</td>
				</tr>
				
				<?php foreach($table as $row): ?>
				
				<tr>
					<td><?= $row[0] ?></td>
					<?php for($i=1;$i<6;$i++): ?>
						<td class='cell<?= fill($row[$i]) ?>'></td>
					<?php endfor ?>			
				</tr>
				
				<?php endforeach ?>
			</table>
		</div>
	</div>
	</div>

	<hr>	
	<h2 class='center'>Languages and OS</h2>
	<div class='show-container'>
	<button class='show-more-button'></button>
	<div class='about-info-content'>
		<ul class='role-privileges'>
			<li>HTML/CSS/JavaScript for front end Web forms.</li>
			<li>PHP middleware.</li>
			<li>SQL backend with MySQL database server.</li>
			<li>Linux/Unix.</li>
			<li><a target="_blank" href="https://github.com/cu-capstone-team2/capstone_project/">Github Repository</a></li>
		</ul>
	</div>
	</div>

	
	<hr>
	<h2 class='center'>Developers</h2>
	<div class='show-container'>
	<button class='show-more-button'></button>
<div class="about-info-content persons">
	<div class="person">
		<div class="profile-pic"></div>
		<div class="profile-info">
			<h3>Elias Proctor</h3>
			<h4>Team Leader</h4>
		</div>
	</div>
	<div class="person">
		<div class="profile-pic"></div>
		<div class="profile-info">
			<h3>Robert Alden</h3>	
			<h4>Assistant Lead / Programmer</h4>
		</div>
	</div>
	<div class="person">
		<div class="profile-pic"></div>
		<div class="profile-info">
			<h3>Kayla Snyder</h3>
			<h4>Designer</h4>
		</div>
	</div>
	<div class="person">
		<div class="profile-pic"></div>
		<div class="profile-info">
			<h3>Cynthia Dy</h3>	
			<h4>Designer</h4>
		</div>
	</div>
	<div class="person">
		<div class="profile-pic"></div>
		<div class="profile-info">
			<h3>Ryan Cox</h3>
			<h4>Database / Programmer</h4>
		</div>
	</div>
	<div class="person">
		<div class="profile-pic"></div>
		<div class="profile-info">
			<h3>Kadar Lamsal</h3>	
			<h4>Database / Programmer</h4>
		</div>
	</div>
	<div class="person">
		<div class="profile-pic"></div>
		<div class="profile-info">
			<h3>Ryan Pierce</h3>	
			<h4>Programmer</h4>
		</div>
	</div>
	<div class="person">
		<div class="profile-pic"></div>
		<div class="profile-info">
			<h3>Michael Argyros</h3>	
			<h4>Programmer</h4>
		</div>
	</div>
</div>
</div>
</div>



<?php require_once("partials/home/footer.php") ?>
<div class='backdrop'></div>
<div class='use-case-design'>
	<div class='change-use-case-buttons''>
		<button class='use-case-close-button'>&#10005</button>
		<div class='use-case-change-index-buttons'>
			<button id="left">&lt;</button>
			<button id="right">&gt;</button>
		</div>
	</div>
</div>

<script src='js/about.js'></script>
