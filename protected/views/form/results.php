<?php
$scriptPath=Yii::app()->AssetManager->publish(Yii::app()->baseUrl.'js/jquery.zclip.js');
$cs = Yii::app()->getClientScript();
$cs->registerScriptFile($scriptPath, CClientScript::POS_END);
?>

<div class="row code-wrapper"><div class="span12">
        <?php
        foreach ($model as $key => $cell): ?>
        <div class="code btn <?php echo ($cell->checked == 0) ? 'btn-success' : 'btn-inverse'; ?>" style="float:left" id="<?php echo 'cell_id' . $cell->id ?>" >
            <?php echo $cell->cell_value; ?>
    </div>
    <?php endforeach; ?>
</div>
</div>


<script type="text/javascript">

$('.code').dblclick(function(){
    $(this).removeClass('btn-success');
    $(this).addClass('btn-inverse');

    $.post( "<?php echo $this->createUrl('form/updatecell', array('id'=>$this->id));?>",
        { id: $(this)[0].id})
        .done(function( data ) {}, "json");
})

    function autoUpdated(){
        $.post( "<?php echo $this->createUrl('form/updater', array('id'=>$this->id));?>",
            { id: "<?php echo $geoModel->id;?>"})
            .done(function( data ) {
                $.each(JSON.parse(data), function(index, value) {
                    $('#'+index).removeClass('btn-success');
                    $('#'+index).removeClass('btn-inverse');
                    $('#'+index).addClass(value);
                });
            }, "json");
    }

    setInterval(autoUpdated,2000);


$(document).ready(function(){
    $('a#copy-description').zclip({
        path:'js/ZeroClipboard.swf',
        copy:$('p#description').text()
    });
// The link with ID "copy-description" will copy
// the text of the paragraph with ID "description"
    $('a#copy-dynamic').zclip({
        path:'js/ZeroClipboard.swf',
        copy:function(){return $('input#dynamic').val();}
    });
// The link with ID "copy-dynamic" will copy the current value
// of a dynamically changing input with the ID "dynamic"
});
- See more at: http://www.steamdev.com/zclip/#download


    </script>

