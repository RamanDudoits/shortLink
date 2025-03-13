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
                                <h5>You`r short name, if you need</h5>
                                <input type="text" name="user_short" id="user_short" value="{{ old('user_short') }}" placeholder="short name" />
                                @error('user_short')
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
                            Short hash link: <a href="{{ route('short_link', $link['id']) }}" target="_blank">{{$link['short_link'] }}</a>
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
                                <th scope="col">Short Link</th>
                                <th scope="col">Link</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($user->shortLinks as $key => $value)
                            <tr>
                                <th scope="row">{{ $key+1 }}</th>
                                <td><a href="{{ route('short_link', $value->id) }}" target="_blank">{{ route('short_link', $value['short_link']) }}</a></td>
                                <td>{{ $value['link'] }}</td>
                                <td>
                                    <a class="button small delete_link {{$key}}" data-link_id="{{$value->id}}" href="#">Delete</a>
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
        $(document).on('click', '.btn-save', function(e) {
            e.preventDefault();
            var formData = new FormData($(this).closest('form')[0]);
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
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    $('.error-message').remove();
                    $.each(errors, function(field, messages) {
                        var inputField = $('[name="' + field + '"]');
                        inputField.after('<div class="p-0 alert alert-danger">' + messages[0] + '</div>');
                    });
                }
            })
        });

        $(document).on('click', '.delete_link', function(e) {
            e.preventDefault();
            let link_id = $(this).data('link_id');
            $.ajax({
                url: '{{route("short_link.destroy")}}',
                type: 'POST',
                data: {
                    link_id: link_id,
                },
                success: function(response) {
                    $('.append').remove();
                    var elements = $(response).find('.append');
                    targetContainer.append(elements);
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    alert(errors.link_id ?? errors.link_id[0]);
                },
            });
        });
    })
</script>
@endsection
