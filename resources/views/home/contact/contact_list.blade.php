@extends('ui.admin_panel.master')

@section('title', 'Appraisal Category')

@section('style')
@endsection

@section('content_title')
    <h4 class="mt-2">Contact List</h4>
@endsection

@section('main_content')

<div class="row page-content">
    <div class="container">

        <div class="btn__small mb-2 mt-1 text-end">
            <a href="{{ route('contact.Index') }}" class="card-header-link primary-btn btn">Add New Role
            </a>
        </div>

        {{-- card-body start --}}
        <div class="card card-default">
            <div class="card-body">
                <table class="table" id="table_id">
                    <thead>
                        <tr>
                            <th scope="col">SL</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contact as $key=>$contacts)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $contacts->phone }}</td>
                            <td>{{ $contacts->address }}</td>
                            <td>
                                <a href="{{ route('contact.Edit',$contacts->id) }}">
                                    <img src="{{ asset('ui/admin_assets/dist/img/edit_icon.png') }}" alt="Edit"
                                        class="action__icon">
                                </a>
                                <a href="{{ route('contact.delete',$contacts->id) }}"
                                    onclick="return confirm('Are you sure?')">
                                    <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}" alt="Delete"
                                        class="action__icon">
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{-- card-body end --}}
    </div>
</div>

@endsection

@section('script')

@endsection
