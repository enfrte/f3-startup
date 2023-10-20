<nav id="mainMenu" class="container">
	<ul class="nav justify-content-end pt-3">

		<li class="nav-item nav-link">
			<a href="{{ @BASE }}">Pendula</a>
		</li>

		<check if="{{ empty($_SESSION['user']['id']) && empty($_SESSION['user']['admin']) }}">
			<li class="nav-item nav-link">
				<a hx-target="main" hx-get="{{ @BASE }}/adminLogin">Admin login</a>
			</li>
			<li class="nav-item nav-link">
				<a hx-target="main" hx-get="{{ @BASE }}/userLogin">Login</a>
			</li>
			<li class="nav-item nav-link">
				<a hx-target="main" hx-get="{{ @BASE }}/registerNewUser">Register</a>
			</li>
		</check>

		<check if="{{ !empty($_SESSION['user']['id']) }}">
			<li class="nav-item nav-link">
				<a hx-target="main" hx-get="{{ @BASE }}/userEdit/{{ @@$_SESSION['user']['id'] }}">Edit user</a>
			</li>
		</check>

		<check if="{{ !empty($_SESSION['user']['admin']) }}">
			<li class="nav-item nav-link">
				<a hx-target="main" hx-get="{{ @BASE }}/userList">Manage users</a>
			</li>
		</check>

		<check if="{{ !empty($_SESSION['user']['id']) || !empty($_SESSION['user']['admin']) }}">
			<li class="nav-item nav-link">
				<a href="{{ @BASE }}/logout">Logout</a>
			</li>
		</check>

	</ul>
</nav>
