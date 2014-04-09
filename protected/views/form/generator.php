<?php if (!(isset($_GET["type"]))) {($_GET["type"] = 'number');};
?>



<div class="container-fluid">
    <div class="row-fluid">
        <div class="span2 navigation-border">
            <?php $this->renderPartial('navbar', array('model' => $model)); ?>
        </div>
        <form>
        <div class="span7 data-form-border">

            <?php
                if ($_GET["type"] == "sequence") {
                    $this->renderPartial('input5', array('model' => $model));
                    $this->renderPartial('input2', array('model' => $model));
                    print "<script src=\"/js/form-sequence.js\"></script>";
                }
                elseif ($_GET["type"] == "correct") {
                    $this->renderPartial('input2', array('model' => $model));

                }
                elseif ($_GET["type"] == "block") {
                    $this->renderPartial('input3', array('model' => $model));
                }
                else{
                    $this->renderPartial('input1', array('model' => $model));
                };
            ?>
        </div>
        <div class="span3 data-form-options"><div class="data-background">
            <?php
                            if ($_GET["type"] == "sequence") {
                    $this->renderPartial('input4', array('model' => $model));
                    $this->renderPartial('input7', array('model' => $model));
                 }
                elseif ($_GET["type"] == "correct") {
                    $this->renderPartial('input4', array('model' => $model));
                    $this->renderPartial('input8', array('model' => $model));
                    $this->renderPartial('input6', array('model' => $model));
                    $this->renderPartial('input7', array('model' => $model));
                    print "<script src=\"/js/form-correct.js\"></script>";
                }
                elseif ($_GET["type"] == "block") {
                    $this->renderPartial('input4', array('model' => $model));
                    $this->renderPartial('input6', array('model' => $model));
                    $this->renderPartial('input7', array('model' => $model));
                }
                else{
                    $this->renderPartial('input7', array('model' => $model));
            };
            ?>
            <div style="text-align: center;padding: 10px">
            <button type="submit" class="btn btn-large btn-danger">Сгенерировать</button>


        </div>                <div class="alert">
                    <?php
                    if (isset($_GET["type"]))
                    {
                        if ($_GET["type"] == "sequence") {
                            $this->renderPartial('info_sequence', array('model' => $model));
                        }
                        elseif ($_GET["type"] == "correct") {
                            $this->renderPartial('info_correct', array('model' => $model));
                        }
                        elseif ($_GET["type"] == "block") {
                            $this->renderPartial('info_block', array('model' => $model));
                        }
                        else{
                            $this->renderPartial('info_number', array('model' => $model));
                        }
                    }
                    else
                    {
                        $this->renderPartial('info_number', array('model' => $model));
                    };
                    ?>
                </div></div></div>
            </form>
    </div>
</div>