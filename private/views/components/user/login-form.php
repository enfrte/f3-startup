<div class="row justify-content-center mt-5">
	<div class="col-md-6">
		<div class="card">
			<div class="card-header">{{ @loginTypeName }} login</div>
			
			<div class="card-body">
				<check if="{{ !empty($error) }}">
					<p class="error">{{ $error }}</p>
				</check>
				<form hx-post="{{ @BASE }}/{{ @loginType }}" hx-target="body">
					<div class="mb-3">
						<label for="email" class="form-label">Email</label>
						<input type="email" class="form-control" id="email" name="email" autocomplete="on" required>
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" autocomplete="on" required>
					</div>
					<button type="submit" class="btn btn-primary">Login</button>
				</form>
			</div>
			
		</div>
	</div>
</div>
