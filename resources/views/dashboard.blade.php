<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row row-cols-2 row-cols-md-2 justify-content-evenly mb-4 text-center">
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">Surveys</h4>
                        </div>
                        <div class="card-body">

                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Title</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr>
                                        <td class="hover:bg-gray-100"><a href="/survey/{{ $item->name }}" style="color: inherit;text-decoration: inherit;">{{ $item->title }}</a></td>
                                        <td>
                                            <button value="{{ $item->id }}" data-bs-toggle="tooltip" type="button" title="Stats"
                                                    class="survey-stats-action btn btn-outline-info text-end"><i class="zmdi zmdi-equalizer"></i></button>
                                            <button value="{{ $item->id }}" title="Edit" data-bs-toggle="tooltip" type="button" class="btn btn-outline-info survey-edit-action"><i class="zmdi zmdi-edit"></i></button>
                                            <span data-bs-toggle="modal" data-bs-target="#deleteModal"><button value="{{ $item->id }}" title="Delete" data-bs-toggle="tooltip" data-bs-whatever="{{$item->title}}" type="button" class="btn btn-outline-danger survey-delete-action"><i class="zmdi zmdi-delete"></i></button></span>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            <button type="button" onclick="location.href='/surveys'" class="w-100 btn btn-lg btn-outline-primary">More...</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('surveys.modal')
</x-app-layout>
