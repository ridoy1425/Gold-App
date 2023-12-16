@extends('ui.admin_panel.master')

@section('title', 'Appraisal Category')

@section('style')
@endsection

@section('content_title')
    <h4 class="mt-2">Category List</h4>
@endsection

@section('main_content')

<div class="row page-content">
    <div class="container">

        <div class="btn__small mb-2 mt-1 text-end">
            <a href="{{ route('category.Index') }}" class="card-header-link primary-btn btn">Add New Data
            </a>
        </div>

        {{-- card-body start --}}
        <div class="card card-default">
            <div class="card-body">
                <table class="table" id="table_id">
                    <thead>
                        <tr>
                            <th scope="col">Tab Type</th>
                            <th scope="col">Title</th>
                            <th scope="col">Sub Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key=>$datas)
                        <tr>
                            <td>{{ $datas->tab_type }}</td>
                            <td>{{ $datas->tab_title }}</td>
                            <td>{{ $datas->sub_title }}</td>
                            <td>
                                <div class="action_td">
                                    <a
                                        href=""
                                        type="button"
                                        data-bs-toggle="modal"
                                        data-bs-target="#exampleModal"
                                    >
                                        <img
                                            src="{{ asset('ui/admin_assets/dist/img/eyes_icon.png') }}"
                                            alt="Message"
                                            class="action__icon"
                                        />
                                    </a>

                                    <!-- Modal -->
                                    <div
                                        class="modal fade action_modal"
                                        id="exampleModal"
                                        tabindex="-1"
                                        aria-labelledby="exampleModalLabel"
                                        aria-hidden="true"
                                    >
                                        <div
                                            class="modal-dialog modal-dialog-centered"
                                        >
                                            <div
                                                class="modal-content site-table-modal"
                                            >
                                                <div
                                                    class="modal-body popup-body"
                                                >
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                    <div
                                                        class="popup-body-text"
                                                        id="kyc-action-data"
                                                    >
                                                        <p class="mb-0">
                                                            {{
                                                            $datas->description
                                                            }}
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
                                    <a href="{{ route('category.Edit',$datas->id) }}">
                                        <img src="{{ asset('ui/admin_assets/dist/img/edit_icon.png') }}" alt="Edit"
                                            class="action__icon">
                                    </a>
                                    <a href="{{ route('category.delete',$datas->id) }}"
                                        onclick="return confirm('Are you sure?')">
                                        <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}" alt="Delete"
                                            class="action__icon">
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
