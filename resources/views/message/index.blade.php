@extends('ui.admin_panel.master')

@section('title', 'Message')

@section('style')

@endsection

@section('content_title')
    <h4 class="mt-2">Inbox</h4>
@endsection

@section('main_content')
    <div class="row page-content">
        <div class="container">
            {{-- card-body start --}}
            <div class="card card-default edit__inner__container">
                {{-- <div class=" ml-auto mb-2 mt-2 mr-3">
                <a class="btn btn-warning" href="{{ url('designation/label/create') }}">Add New Label</a>
        </div> --}}
                <div class="card-body table-responsive">
                    <table class="table" id="table_id">
                        <thead>
                            <tr>
                                <th scope="col">Subject</th>
                                <th scope="col">Message</th>
                                <th scope="col">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Content</td>
                                <td>Content</td>
                                <td>
                                    <div class="action_td">
                                        <a class="replay__btn" href="" type="button" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            <span>Reply</span>
                                        </a>
                                        <a href="#">
                                            <img src="{{ asset('ui/admin_assets/dist/img/delete_icon.png') }}"
                                                alt="Delete" class="action__icon">
                                        </a>

                                        <!-- Modal -->
                                        <div class="modal fade action_modal" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content site-table-modal">
                                                    <div class="modal-body popup-body">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                        <div class="popup-body-text" id="kyc-action-data">
                                                            <h3 class="title mb-4">
                                                                Send Message

                                                            </h3>
                                                            <form action="{{ url('user/send-notification') }}"
                                                                method="post">
                                                                <input type="hidden" name="user_id" value="dsfdsf">
                                                                <div class="site-input-groups">
                                                                    <label for=""
                                                                        class="box-input-label">Subject:</label>
                                                                    <input type="text" name="subject"
                                                                        class="box-input mb-0" required>
                                                                </div>
                                                                <div class="site-input-groups">
                                                                    <label for="" class="box-input-label">Details
                                                                        Message</label>
                                                                    <textarea name="message" class="form-textarea mb-0"></textarea>
                                                                </div>

                                                                <div class="action-btns">
                                                                    <button type="submit"
                                                                        class="btn primary-btn centered me-2">
                                                                        <i class="fas fa-paper-plane"></i>
                                                                        Send Message
                                                                    </button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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
