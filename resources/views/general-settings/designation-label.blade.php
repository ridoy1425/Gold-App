@extends('ui.admin_panel.master')

@section('title', 'Designation Label')

@section('style')

@endsection

@section('content_title')
    <h4 class="mt-2">Designation Label</h4>
@endsection

@section('main_content')
    <div class="row page-content"> 
        <div class="container">
            {{-- message alert --}}
            <div class="alert_message mt-2">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul style="margin-bottom: 0rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (Session::has('success'))
                    <div class="alert alert-success" role="success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                @if (Session::has('error'))
                    <div class="alert alert-danger" role="success">
                        {{ Session::get('error') }}
                    </div>
                @endif
            </div>

            {{-- card-body start --}}
            <div class="card card-default">
                <div class=" ml-auto mb-2 mt-2 mr-3">
                    <a class="btn btn-warning" href="{{ url('designation/label/create') }}">Add New Label</a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">USER NAME</th>
                                <th scope="col">ID</th>
                                <th scope="col">PHONE</th>
                                <th scope="col">E-MAIL</th>
                                <th scope="col">BALANCE</th>
                                <th scope="col">KYC</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($labels as $label)
                                <tr>
                                    <td>AR Ridoy</td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $label->label }}</td>
                                    <td>{{ $label->label }}</td>
                                    <td>{{ $label->label }}</td>
                                    <td>{{ $label->label }}</td>
                                    <td>{{ $label->label }}</td>
                                    <td class="action_td">
                                        <a href="{{ URL('designation/label/edit', $label->id) }}">
                                            <img src="{{ asset('ui/admin_assets/dist/img/edit_icon.png') }}" alt="Edit" class="action__icon">
                                        </a>
                                        <a href="{{ URL('designation/label/edit', $label->id) }}">
                                            <img src="{{ asset('ui/admin_assets/dist/img/send_message.png') }}" alt="Message" class="action__icon">
                                        </a>
                                        <a href="{{ URL('/designation/label/delete', $label->id) }}">
                                            <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}" alt="Delete" class="action__icon">
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
    <script>
        $(document).ready(function() {
            $('#table_id').DataTable({
                rowHeight: 20,
            });
        });
    </script>
@endsection
