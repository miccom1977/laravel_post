@extends('layouts.app')

@section('content')
    <div class="card mb-4">
        <div class="card-header">
            {{ __('Add new country') }}
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('country.store') }}">
                @csrf
                <table  class="table">
                    <tr>
                        <td>
                            <label>Name</label>
                        </td>
                        <td>
                            <label>Official Language/es</label>
                        </td>
                        <td>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="name" id="name">
                        </td>
                        <td>
                            <input type="text" name="languages" id="languages" style="width:350px;" placeholder="english name, add a decimal if more languages">
                        </td>
                        <td>
                            <input type="submit" name="send" value="Dodaj" class="btn btn-dark btn-block">
                        </td>
                    </tr>
            </form>
            </table><br>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Flag</th>
                    <th scope="col">Visited?</th>
                </tr>
                </thead>
                <tbody>

                    @foreach($countries as $singleCountry)
                    <tr>
                        <td><a href="/country/{{ $singleCountry->id }}">{{ $singleCountry->name }}</a></td>
                        <td>
                            @if ( !isset($singleCountry->file->path) )
                                <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ url('store', $singleCountry->id ) }}" >
                                    @csrf
                                    @method('POST')
                                    <input type="file" name="file" placeholder="Choose file" id="file">
                                    <input type="hidden" name="country_id" value="{{ $singleCountry->id }}">
                                        @error('file')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    <button type="submit" id="submit" class="btn btn-dark btn-block" formaction="{{ url('store/file') }}" value="file">Zapisz obrazek</button>
                                </form>
                            @else
                                <img src="{{ asset( '../files/'.$singleCountry->file->path ) }}" height="25px"></td>
                            @endif
                        <td>
                            @if(!$singleCountry->visitor)
                            <form method="post" action="{{ route('countryVisitor.store') }}">
                                @csrf
                                <input type="hidden" name="country_id" value="{{ $singleCountry->id }}">
                                <input type="submit" name="send" id="store" value="I Was there!" class="btn btn-dark btn-block">
                            </form>
                            @else
                            <form method="post" action="{{ route('countryVisitor.destroy', $singleCountry ) }}">
                                @csrf
                                @method('DELETE')
                                <input type="submit" name="send" id="destroy" value="I was not there!" class="btn btn-dark btn-block">
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>

        <div class="card-footer">

        </div>
    </div>
@endsection
