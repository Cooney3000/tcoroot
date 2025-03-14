<?php 
        TLOG(DEBUG, "orderStatus: $orderStatus", __LINE__);
        $orderButtonDisabled = ($orderStatus == 'pending') ? "" : "disabled";
?>
    <div class="mb-3 d-flex justify-content-center">
    <button type="button" class="btn btn-success ms-1 mb-3" id="save-order">Speichern</button>
    <button type="button" class="btn btn-success ms-1 mb-3" id="close-order" <?= $orderButtonDisabled ?>>Bestellen</button>
    <button type="button" class="btn btn-danger ms-1 mb-3" id="reset-amounts">Alles auf 0</button>
</div>
