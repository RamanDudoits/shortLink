@extends('layouts.main')

@section('title' , 'login')

@section('content')

<div id="main">

    <section class="wrapper style1">

        <div class="inner">
            <div class="row 200%">

                <div class="6u 12u$(medium)">

                    <h3>login</h3>

                    <form method="post" action="{{route('login')}}">
                        @csrf
                        <div class="row uniform">
                            <div class="6u$ 12u$(xsmall)">
                                <h5>Email</h5>
                                <input type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Email" />
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <h5>Password</h5>
                                <input type="password" name="password" id="password" value="" placeholder="Password" />
                            </div>

                            <!-- Break -->
                            <div class="12u$">
                                <ul class="actions">
                                    <li><input type="submit" value="Login" /></li>
                                    <li><input type="reset" value="Reset" class="alt" /></li>
                                </ul>
                            </div>
                        </div>
                    </form>
                    <ul class="actions small">
                        <li><a href="{{route('register')}}" class="button special fit">Registration</a></li>
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