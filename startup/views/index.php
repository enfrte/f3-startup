<include href="/views/header.htm" />

<nav id="mainMenu" class="container">
	<check if="{{ !empty($_SESSION['user']['admin']) }}">
		<true>
			<ul class="nav justify-content-end pt-3">
				<li 
					class="nav-item nav-link">
					<a href="{{ @BASE }}/logout">Logout</a>
				</li>
			</ul>
		</true>
		<false>
			<ul class="nav justify-content-end pt-3">
				<li 
					class="nav-item nav-link">
					<a href="{{ @BASE }}/admin">Login</a>
				</li>
			</ul>
		</false>
	</check>
</nav>
<check if="{{ !empty($_SESSION['user']['admin']) }}">
	<true>
		<main 
			class="container"
			hx-get="{{ @BASE }}/landing" 
			hx-trigger="load" 
			hx-target="this">
		</main>
	</true>
	<false>
		<main 
			class="container"
			hx-get="{{ @BASE }}/landing" 
			hx-trigger="load" 
			hx-target="this">
		</main>
	</false>
</check>

<include href="/views/footer.htm" />