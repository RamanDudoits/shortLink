@extends('layouts.main')

@section('title' , 'login')

@section('content')
    <div class="row 200%">

                <div class="6u 12u$(medium)">

                    <h2>login</h2>

                    <form method="post" class="box" action="{{route('login')}}">
                        @csrf
                        <div class="row uniform">
                            <div class="6u$ 12u$(xsmall)">
                                <h5>Email</h5>
                                <input class="" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Email" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5>Password</h5>
                                <input class="" type="password" name="password" id="password" value="" placeholder="Password" />
                            </div>

                            <!-- Break -->
                            <div class="12u$">
                                <ul class="actions between-li ">
                                    <li><input type="submit" value="Login" /></li>
                                    <li><input type="reset" value="Reset" class="alt" /></li>
                                </ul>
                            </div>
                        </div>
                    </form>

                    <ul class="actions resize_btn">
                        <li><a href="{{route('register')}}" class="button special fit">Registration</a></li>
                    </ul>
                    @error('regError')
                    <div class="p-0 alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>
@endsection
