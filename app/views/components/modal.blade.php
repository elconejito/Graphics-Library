
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title">{{ $modal->title }}</h4>
</div>
<div class="modal-body">
    {{ $modal->body }}
</div>
<div class="modal-footer">
    {{ $modal->printButtons() }}
</div>
