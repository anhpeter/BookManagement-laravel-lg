@php
$formAction = route('users.store');
$formMethod = 'POST';
if ($formType === 'edit') {
    $formAction = route('users.update', ['user' => $item->id]);
    $formMethod = 'PUT';
}
@endphp
<form action="{{ $formAction }}" method="post">
    {{ csrf_field() }}
    {{ method_field($formMethod) }}
    <div class="form-group row">
        <label class="col-lg-2 col-form-label" for="username">Username</label>
        <div class="col-lg-10">
            <input class="form-control" id="username" name="username" type="text" value="{{ $item->username }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label" for="email">Email</label>
        <div class="col-lg-10">
            <input class="form-control" id="email" name="email" type="email" value="{{ $item->email }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label" for="password">Password</label>
        <div class="col-lg-10">
            <input class="form-control" id="password" name="password" type="password" value="{{ $item->password }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label" for="status">Status</label>
        <div class="col-lg-10">
            <select class="custom-select" name="status" id="status">
                <option value="active">Active</option>
                <option value="inactive">In active</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label" for="group">Group</label>
        <div class="col-lg-10">
            <select class="custom-select" name="group_id" id="group">
                <option value="1">Admin</option>
                <option value="2">Member</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-lg-2 d-flex justify-content-end col-md-10">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </div>
</form>
