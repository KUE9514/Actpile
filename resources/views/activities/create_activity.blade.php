@if (Auth::id() == $user->id)
    {!! Form::open(['route' => 'activities.store']) !!}
        <div class="form-group row">
            <label class="col-form-label">日付：</label>
            <div class="col-4">
                {!! Form::date('day', old('day'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label">活動内容：</label>
            <div class="col-3">
                {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label">時間：</label>
            <div class="col-3">
                {!! Form::time('time', old('time'), ['class' => 'form-control']) !!}
            </div>
        </div>
        <label class="col-form-label">メモ：</label>
            <div>
                {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
            </div>
        <div>
            {!! Form::submit('Post', ['class' => 'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
@endif