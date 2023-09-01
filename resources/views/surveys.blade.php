<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Surveys') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-center mb-4">Add new Survey</h3>
                    <form method="post" action="/surveys/create" id="newSurvey">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="title" class="form-label">Survey Title</label>
                                <input name="title" type="text" class="form-control" id="title" onkeyup="passVal()" value="{{ old('title') }}" aria-describedby="titleHelp">
                                <span id="titleHelp" class="form-text">Give me a name.</span>
                                @error('title')
                                    <small class="text-danger">Provided title error</small>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="name" class="form-label">Survey access name</label>
                                <input name="name" type="text" class="form-control" id="name" value="{{ old('name') }}" aria-describedby="nameHelp">
                                <span id="nameHelp" class="form-text">I will be available at this address.</span>
                                @error('name')
                                    <small class="text-danger">Provided name error</small>
                                @enderror
                            </div>
                            <div class="col-4">
                                <label for="published" class="form-label">Publish</label>
                                <div class="form-switch">
                                    <input class="form-check-input" type="checkbox" id="published" name="published" value="true">
                                    <label class="form-check-label" for="published">Publish questionnaire when created.</label>
                                </div>
                            </div>
                        </div>
                        <span class="d-grid flex justify-content-end">
                            <button id="newSurveySubmit" type="submit" class="btn btn-primary">Add</button>
                        </span>
                        @if($errors->any())
                            <small class="text-danger">Data error</small>
                        @endif
                    </form>
                </div>
            </div>
        </div>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div id="existingSurveys" class="p-6 bg-white border-b border-gray-200">
                        @include('surveys.surveys-table')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('surveys.modal')
</x-app-layout>
