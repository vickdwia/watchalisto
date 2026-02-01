<div class="modal fade" id="removeConfirmModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="background: #0b1220; border-radius: 16px; border: 1px solid rgba(255,255,255,0.06);">

      <!-- HEADER -->
      <div class="modal-header border-0">
        <h5 class="modal-title text-danger">Remove from List</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">
        <p class="mb-0">Are you sure you want to remove this media from your list? This action cannot be undone.</p>
      </div>

      <!-- FOOTER -->
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
          Cancel
        </button>
        <button type="button" class="btn btn-danger" id="confirmRemoveBtn">
          Yes, Remove
        </button>
      </div>

    </div>
  </div>
</div>