
<h2>User list</h2>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <repeat group="{{ @users }}" value="{{ @user }}">
            <tr>
                <td>{{ @user.name }}</td>
                <td>{{ @user.email }}</td>
                <td>
                    <a 
                        hx-get="{{ @BASE }}/deleteUser/{{ @user.id }}" class="btn btn-danger"
                        hx-target="main"> 
                        Delete
                    </a>
                </td>
            </tr>
        </repeat>
    </tbody>
</table>
