@extends('layouts.layout')
@section('content')
    <div class="m-3">
        <h1 class="text-center">Online</h1>

        <!-- simple groups -->
        <div class="online-groups groups">
            <div class="main-container mt-4">
            </div>
        </div>

        <!-- Модалки для item -->
        <div class="modal fade" id="itemModal" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemModalTitle"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body" id="itemModalBody">
                        Завантаження...
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection