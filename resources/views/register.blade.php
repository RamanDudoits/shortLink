@extends('layouts.main')

@section('title' , 'Register')

@section('content')

<div id="main">

    <section class="wrapper style1">

        <div class="inner">
            <div class="row 200%">

                <div class="6u 12u$(medium)">

                    <h3>Register</h3>

                    <form method="post" class="box" action="{{route('register')}}">
                        @csrf
                        <div class="row uniform">
                            <div class="6u 12u$(xsmall)">
                                <h5>Name</h5>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Name" />
                                @error('name')
                                <div class="p-0 alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="6u$ 12u$(xsmall)">
                                <h5>Email</h5>
                                <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Email" />
                                @error('email')
                                <div class="p-0 alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5>Password</h5>
                                <input type="password" name="password" id="password" value="" placeholder="Password" />
                                @error('password')
                                <div class="p-0 alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="6u$ 12u$(xsmall)">
                                <h5>Repeat Password</h5>
                                <input type="password" name="repeat_password" id="repeat_password" value="" placeholder="Repeat Password" />
                                @error('repeat_password')
                                <div class="p-0 alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <!-- Break -->
                            <div class="12u$">
                                <ul class="actions between-li">
                                    <li><input type="submit" value="Save" /></li>
                                    <li><input type="reset" value="Reset" class="alt" /></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                    <ul class="actions resize_btn">
                        <li><a href="{{route('login')}}" class="button special fit">Login</a></li>
                    </ul>
                    @error('regError')
                    <div class="p-0 alert alert-danger">
                        {{$message}}
                    </div>
                    @enderror
                </div>
            </div>

        </div>

    </section>

</div>

@endsection