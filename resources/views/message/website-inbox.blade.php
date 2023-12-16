@extends('ui.admin_panel.master') @section('title', 'Appraisal Category')
@section('style') @endsection @section('content_title')
<h4 class="mt-2">Privacy List</h4>
@endsection @section('main_content')

<div class="row page-content">
    <div class="container">
        {{-- card-body start --}}
        <div class="card card-default edit__inner__container">
            <div class="card-body table-responsive">
                <table class="table" id="table_id">
                    <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($message as $key => $datas)
                            <tr>
                                <td>{{ date('d-M,Y', strtotime($datas->created_at)) }}</td>
                                <td>{{ $datas->name }}</td>
                                <td>{{ $datas->email }}</td>
                                <td>{{ $datas->subject }}</td>
                                <td>
                                    <div class="action_td">
                                        <a href="" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $datas->id }}">
                                            <img src="{{ asset('ui/admin_assets/dist/img/eyes_icon.png') }}"
                                                alt="Message" class="action__icon" />
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade action_modal" id="exampleModal{{ $datas->id }}"
                                            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content site-table-modal">
                                                    <div class="modal-body popup-body">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                        <div class="popup-body-text" id="kyc-action-data">
                                                            <p class="mb-0">
                                                                {{ $datas->message }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="action_td">
                                        <a href="{{ url('home/message/delete', $datas->id) }}"
                                            onclick="return confirm('Are you sure?')">
                                            <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}"
                                                alt="Delete" class="action__icon" />
                                        </a>
                                    </div>
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

@endsection @section('script')
<script>
    $(document).ready(function() {
        $("#table_id").DataTable({
            rowHeight: 20,
        });
    });
</script>
@endsection
