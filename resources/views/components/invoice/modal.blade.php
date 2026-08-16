<div class="modal right fade" id="invoice-view-user" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog rs-popup-view" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row w-100">
                    <div class="col  p-0">
                        <h3 class="page-title m-0">
                            <span class="page-title-icon bg-gradient-primary text-white me-2">
                                <i class="bi bi-buildings"></i>
                            </span>Invoice
                        </h3>
                    </div>
                    <div class=" tm_hide_print">
                        <div class="invoice-buttons  tm_hide_print">
                            <button class="print_btnrs"><i class="bi bi-printer"></i>Print</button>
                            <button class="download_btnrs"><i class="bi bi-cloud-arrow-down"></i> Download</button>
                        </div>
                    </div>
                </div>
                <button type="button" class="btn-close xs-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="task-infos">
                    <div class="tab-content">
                        <div class="content container-fluid">
                            <!-- Content Starts -->
                            <div class="row justify-content-center">
                                <div class="col-xl-10">
                                    {{-- this is QT template --}}
                                        @include('components.invoice.tqt')
                                    
                                    {{-- this is vivekinfotech template --}}
                                        @include('components.invoice.vivek_infotech')
                                    
                                    {{-- integrate by pranav --}}
                                    {{-- this is uniotech template --}}
                                        @include('components.invoice.uniotech')
                                    
                                    {{-- integrate by pranav --}}
                                    {{-- this is vivak_fzco template --}}
                                        @include('components.invoice.vivek_fzco')
                                    {{-- /this is vivak_fzco template --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- modal-content -->
    </div>
    <!-- modal-dialog -->
</div>