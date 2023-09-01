<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Stats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-center mb-4">{{ $data['survey']->title }}</h1>

                        <div class="text-center">
                            <p>Responses <strong>{{ $data['survey']->reply_amount }}</strong></p>
                            <h4>Amount of question type</h4>
                            @if($data['question']['question'])
                                <p>Text: {{$data['question']['type']['text']}}</p>
                                <p>Yes/No: {{$data['question']['type']['boolean']}}</p>
                            @endif
                        </div>

                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Question</th>
                                    <th scope="col">Answers</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['ids'] as $id)
                                    <tr>
                                        <td>{{ $data['question']['question'][$id]['question'] }}</td>
                                        <td>
                                            @if($data['question']['question'][$id]['type'] == 'boolean')
                                                <span class="col-2 m-2">No: <strong>{{ $data['question']['question'][$id]['answers']['false'] }}</strong></span>
                                                <span class="col-2 m-2">Yes: <strong>{{ $data['question']['question'][$id]['answers']['true'] }}</strong></span>
                                            @else
                                                @php $length=0;
                                                    foreach($data['question']['question'][$id]['answers']->keys() as $value){
                                                        $length += strlen($value);
                                                    }
                                                @endphp
                                                <span>Average answer length:
                                                    @if(($data['question']['question'][$id]['answers']->count()))
                                                        <strong>{{ ($length / ($data['question']['question'][$id]['answers']->count()) ) }}</strong>
                                                    @else <strong>{{ $length }}</strong>
                                                    @endif
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
