@extends('layouts.course_html')

@section('content')
	<div class="columns">
    <div class="card column is-10 is-offset-1">
      <h2 id="heading">HTML LESSON 2</h2>
      <p>Tags, lists, and more!</p>
      <div id="msform">
        <!-- progressbar -->
        <ul id="progressbar">
          <li class="active" id="intro"><strong>Start</strong></li>
          <li id="warm-up"><strong>Warmup</strong></li>
          <li id="lesson-video"><strong>Video</strong></li>
          <li id="lesson-exercise"><strong>Excercise</strong></li>
          <li id="lesson-quiz"><strong>Quiz</strong></li>
        </ul>
		<!-- fieldsets -->
        <intro-html-one></intro-html-one>
        <fieldset>
		<hr>
		<strong>Let's get started! Get ready with a pen and piece of paper or open up any text editor. We want you to make a list of anything you want! Think about trips you've made to the grocery store or your letters to Santa. Be sure to make a title and list each with a bullet point!</strong>	
			<hr>
			<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
          <input type="button" name="next" class="next action-button" value="Next" /> 
        </fieldset>
		<lesson-video></lesson-video>
		<html-exercise-2></html-exercise-2>
		<fieldset>
			<quiz></quiz>
			<hr>
			<input type="button" name="previous" class="previous action-button-previous" value="Previous" />
			<a id="exitQuiz" class="button action-button is-hidden" href="/html-lesson3">Next Lesson</a>
		</fieldset>
        <lesson-slides></lesson-slides>
      </div>
    </div>
  </div>
@endsection
<script src="/js/jquery.min.js"></script> 
<!-- ajax request for quiz-->
<script>
	var jsonData = (function() {
	var json = null;
	$.ajax({
			'async': false,
			'global': false,
			'url': "/js/quiz/html-q2.json",
			'dataType': "json",
			'success': function(data) {
				json = data;
			}
		});
		return json;
	})();
</script>
<script>
	var lessonPromptHTML = "<!DOCTYPE html>\n<head>\n<style>\np {\n\tcolor:#03d3fc;\n}\n</style>\n<html>\n\t<body>\n\t<h1>Give it a try!</h1>\n\t\t\tWrap me in a paragraph tag!\n\t</body>\n</html>";
	function checkAnswer(){
		if(htmlEditor.getValue().includes(html2_ans)){
			document.getElementById("lesson-next").classList.remove("is-hidden");
			document.getElementById("res-msg").classList.remove("is-hidden");
			document.getElementById("res-msg").classList.add("is-active");
			document.getElementById("mod-head").classList.remove("fail-header");
			document.getElementById("msg-body").classList.remove("fail-body");
			document.getElementById("mod-head").classList.add("success-header");
			document.getElementById("msg-body").classList.add("success-body");
			document.getElementById("head-msg").innerHTML = "Correct Answer!";
			document.getElementById("msg-body").innerHTML = "Good job!";
			confetti.start(1500, 175, 300);
		}
		else{
			document.getElementById("res-msg").classList.remove("is-hidden");
			document.getElementById("res-msg").classList.add("is-active");
			document.getElementById("mod-head").classList.remove("success-header");
			document.getElementById("msg-body").classList.remove("success-body");
			document.getElementById("mod-head").classList.add("fail-header");
			document.getElementById("msg-body").classList.add("fail-body");
			document.getElementById("head-msg").innerHTML = "Wrong Answer!";
			document.getElementById("msg-body").innerHTML = "Try Again!<br />&bull; Check your spelling and your spacing.<br />&bull; Make sure it is on one line!";
		}
	}
</script>
