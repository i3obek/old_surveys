<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Surveys') }}
        </h2>
    </x-slot>

    <div style="margin-top: 100px; width: min(100% - 4rem, 960px); margin-inline: auto;">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-center mb-4">Adjust survey <i>{{ $survey['survey']->title }}</i></h3>
                                <form method="post" action="#" id="editSurveyForm">
                                <div class="form-switch flex align-items-center justify-content-center">
                                    <input class="form-check-input" type="checkbox" id="published" name="published" value="true" @if($survey['survey']->published) checked @endif>
                                    <label class="form-check-label" for="published"> Accessible?</label>
                                </div>
                                <div class="flex justify-content-end align-items-end">
                                    <button id="addQuestion" type="button" class="btn btn-outline-success">Add Question</button>
                                </div>
                                    @csrf
                                        <input type="hidden" name="trash" id="lastQuestion" @if($survey['last']) value="{{ $survey['last']->id }} @endif">
                                        <div id="questions">
                                            @foreach($survey['questions'] as $question)

                                                    <div class="row mb-5" id="question-{{ $question->id }}">
                                                        <div class="col-9">
                                                            <div class="mb-3">
                                                                <label class="form-label"><strong>Question</strong></label>
                                                                <input type="text" name="questions[{{ $question->id }}][question]" class="form-control"
                                                                       id="questionsQuestion-{{ $question->id }}" placeholder="Example question?" value="@if($question->question) {{$question->question}} @else {{ old('questions['. $question->id .'][question]') }} @endif">
                                                                @error('questions[' . $question->id . '][question]')
                                                                    <small class="text-danger">Data error</small>
                                                                @enderror
                                                            </div>
                                                            <div class="align-items-center">
                                                                <label class="flex justify-content-center"><strong>Type of Answer</strong></label>
                                                                <div class="flex justify-content-center">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="questions[{{ $question->id }}][type]"
                                                                               id="questionsTypeTxt-{{ $question->id }}" value="text" @if($question->type == 'text') checked @endif>
                                                                        <label class="form-check-label">Text</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio" name="questions[{{ $question->id }}][type]"
                                                                               id="questionsTypeYesNo-{{ $question->id }}" value="boolean" @if($question->type == 'boolean') checked @endif>
                                                                        <label class="form-check-label">Yes / No</label>
                                                                    </div>
                                                                    @error('questions[' . $question->id . '][type]')
                                                                        <small class="text-danger">Data error</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <input hidden name="questions[{{ $question->id }}][id]" value="{{ $question->id }}">
                                                        </div>
                                                        <div class="col-2 align-self-center">
                                                            <button id="deleteQuestion-{{ $question->id }}" onClick="deleteQuestion(this.id)" type="button" class="btn btn-outline-danger">Delete</button>
                                                        </div>
                                                        <div class="col-1 align-self-center">
                                                            <div hidden>
                                                                <input id="position-{{ $loop->iteration }}" name="questions[{{ $question->id }}][order]" type="number" value="{{ $loop->iteration }}" class="btn-position">
                                                            </div>
                                                            <button id="positionUp-{{ $question->id }}" onClick="positionUp({{ $question->id }})" type="button" title="Position Up"
                                                                class="btn btn-outline-secondary d-grid btn-position-up" data-bs-toggle="tooltip"><i class="zmdi zmdi-chevron-up"></i></button>
                                                            <button id="positionDown-{{ $question->id }}" onClick="positionDown({{ $question->id }})" type="button" title="Position Down"
                                                                class="btn btn-outline-secondary d-grid btn-position-down" data-bs-toggle="tooltip"><i class="zmdi zmdi-chevron-down"></i></button>
                                                        </div>
                                                    </div>

                                            @endforeach
                                        </div>
                                    <div class="mt-5 flex justify-content-end">
                                        <button id="editSurveySubmit" type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                    @if($errors->any())
                                        <small class="text-danger">Data error</small>
                                    @endif
                                </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
