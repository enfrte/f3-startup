<layout>
    <repeat group="{{ @projects }}" value="{{ @project }}">
        <div class="card mt-5" id="project_container_{{ @project->id }}">
            <div class="card-body">
                <h5 class="card-title">{{ @project->title }}</h5>
                {{ @if (@project->description) }}
                    <p class="card-text">{{ @project->description }}</p>
                {{ @end }}
            </div>
            <div class="card-body">
                <a href="translate-sentences/{{ @project->id }}" class="card-link text-nowrap">Translate</a>
                <a href="add-sentences/{{ @project->id }}" class="card-link text-nowrap">Add sentences</a>
                <a href="projects/{{ @project->id }}/edit" class="card-link text-nowrap">Edit project</a>
                <button 
                    data-hx-delete="/projects/{{ @project->id }}" 
                    data-hx-target="#project_container_{{ @project->id }}"
                    data-hx-swap="outerHTML"
                    class="card-link text-nowrap btn btn-link">
                    Delete project
                </button>
            </div>
        </div>
    </repeat>
</layout>
