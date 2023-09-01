<x-guest-layout>
    <div style="margin-top: 100px; width: min(100% - 4rem, 960px); margin-inline: auto;">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

                        <form method="post" action="#" class="p-6 bg-white border-b border-gray-200">
                        @csrf
                                <div class="form-header-group  header-large text-center">
                                    <div class="header-text httac htvam">
                                        <h1 id="header_19" class="form-header" data-component="header">
                                            {{ $survey['surveys']->title }}
                                        </h1>
                                    </div>
                                </div>
        {{--                        FORM--}}
                                @foreach($survey['questions'] as $question)
                                    <div class="mb-3 justify-content-center">
                                        <div class="text-center">
                                            <label for="{{$question->survey_id.$question->id}}" class="form-label mt-3 align-self-center">{{$question->question}}?</label>
                                        </div>
                                        <input type="hidden" name="answers[{{$question->id}}][question_id]" value="{{$question->id}}">
                                        <input type="hidden" name="reply_amount" value="{{ ($survey['surveys']->reply_amount)+1 }}">
                                        @switch($question->type)
                                            @case('text')
                                                <textarea class="form-control" id="{{$question->survey_id.$question->id}}" rows="2" name="answers[{{$question->id}}][answer]"></textarea>
                                                @break
                                            @case('boolean')
                                                <div class="text-center">
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="answers[{{$question->id}}][answer]" value="true">
                                                        <label class="form-check-label">Yes</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="answers[{{$question->id}}][answer]" value="false">
                                                        <label class="form-check-label">Nope</label>
                                                    </div>
                                                </div>
                                                @break
                                        @endswitch
                                        @error('answers['.$question->id.'][answer]')
                                            <small class="text-danger">Data error</small>
                                        @enderror
                                    </div>
                                    @if(!$loop->last)
                                        <div class="form-line form-input-wide" data-type="control_separator" data-layout="full">
                                            <div data-component="separator" style="border-top:1px solid rgb(0,0,0);clear:both"></div>
                                        </div>
                                    @endif
                                @endforeach
                                @if($errors->any())
                                    <small class="text-danger">Data error</small>
                                @endif
                                <div class="mt-5 flex justify-content-end">
                                    <button id="submitAnswer" type="submit" class="btn btn-primary">Answer</button>
                                </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
