@extends('layouts.main')

@section('title' , 'Personal Link')

@section('content')
<div id="main">

    <section class="wrapper style1">

        <div class="inner">
            <div class="row 200%">

                <div class="6u 12u$(medium)">
                    User id : {{ $user_id }}
                    <ul class="actions small">
                        <li><a href="{{route('logout')}}" class="button special small">Logout</a></li>
                    </ul>

                    <h3>Personal Link</h3>

                    <form method="post" action="{{route('register')}}">
                        @csrf
                        <div class="row uniform">
                            <div class="6u 12u$(xsmall)">
                                <h5>Link</h5>
                                <input type="text" name="link" id="link" value="{{ old('link') }}" placeholder="link" />
                            </div>
                            <div class="6u$ 12u$(xsmall)">
                                <h5>Short Link</h5>
                                /shortLink/
                            </div>
                            <div class="6u 12u$(xsmall)">

                                <!-- Break -->
                                <div class="12u$">
                                    <ul class="actions">
                                        <li><input type="submit" value="Save" /></li>
                                        <li><input type="reset" value="Reset" class="alt" /></li>
                                    </ul>
                                </div>
                            </div>
                    </form>
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