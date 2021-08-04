@php
$formAction = route('profiles.store');
$formMethod = 'POST';
if ($formType === 'edit') {
    $formAction = route('profiles.update', ['profile' => $item->user_id]);
    $formMethod = 'PUT';
}
@endphp
<form action="{{ $formAction }}" method="post">
    {{ csrf_field() }}
    {{ method_field($formMethod) }}
    @if ($formType == 'add')
        <input type="hidden" name="userId" value="{{ $userId }}">
    @endif
    <div class="form-group row">
        <label class="col-lg-2 col-form-label" for="fullname">Fullname</label>
        <div class="col-lg-10">
            <input class="form-control" id="fullname" name="fullname" type="text" value="{{ $item->fullname }}">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-lg-2 col-form-label" for="phone">Phone</label>
        <div class="col-lg-10">
            <input class="form-control" id="phone" name="phone" type="text" value="{{ $item->phone }}">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-lg-2 col-form-label" for="address">Address</label>
        <div class="col-lg-10">
            <input class="form-control" id="address" name="address" type="text" value="{{ $item->address }}">
        </div>
    </div>
    <div class="form-group row">
        <div class="offset-lg-2 d-flex justify-content-end col-md-10">
            <button class="btn btn-primary" type="submit">Submit</button>
        </div>
    </div>
</form>
