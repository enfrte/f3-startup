<check if="{{ !empty($_SESSION['user']['admin']) }}">
	<true>
		<div class="alert alert-info" role="alert">
			Latest update: {{ @UPDATE_COMMIT_MSG }}
		</div>
		<h2 class="pt-5 pb-3">Welcome admin</h2>
		<p>When you logout, you will return to the user view.</p>
	</true>
	<false>
		<h2 class="pt-5 pb-3">Welcome user</h2>
		<p>This is the landing page.</p>
	</false>
</check>
