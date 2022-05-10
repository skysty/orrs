<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `schedule_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
    #cimg{
        object-fit:scale-down;
        object-position:center center;
        height:200px;
        width:200px;
    }
</style>
<div class="container-fluid">
    <form action="" id="schedule-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="row">
            <div class="form-group col-md-6">
                <label for="type" class="control-label">Кесте түрі</label>
                <select name="type" id="type" class="form-control form-control-sm form-control-border" required>
                    <option value="1" <?= isset($type) && $type == 1 ? 'selected' : '' ?>>Күнделікті</option>
                    <option value="2" <?= isset($type) && $type == 2 ? 'selected' : '' ?>>Бір-реттік</option>
                </select>
            </div>
        </div>
        <fielset>
            <legend class="text-muted">Кесте</legend>
            <div class="row">
                <div class="form-group col-md-6 <?= (isset($type) && $type == 1) || !isset($type) ? 'd-none' : '' ?>" id="date-holder">
                    <label for="date_schedule" class="control-label">Күні</label>
                    <input type="date" name="date_schedule" id="date_schedule" class="form-control form-control-sm form-control-border" value="<?= isset($date_schedule) ? date("Y-m-d", strtotime($date_schedule)) : "" ?>" <?= (isset($type) && $type == 2) ? 'required' : '' ?>/>
                </div>
                <div class="form-group col-md-6">
                    <label for="time_schedule" class="control-label">Уақыты</label>
                    <input type="time" name="time_schedule" id="time_schedule" class="form-control form-control-sm form-control-border" required value="<?= isset($time_schedule) ? date("H:i", strtotime($time_schedule)) : "" ?>"/>
                </div>
            </div>
        </fielset>
        <div class="form-group">
            <label for="train_id" class="control-label">Пойыз</label>
            <select name="train_id" id="train_id" class="form-control form-control-border select2" >
                <?php 
                $trains = $conn->query("SELECT * FROM train_list where delete_flag = 0 ".(isset($train_id) && !empty($train_id) ? " or id = '{$train_id}' " : "")." order by name asc");
                while($row = $trains->fetch_assoc()):
                ?>
                <option value="<?= $row['id'] ?>" <?= isset($train_id) && $train_id == $row['id'] ? "selected" : "" ?> <?= $row['delete_flag'] == 1 ? "disabled" : "" ?>><?= ($row['code']. " - ". $row['name']) ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <fielset>
            <legend class="text-muted">Маршрут</legend>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="route_from" class="control-label">Қайдан</label>
                    <input type="text" name="route_from" id="route_from" class="form-control form-control-sm form-control-border" required value="<?= isset($route_from) ? $route_from : "" ?>"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="route_to" class="control-label">Қайда</label>
                    <input type="text" name="route_to" id="route_to" class="form-control form-control-sm form-control-border" required value="<?= isset($route_to) ? $route_to : "" ?>"/>
                </div>
            </div>
        </fielset>
        <fielset>
            <legend class="text-muted">Жол жүру ақысы</legend>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="first_class_fare" class="control-label">Купе</label>
                    <input type="number" name="first_class_fare" id="first_class_fare" class="form-control form-control-sm form-control-border text-right" required value="<?= isset($first_class_fare) ? $first_class_fare : "" ?>"/>
                </div>
                <div class="form-group col-md-6">
                    <label for="economy_fare" class="control-label">Плацкарт</label>
                    <input type="number" name="economy_fare" id="economy_fare" class="form-control form-control-sm form-control-border text-right" required value="<?= isset($economy_fare) ? $economy_fare : "" ?>"/>
                </div>
            </div>
        </fielset>
    </form>
</div>
<script>
    $(function(){
        $('#type').change(function(){
            if($(this).val() == 1){
                if($('#date-holder').hasClass('d-none') == false){}
                $('#date-holder').addClass('d-none')
                $('#date_schedule').val("")
            }else{
                $('#date-holder').removeClass('d-none')
            }
        })
        $('#uni_modal').on('shown.bs.modal',function(){
            $('#train_id').select2({
                placeholder:"Поезды осы жерден таңдаңыз.",
                width:'100%',
                dropdownParent:$('#uni_modal')
            })
        })
        $('#uni_modal #schedule-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_schedule",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("Бір қате орын алды",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        location.reload();
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("Белгісіз себепке байланысты қате орын алды.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    $('html,body,.modal').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })
    })
</script>