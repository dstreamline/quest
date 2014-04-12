<div>
    <?php
    foreach ($model as $key => $cell):?>
        <div class="blah" style="float:left; border: solid #000000 1px" id="<?php echo 'cell_id' . $cell->id ?>"
             class="<?php echo ($cell->checked == 0) ? 'none' : 'Ok'; ?>">
            <?php echo $cell->cell_value; ?>
        </div>
    <?php endforeach; ?>
</div>


<script type="text/javascript">

$('.blah').click(function(){
    $.post( "<?php echo $this->createUrl('form/updatecell', array('id'=>$this->id));?>",
        { id: $(this).id})
        .done(function( data ) {}, "json");
})

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

    setInterval(autoUpdated,5000);

    </script>