@extends('layouts.main')

@section('title' , 'Personal Link')

@section('content')
<div id="main">

    <section class="wrapper style1">

        <div class="inner">
            <div class="row 200%">

                <div class="6u 12u$(medium)">
                    <ul class="actions small">
                        <li><a href="{{route('logout')}}" class="button special small">Logout</a></li>
                    </ul>

                    <h3>Personal Link</h3>

                    <form method="post" action="{{route('personallink')}}">
                        @csrf
                        <div class="row uniform">
                            <div class="6u 12u$(xsmall)">
                                <h5>Link</h5>
                                <input type="text" name="link" id="link" value="{{ old('link') }}" placeholder="link" />
                                @error('link')
                                <div class="p-0 alert alert-danger">
                                    {{$message}}
                                </div>
                                @enderror
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


                    @isset($errorReccuring)
                    <div class="6u 12u$(medium)">
                        <div class="p-0 alert alert-danger">
                            This {{$link->link}} already exists.
                            Short hash link: <a href="/{{ $link['short_link'] }}/" target="_blank">{{$link['short_link'] }}</a>
                        </div>
                    </div>
                    @endisset

                    @isset($success)
                    <div class="6u 12u$(medium)">
                        <div class=" p-0 alert alert-success" role="alert">
                            Short link created.
                        </div>
                    </div>
                    @endisset
                </div>
                <div class="6u 12u$(medium)">
                    <h5>Short Link</h5>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Shrot Link</th>
                                <th scope="col">Link</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($user->shortLinks as $key => $value)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td><a href="{{ route('short_link', $value['short_link']) }}" target="_blank">{{ route('short_link', $value['short_link']) }}</a></td>
                                <td>{{ $value['link'] }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

</div>
@endsection