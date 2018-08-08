@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            添加车间
        </div>
        <div class="card-body">
            <form action="{{route('departments.store')}}" method="post">
                @csrf
                <div class="form-group">
                    <label>车间名:</label>
                    <input autofocus="" class="form-control" id="name" name="name" required="" type="text" value="{{ old('name') }}">
                        </input>
                </div>
                <div class="form-group">
                    <label for="">管理员</label>
                    <select name="user_id" class="form-control">
                        @foreach ($operators as $operator)
                            <option value="{{ $operator->id }}">{{ $operator->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">提交</button>
            </form>
        </div>
    </div>
</div>
@endsection
