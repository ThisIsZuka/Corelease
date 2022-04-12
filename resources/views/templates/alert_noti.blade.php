<style>
  .btn-icon-X{
    position: absolute;
    right: 1px;
    margin: 10px;
  }
  .btn-icon-X:focus{
    box-shadow: 0 0 0 0rem rgb(13 110 253 / 25%) !important;
  }
</style>

{{-- <div class="modal fade" tabindex="-1" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"> --}}
  <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-body p-0 rounded-1">
            {{-- <button type="button" class="btn btn-sm btn-danger btn-icon-X" data-bs-dismiss="modal">X</button> --}}
            <button type="button" class="btn-close btn-icon-X" data-bs-dismiss="modal" aria-label="Close"></button>
            <img src="{{asset('images/Popup_alert.jpg')}}" class="img-fluid" alt="...">
        </div>
        {{-- <div class="modal-footer justify-content-center border-top-0">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div> --}}
      </div>
    </div>
  </div>


<script>
    $(document).ready(function() {
        $('#staticBackdrop').modal("show");
    });
</script>
