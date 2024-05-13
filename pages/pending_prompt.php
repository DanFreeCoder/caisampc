<!-- Pending Modal -->
<div class="modal" id="pendingModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" style="position: relative;">
                <h1 class="text-success">Pending...</h1>
                <div class="d-flex flex-row-reverse" style="position:absolute; right: 30px; top:30px;">
                    <span class="btn btn-danger btn-sm exit">Exit</span>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- Declined Reason -->
<div class="modal" id="DeclinedModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body" style="position: relative;">
                <h1 class="text-danger">Declined Reason</h1>
                <textarea name="" id="reason" class="form-control" rows="3" disabled></textarea>
                <div class="d-flex flex-row-reverse" style="position:absolute; right: 30px; top:30px;">
                    <span class="btn btn-danger btn-sm exit">Exit</span>
                </div>
            </div>
        </div>
    </div>
</div>