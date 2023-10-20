<check if="{{ empty($_SESSION['user']) }}">
	<h2 class="pt-5 pb-3">Welcome</h2>
	<p>Please login.</p>
</check>
<check if="{{ !empty($_SESSION['user']['admin']) }}">
	<div class="alert alert-info" role="alert">
		Latest update: {{ @UPDATE_COMMIT_MSG }}
	</div>
	<h2 class="pt-5 pb-3">Welcome admin</h2>
	<p>When you logout, you will return to the user view.</p>
</check>
<check if="{{ !empty($_SESSION['user']['id']) }}">
	<h2 class="pt-5 pb-3">Welcome user</h2>
	<p>When you logout, you will return to the user view.</p>
</check>
