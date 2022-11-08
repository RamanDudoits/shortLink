@extends('layouts.main')

@section('title' , 'Personal Link')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div id="main">

    <section class="wrapper style1">

        <div class="inner">
            <div class="row 200% append">

                <div class="6u 12u$(medium)">
                    <ul class="actions small">
                        <li><a href="{{route('logout')}}" class="button special small">Logout</a></li>
                    </ul>

                    <h3>Personal Link</h3>

                    <form class="form-short-link" method="post" action="{{route('setShortLink.store')}}">
                        
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
                                        <li><input class="btn-save" type="submit" value="Save" /></li>
                                        <li><input type="reset" value="Reset" class="alt" /></li>
                                    </ul>
                                </div>
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

                    @isset($delete_success)
                    <div class="6u 12u$(medium)">
                        <div class=" p-0 alert alert-success" role="alert">
                            Short link delete.
                        </div>
                    </div>
                    @endisset

                </div>

                <div class="6u 12u$(medium)">

                    <h5>Short Link</h5>
                    <table class="table" id="link_table">
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
                                <td>
                                    <a class="button small delete_link {{$key}}" data-link_id="{{$value['id']}}" href="#">Delete</a>
                                </td>
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

@section('customScript')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            }
        });

        let targetContainer = $('.inner');
        $(document).on('click', '.form-short-link', function(e) {
            e.preventDefault();
            let token = $("input[name='_token']").val();
            let link = $("input[name='link']").val();
            var formData = new FormData(this);

            $.ajax({
                url: '{{route("setShortLink.store")}}',
                type: 'POST',
                data: formData,
                success: function(data) {

                    $('.append').remove();
                    var elements = $(data).find('.append');
                    targetContainer.append(elements);
                },
                contentType: false,
                processData: false,

                error: function(data) {
                    var errors = data;
                    console.log(data.responseJSON.message);
                },
            })
        });

        $(document).on('click', '#link_table', function(e) {
            e.preventDefault();
            if ($(e.target).hasClass('delete_link')) {
                let link_id = $(e.target).attr('data-link_id');
                var form_data = new FormData();
                form_data.append('link_id', link_id);
                $.ajax({
                    url: '{{route("short_link.destroy")}}',
                    type: 'POST',
                    dataType: "text",
                    data: form_data,
                    success: function(data) {

                        $('.append').remove();
                        var elements = $(data).find('.append');
                        targetContainer.append(elements);
                    },
                    contentType: false,
                    processData: false,

                    error: function(data) {
                        var errors = data;
                        console.log(data.responseJSON.message);
                    },
                });
            } else {
                return;
            }
        });
    })
</script>
@endsection