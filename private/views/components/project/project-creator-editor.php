<layout>
	<h1 class="mt-5">Create new project</h1>
	<form action="/projects/{{ @project->id ?: '' }}" method="POST">
		{{ @CSRF() }}
		{{ @empty(@project->id) ? @method('POST') : @method('PUT') }}
		<div class="mb-3">
			<input name="title" value="{{ @project->title ?: '' }}" type="text" class="form-control" placeholder="Project title">
		</div>
		<div class="mb-3">
			<textarea class="form-control" name="description" rows="3" placeholder="Description">{{ @project->description ?: '' }}</textarea>
		</div>
		{{ @empty(@project) }}
		<div class="mb-3">
			<div class="row g-2">
				<div class="col-md-6">
					<input 
						type="search" 
						name="language-search"
						data-hx-post="/languageSearch" 
						data-hx-target="#languageSelectContainer"
						data-hx-swap="innerHTML"
						data-hx-trigger="keyup changed delay:500ms, search" 
						class="form-control"
						placeholder="Filter language selection">
				</div>
				<div id="languageSelectContainer" class="col-md-6"></div>
			</div>
		</div>
		{{ @endempty }}
		<button 
			type="submit" 
			class="btn btn-primary">
			{{ @isset(@project) ? 'Update' : 'Create' }} project
		</button>
	</form>
</layout>
