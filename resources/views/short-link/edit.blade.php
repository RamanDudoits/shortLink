@extends('layouts.main')

@section('title' , __('page.link_edit'))

@section('content')
    <form class="form-short-link" method="post" action="{{route('short_link.update', $shortLink->id)}}">
        @csrf
        <div class="row uniform">
            <div class="6u 12u$(xsmall)">
                <h5>{{__('page.name_link')}}</h5>
                <input type="text" name="name" id="name" value="{{ old('name') ?? $shortLink->name }}" placeholder="{{__('page.name_link')}}" />
                @error('name')
                    <div class="p-0 alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
                <h5 class="mt-2">{{__('page.link')}}</h5>
                <input type="text" name="link" id="link" value="{{ old('link') ?? $shortLink->link }}" placeholder="{{__('page.link')}}" />
                @error('link')
                    <div class="p-0 alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
                <h5 class="mt-2">{{__('page.need_str_by_link')}}</h5>
                <input type="text" name="user_short" id="user_short" value="{{ old('user_short') ?? $shortLink->short_link  }}" placeholder="{{__('page.short_name')}}" />
                @error('user_short')
                    <div class="p-0 alert alert-danger">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <div class="6u 12u$(xsmall)">
                <div class="12u$">
                    <button id="edit_link" class="btn btn-primary" type="submit">{{__('page.edit')}}</button>
                    <a href="{{route('personalLink')}}" class="btn btn-secondary" type="button">{{__('page.back')}}</a>
                </div>
            </div>
        </div>
    </form>
@endsection
