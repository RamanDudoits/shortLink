@extends('layouts.main')

@section('title' , 'login')

@section('content')
    <div class="row 200%">
        <div class="6u 12u$(medium)">
            <h2>{{__('page.login')}}</h2>
            <form method="post" class="box" action="{{route('login')}}">
                @csrf
                <div class="row uniform">
                    <div class="6u$ 12u$(xsmall)">
                        <h5>{{__('page.fields.email')}}</h5>
                        <input class="" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="{{__('page.email')}}" />
                        @error('email')
                        <div class="p-0 alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="6u 12u$(xsmall)">
                        <h5>{{__('page.fields.password')}}</h5>
                        <input class="" type="password" name="password" id="password" value="" placeholder="{{__('page.password')}}" />
                        @error('password')
                        <div class="p-0 alert alert-danger">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <!-- Break -->
                    <div class="12u$">
                        <ul class="actions between-li ">
                            <li><input type="submit" value="{{__('page.login')}}" /></li>
                            <li><input type="reset" value="{{__('page.reset')}}" class="alt" /></li>
                        </ul>
                    </div>
                </div>
            </form>
            <a href="{{route('register')}}" class="btn btn-outline-secondary special fit">{{__('page.registration')}}</a>
            @if ($errors->has('regError'))
                <div class="alert alert-danger">
                    {{ $errors->first('regError') }}
                </div>
            @endif
        </div>
    </div>
@endsection
