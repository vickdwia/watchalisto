<style>
  /* STATUS MODAL SCOPE */
  #statusModal .modal-content {
    background: #0b1220;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.06);
  }

  #statusModal .form-dark {
    background: #0f172a;
    border: 1px solid rgba(255,255,255,0.08);
    color: #e5e7eb;
  }

  #statusModal .form-dark:focus {
    background: #0f172a;
    color: #fff;
    box-shadow: none;
    border-color: #3b82f6;
  }

  #statusModal label {
    font-size: 0.75rem;
    letter-spacing: 0.04em;
  }

  #statusModal .star {
    cursor: pointer;
  }

  #statusModal .poster-preview {
    aspect-ratio: 2 / 3;
    object-fit: cover;
    background: #020617;
    box-shadow: 0 10px 30px rgba(0,0,0,0.5);
  }
</style>

<div class="modal fade" id="statusModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">

      <!-- HEADER -->
      <div class="modal-header border-0">
        <h5 class="modal-title">Add to List</h5>
        <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- BODY -->
      <div class="modal-body">
        <input type="hidden" id="statusMediaId">
        <input type="hidden" id="statusMediaType">
        <input type="hidden" id="user_media_list_id">

        <div class="row g-4">

          <!-- POSTER -->
          <div class="col-md-3">
            <img
              id="statusPoster"
              src=""
              class="img-fluid rounded poster-preview"
              alt="poster">
          </div>

          <!-- FORM -->
          <div class="col-md-9">

            <!-- ROW 1 -->
            <div class="row g-4 mb-4">
              <div class="col-md-4">
                <label>Status</label>
                <select id="statusSelect" class="form-select form-dark" required>
                  <option value="planned">Planned</option>
                  <option value="watching">Watching</option>
                  <option value="reading">Reading</option>
                  <option value="completed">Completed</option>
                </select>
                <div class="invalid-feedback">Status wajib dipilih</div>
              </div>

              <div class="col-md-4">
                <label>Score</label>
                <div id="scoreStars" class="d-flex gap-2 mt-1">
                  @for ($i = 1; $i <= 5; $i++)
                    <i class="bi bi-star fs-4 text-secondary star" data-value="{{ $i }}"></i>
                  @endfor
                </div>
                <input type="hidden" id="scoreInput">
              </div>
            </div>

            <!-- ROW 2 -->
             <div class="row g-4 mb-4">
              <div class="col-md-4">
                <label id="progressLabel">Episode / Chapter</label>
                <input type="number" id="progress" class="form-control form-dark" placeholder="Enter current episode">
              </div>

              <!-- Tambah kolom ekstra untuk Volume/Season, default disembunyikan -->
              <div class="col-md-4 d-none" id="extraProgressCol">
                <label>Season / Volume</label>
                <input type="number" id="extraProgress" class="form-control form-dark">
              </div>
            </div>

            <!-- DATES -->
            <div class="row g-4 mb-4">
              <div class="col-md-4">
                <label>Start Date</label>
                <input type="date" id="startedDate" class="form-control form-dark">
              </div>
              <div class="col-md-4">
                <label>Finish Date</label>
                <input type="date" id="finishedDate" class="form-control form-dark">
              </div>
            </div>

            <!-- NOTES -->
            <div>
              <label>Notes</label>
              <textarea id="notes" rows="3" class="form-control form-dark" placeholder="Write your thoughts..."></textarea>
            </div>
          </div>
        </div>
      </div>

      <!-- FOOTER -->
      <div class="modal-footer border-0">
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button class="btn btn-success" id="saveStatusBtn">Save</button>
        <button class="btn btn-danger d-none" id="removeStatusBtn">Remove from List</button>
      </div>
    </div>
  </div>
</div>
