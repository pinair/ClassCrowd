<?php
/**
 *
 */
if(isset($_SESSION['subject_id'])){
    //Subject name
    $subjectName = Subject::getSubjectById($_SESSION['subject_id']);
}
?>

<h2><?php echo($subjectName); ?>'s Lessons</h2>
<br>
<?php
//echo $_GET['subject_id'/*. " ee "*/];
$lessonsList = Lesson::getLessonsBySubjectId($_GET['subject_id']);

foreach($lessonsList as $lesson){
    //format the date
    $lessonDate = date("d/m/y", strtotime($lesson->getDate()));
    echo '<div class="sidebar-link"><a href="main.php?sidebar=lessons&subject_id='.$lesson->getSubjectId().'&content=doc&lesson_id='.$lesson->getId().'">'. $lessonDate." - ".$lesson->getTitle()."</a></div>";
}
?>
<br><br>

<?php //$_SESSION['class_id'] = $_GET['class_id']; ?>
<a href="main.php?sidebar=subject&class_id=<?php echo $_SESSION['class_id'];?>"><i class="fa fa-arrow-circle-left"></i> Back to Subject</a><br>
<a href="main.php?sidebar=class"><i class="fa fa-arrow-circle-left"></i> Back to Classes</a>
