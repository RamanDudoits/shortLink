@extends('layouts.main')

@section('title' , __('page.personal_link'))

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="row 200% append">
    <div class="6u 12u$(medium)">
        <ul class="actions small">
            <li><a href="{{route('logout')}}" class="button special small">{{__('page.logout')}}</a></li>
        </ul>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h3>{{__('page.personal_link')}}</h3>
        <form class="form-short-link" method="post" action="{{route('short_link.store')}}">
            @csrf
            <div class="row uniform">
                <div class="6u 12u$(xsmall)">
                    <h5>{{__('page.name_link')}}</h5>
                    <input type="text" name="name" id="name" value="{{ old('name')}}" placeholder="{{__('page.name_link')}}" />
                    @error('name')
                        <div class="p-0 alert alert-danger">
                            {{$message}}
                        </div>
                    @enderror
                    <h5 class="mt-2">{{__('page.link')}}</h5>
                    <input type="text" name="link" id="link" value="{{ old('link') }}" placeholder="{{__('page.link')}}" />
                        @error('link')
                            <div class="p-0 alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    <h5 class="mt-2">{{__('page.need_str_by_link')}}</h5>
                    <input type="text" name="user_short" id="user_short" value="{{ old('user_short') }}" placeholder="{{__('page.short_name')}}" />
                        @error('user_short')
                            <div class="p-0 alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                </div>
                <div class="6u 12u$(xsmall)">
                    <!-- Break -->
                    <div class="12u$">
                        <button id="save_link" class="btn btn-primary" type="button">{{__('page.save')}}</button>
                    </div>
                </div>
            </div>
        </form>
        @isset($errorReccuring)
        <div class="6u 12u$(medium)">
            <div class="p-0 alert alert-danger">
                <div>
                    {{__('page.already_link', ['link' => $link->link])}}
                </div>
                <div>
                    {{__('page.short_has')}} <a href="{{ route('links.redirect', $link->id) }}" target="_blank">{{$link->short_link }}</a>
                </div>
            </div>
        </div>
        @endisset

        @isset($successCreated)
        <div class="6u 12u$(medium)">
            <div class="alert alert-success" role="alert">
                {{__('page.created_link')}}
            </div>
        </div>
        @endisset
        @isset($delete_success)
        <div class="6u 12u$(medium)">
            <div class="alert alert-success" role="alert">
                {{__('page.deleted_link')}}
            </div>
        </div>
        @endisset

    </div>
    <div class="6u 12u$(medium)">
        <h5>{{__('page.short_link')}}</h5>
        <table class="table" id="link_table">
            <thead>
                <tr>
                    <th scope="col">{{__('page.id')}}</th>
                    <th scope="col">{{__('page.name_link')}}</th>
                    <th scope="col">{{__('page.short_link')}}</th>
                    <th scope="col">{{__('page.link')}}</th>
                    <th scope="col">{{__('clicks')}}</th>
                    <th scope="col">{{__('actions')}}</th>
                </tr>
            </thead>
            <tbody>

                @foreach($user->shortLinks as $key => $value)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $value->name }}</td>
                    <td><a href="{{ route('links.redirect', $value->id) }}" target="_blank">{{ route('links.redirect', $value->short_link) }}</a></td>
                    <td>{{ $value->link }}</td>
                    <td>{{ $value->clicks }}</td>
                    <td>
                        <div class="btn-group">
                        <a class="btn btn-danger delete_link" data-link_id="{{$value->id}}" href="#">{{__('delete')}}</a>
                        <a class="btn btn-warning" href="{{route('short_link.edit', $value->id)}}">{{__('edit')}}</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
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
        $(document).on('click', '#save_link', function(e) {
            e.preventDefault();
            var formData = new FormData($(this).closest('form')[0]);
            $.ajax({
                url: '{{route("short_link.store")}}',
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
