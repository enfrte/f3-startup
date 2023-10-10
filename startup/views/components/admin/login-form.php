<main class="container">
	<div class="container mt-5">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="card">
					<div class="card-header">Admin login</div>
					
					<div class="card-body">
						<form method="POST" action="{{ @BASE }}/login">
							<div class="mb-3">
							<label for="username" class="form-label">Username</label>
							<input type="username" class="form-control" id="username" name="username" autocomplete="on" required>
							</div>
							<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" autocomplete="on" required>
							</div>
							<button 
								type="submit" 
								class="btn btn-primary">
								Login
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

</main>