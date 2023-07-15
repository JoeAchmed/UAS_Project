<div class="modal fade" id="modalForm" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalFormTitle">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @yield('form')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">@yield('labelClose')</button>
                <button type="button" class="btn btn-primary" id="btnSubmit">@yield('labelSubmit')</button>
            </div>
        </div>
    </div>
</div>