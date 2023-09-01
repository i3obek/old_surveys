<table class="table">
    <thead>
        <tr>
            <th scope="col">Title</th>
            <th scope="col">Filled</th>
            <th scope="col">Published</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $item)
        <tr>
            <td>{{ $item->title }}</td>
            <td>{{ $item->reply_amount }}</td>
            <td>@if($item->published) Yes @else No @endif</td>
            <td class="col-3">
                <button value="{{ $item->id }}" data-bs-toggle="tooltip" type="button" title="Stats"
                        class="survey-stats-action btn btn-outline-info text-end"><i class="zmdi zmdi-equalizer"> Stats</i></button>
                <button value="{{ $item->id }}" data-bs-toggle="tooltip" type="button" title="Edit"
                        class="survey-edit-action btn btn-outline-primary text-end"><i class="zmdi zmdi-edit"> Edit</i></button>
                <span data-bs-toggle="modal" data-bs-target="#deleteModal">
                    <button value="{{ $item->id }}" title="Delete" data-bs-toggle="tooltip" data-bs-whatever="{{$item->title}}"
                            type="button" class="btn btn-outline-danger survey-delete-action flex justify-content-end"><i class="zmdi zmdi-delete"> Delete</i></button>
                </span>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $data->render() !!}
