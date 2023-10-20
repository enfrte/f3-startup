<include href="/views/header.htm" />

<include href="/views/components/home/home-nav.php" />

<main 
	class="container"
	hx-get="{{ @BASE }}/landing" 
	hx-trigger="load" 
	hx-target="this">
</main>

<include href="/views/footer.htm" />