@if ($isShowError)
    @include('partials/show_errors', ['formFor' =>$formFor])
@endif
<form action="{{ $action }}" method="post">
    {{ csrf_field() }}
    {{ method_field($method) }}
    @foreach ($formData as $key => $input)
        @php
            $inputName = $input['name'] ?? '';
            $inputValue = $input['value'] ?? '';
            $inputType = $getInputType($input);
        @endphp
        @if ($inputType !== 'hidden')
            <div class="form-group row">
                @if ($isShowLabel($input))
                    {!! Form::label($inputName, $getInputLabel($input), ['class' => $getHtmlClass('label')]) !!}
                @endif
                <div class="{{ $getInputContainerClass($input) }}">
                    @switch($inputType)
                        @case('text')
                            {!! Form::text($inputName, $inputValue, ['class' => $getHtmlClass('text-input')]) !!}
                        @break
                        @case('email')
                            {!! Form::email($inputName, $inputValue, ['class' => $getHtmlClass('text-input')]) !!}
                        @break
                        @case('password')
                            {!! Form::password($inputName, ['class' => $getHtmlClass('text-input')]) !!}
                        @break
                        @case('number')
                            {!! Form::number($inputName, $inputValue, ['class' => $getHtmlClass('text-input')]) !!}
                        @break
                        @case('select')
                            {!! Form::select($inputName, $input['selectData'], $inputValue, ['class' => $getHtmlClass('select-input')]) !!}
                        @break
                        @case('date')
                            {!! Form::date($inputName, $inputValue, ['class' => $getHtmlClass('select-input')]) !!}
                        @break
                        @case('submit')
                            <button class="btn btn-primary "
                                type="submit">{{ $inputValue === '' ? 'Submit' : $inputValue }}</button>
                        @break
                        @case('picture')
                            @php
                                $hasPicture = $input['hasPicture'] ?? false;
                                $hasCropModal = $input['hasCropModal'] ?? false;
                                $pictureSrc = $input['pictureSrc'] ?? null;
                            @endphp
                            <div>
                                <input id="image-file-input" type="file" class="custom-file-input d-none"
                                    accept=".png,.jpg">
                                <input type="hidden" name="{{ $inputName }}" id="image-text-input"
                                    value="{{ $inputValue }}" />
                            </div>
                            @if ($hasPicture && $pictureSrc)
                                <div class="img-container img-container-circle mt-3 position-relative"
                                    style="width: 200px; height:200px; border-radius: 100px; overflow:hidden">
                                    <img src="{{ $pictureSrc }}" class="img-fluid form-image" />
                                    <div class="edit-image-btn rounded rounded-circle"><span
                                            class="fas fa-image fa-4x text-light"></span>
                                    </div>
                                </div>
                            @endif
                            @if ($hasCropModal)
                                @include('partials/crop_picture_modal')
                            @endif
                        @break

                    @endswitch
                </div>
            </div>
        @else
            {!! Form::hidden($inputName, $inputValue) !!}
        @endif
    @endforeach
</form>
