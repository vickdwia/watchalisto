<style>
  /* modal wrapper */
  #addMovieModal .modal-content {
    background: #0b1220;
    border-radius: 16px;
    border: 1px solid rgba(255,255,255,0.06);
    box-shadow: 0 30px 80px rgba(0,0,0,.7);
  }

  /* header */
  #addMovieModal .modal-header {
    border-bottom: 1px solid rgba(255,255,255,0.06);
  }

  #addMovieModal .modal-title {
    font-weight: 600;
    letter-spacing: .3px;
  }

  /* search input */
  #modalSearchInput {
    background: #0f172a;
    border: 1px solid rgba(255,255,255,0.08);
    color: #e5e7eb;
    border-radius: 12px;
    padding: 12px 14px;
  }

  #modalSearchInput::placeholder {
    color: #64748b;
  }

  #modalSearchInput:focus {
    background: #0f172a;
    border-color: #3b82f6;
    box-shadow: 0 0 0 2px rgba(59,130,246,.25);
    color: #fff;
  }

  /* result container */
  #modalSearchResult {
    margin-top: 12px;
  }

  /* list item */
  #modalSearchResult .list-group-item {
    background: #020617 !important; 
    border: 1px solid rgba(255,255,255,0.05);
    border-radius: 12px;
    margin-bottom: 10px;
    transition: all .2s ease;
  }

  /* hover */
  #modalSearchResult .list-group-item:hover, #modalSearchResult .list-group-item:focus {
    background: #0f172a !important;
    transform: translateY(-2px);
  }

  /* poster */
  #modalSearchResult img {
    width: 44px;
    height: 66px;
    object-fit: cover;
    border-radius: 6px;
    box-shadow: 0 6px 16px rgba(0,0,0,.6);
  }

  /* title */
  #modalSearchResult .fw-semibold {
    font-size: .95rem;
  }

  /* meta text */
  #modalSearchResult small {
    font-size: .75rem;
    color: #94a3b8 !important;
  }

  /* plus button */
  #modalSearchResult .add-to-list-btn {
    border-radius: 10px;
    border: 1px solid rgba(34,197,94,.4);
    color: rgb(20, 184, 166);
  }

  #modalSearchResult .add-to-list-btn:hover {
    background: rgba(34,197,94,.15);
    border-color: rgb(20, 184, 166);
    color: rgb(20, 184, 166);
  }

  /* close button */
  #addMovieModal .btn-close {
    filter: invert(1);
  }

  /* wrapper item harus relative */
  #modalSearchResult .list-group-item {
    position: relative;
  }

  /* tombol + default: hidden */
  #modalSearchResult .add-to-list-btn {
    opacity: 0;
    pointer-events: none;
    transform: translateX(6px);
    transition: all .2s ease;
  }

  /* saat hover item → tombol muncul */
  #modalSearchResult .list-group-item:hover .add-to-list-btn {
    opacity: 1;
    pointer-events: auto;
    transform: translateX(0);
  }

  /* MATIIN SEMUA DEFAULT BUTTON STYLE */
  #modalSearchResult .add-to-list-btn {
    background: transparent !important;
    box-shadow: none !important;
  }

  #modalSearchResult .add-to-list-btn:focus,
  #modalSearchResult .add-to-list-btn:active {
    background: transparent !important;
    box-shadow: none !important;
  }

</style>

<div class="modal fade" id="addMovieModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">Add to List</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <input
            type="text"
            id="modalSearchInput"
            class="form-control mb-3"
            placeholder="Search drama / manhwa..."
            autocomplete="off"
        />
        <div id="modalSearchResult" class="list-group"></div>
      </div>
    </div>
  </div>
</div>