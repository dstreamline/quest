<div class="row code-wrapper"><div class="span12">
    <?php
    foreach ($model as $key => $cell):?>
        <div class="code btn " style="float:left" id="<?php echo 'cell_id' . $cell->id ?>"
             class="<?php echo ($cell->checked == 0) ? 'none' : 'btn-inverse'; ?>">
            <?php echo $cell->cell_value; ?>
        </div>
    <?php endforeach; ?>
</div>
</div>

<script type="text/javascript">

$('.blah').click(function(){
    $.post( "<?php echo $this->createUrl('form/updatecell', array('id'=>$this->id));?>",
        { id: $(this).id})
        .done(function( data ) {}, "json");
});

    function autoUpdated(){
        $.post( "<?php echo $this->createUrl('form/updater', array('id'=>$this->id));?>",
            { id: "<?php echo $geoModel->id;?>"})
            .done(function( data ) {
                $.each(JSON.parse(data), function(index, value) {

                    console.log(value);
                    console.log(index);
                });
            }, "json");
    }

    setInterval(autoUpdated,3000);

    </script>