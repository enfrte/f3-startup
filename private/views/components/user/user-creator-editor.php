
	<div class="row justify-content-center mt-5">
		<div class="col-md-6">
			<div class="card">
				<div class="card-header">{{ @@formType }}</div>
				
				<div class="card-body">
					<form hx-post="{{ @BASE }}/{{ @@user.id ? 'updateUser' : 'saveNewUser' }}" hx-target="body">
						<check if="{{ !empty(@user.id) }}">
							<input type="hidden" name="id" value="{{ @user.id }}">
						</check>
						<div class="mb-3">
							<label for="name" class="form-label">Name</label>
							<input type="text" value="{{ @@user.name }}" class="form-control" id="name" name="name" autocomplete="on" required>
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" value="{{ @@user.email }}" class="form-control" id="email" name="email" autocomplete="on" required>
						</div>
						<div class="mb-3">
							<label for="password" class="form-label">Password</label>
							<input type="password" class="form-control" id="password" name="password" autocomplete="on" required>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
						<check if="{{ !empty(@user.id) }}">
							<button 
								type="button"
								hx-get="{{ @BASE }}/deleteOwnUser/{{ @@user.id }}"
								hx-target="body" 
								class="btn btn-danger">
								Delete
							</button>
						</check>
					</form>
				</div>
			</div>
		</div>
	</div>


