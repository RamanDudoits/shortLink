@extends('layouts.main')

@section('title' , 'Register')

@section('content')
    <div class="row 200%">
    <div class="6u 12u$(medium)">
        <h3>{{__('page.registration')}}</h3>
        <form method="post" class="box" action="{{route('register')}}">
            @csrf
            <div class="row uniform">
                <div class="6u 12u$(xsmall)">
                    <h5>{{__('page.fields.name')}}</h5>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="{{__('page.fields.name')}}" />
                    @error('name')
                    <div class="p-0 alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="6u$ 12u$(xsmall)">
                    <h5>{{__('page.fields.email')}}</h5>
                    <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="{{__('page.fields.email')}}" />
                    @error('email')
                    <div class="p-0 alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="6u 12u$(xsmall)">
                    <h5>{{__('page.fields.password')}}</h5>
                    <input type="password" name="password" id="password" value="" placeholder="{{__('page.fields.password')}}" />
                    @error('password')
                    <div class="p-0 alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <div class="6u$ 12u$(xsmall)">
                    <h5>{{__('page.fields.repeat_password')}}</h5>
                    <input type="password" name="repeat_password" id="repeat_password" value="" placeholder="{{__('page.fields.repeat_password')}}" />
                    @error('repeat_password')
                    <div class="p-0 alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
                <!-- Break -->
                <div class="12u$">
                    <ul class="actions between-li">
                        <li><input type="submit" value="{{__('page.registration')}}" /></li>
                        <li><input type="reset" value="{{__('page.reset')}}" class="alt" /></li>
                    </ul>
                </div>
            </div>
        </form>
        <a href="{{route('login')}}" class="btn btn-outline-secondary special fit">{{__('page.login')}}</a>
        @if ($errors->has('regError'))
            <div class="alert alert-danger">
                {{ $errors->first('regError') }}
            </div>
        @endif
    </div>
</div>
@endsection
