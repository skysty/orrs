<?php
if(isset($_GET['sid'])){
    $trains = $conn->query("SELECT *,Concat(code,' - ',`name`) as train FROM `train_list` where id in (SELECT train_id FROM `schedule_list` where delete_flag = 0 and id='{$_GET['sid']}')");
    $res = $trains->fetch_all(MYSQLI_ASSOC);
    $train_fcf_arr = array_column($res,'first_class_capacity','id');
    $train_ef_arr = array_column($res,'economy_capacity','id');
    $train_arr = array_column($res,'train','id');
    $qry = $conn->query("SELECT * from `schedule_list` where delete_flag = 0 and id='{$_GET['sid']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
                $$k = $v;
        }
    }else{
    echo '<script> alert("Белгісіз кесте идентификаторы.");location.replace("./?page=schedules") </script>';
    }
} else{
    echo '<script> alert("Бұл бетті қарау үшін кесте идентификаторы қажет.");location.replace("./?page=schedules") </script>';
}
$user_id = $_settings->userdata('id');
?>
<div class="content py-5">
    <div class="card rounded-0 card-outline card-primary shadow">
        <div class="card-header rounded-0">
            <h5 class="card-title">Брондау формасы</h5>
        </div>
        <div class="card-body rounded-0">
            <div class="callout border-primary rounded-0">
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <dl>
                            <dt class="text-muted">Кесте коды:</dt>
                            <dd class="pl-3"><b><?= isset($code) ? $code : 'N/A' ?></b></dd>
                            <dt class="text-muted">Жолу жүру кестесі:</dt>
                            <dd class="pl-3"><b><?= isset($date_schedule) && !is_null($date_schedule) ? date("M d, Y", strtotime($date_schedule)) : "Everday" ?> <?= isset($time_schedule) ? date("h:i A", strtotime($time_schedule)) : "--:-- --" ?></b></dd>
                        </dl>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <dl>
                            <dt class="text-muted">Кайдан:</dt>
                            <dd class="pl-3"><b><?= isset($route_from) ? $route_from : "N/A" ?></b></dd>
                            <dt class="text-muted">Кайда:</dt>
                            <dd class="pl-3"><b><?= isset($route_to) ? $route_to : "N/A" ?></b></dd>
                        </dl>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <dl>
                            <dt class="text-muted">Купе тарифі:</dt>
                            <dd class="pl-3"><b><?= isset($first_class_fare) ? $first_class_fare : '--.--' ?></b></dd>
                            <dt class="text-muted">Пласкарт тарифі:</dt>
                            <dd class="pl-3"><b><?= isset($economy_fare) ? $economy_fare : "--.--" ?></b></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <hr>
            <form action="" id="reserve-form">
                <input type="hidden" name="schedule_id" value=<?= isset($id) ? $id : "" ?>>
                <input type="text" name="user_id" value=<?= isset($user_id) ? $user_id : "" ?>>
                <input type="hidden" name="time" value=<?= isset($time_schedule) ? $time_schedule : "" ?>>
                <div class="form-group col-md-4 col-sm-6 <?= isset($date_schedule) && !is_null($date_schedule) ? 'd-none' : '' ?>">
                    <label for="date" class="form-group">Жоспар күні</label>
                    <input class="form-control form-control-sm rounded-0" type="date" name="date" id="date" required value="<?= isset($date_schedule) && !is_null($date_schedule) ? $date_schedule : '' ?>" min="<?= date("Y-m-d") ?>">
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <select class="form-control form-control-sm form-control-border" name="seat_type" required>
                                <option value="" disabled selected>Осы жерден таңдаңыз</option>
                                <option value="1">Купе</option>
                                <option value="2">Пласкарт</option>
                            </select>
                            <small class="text-muted mx-2">Орын түрі</small>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-sm form-control-border text-right" name="fare_amount" readonly>
                            <small class="text-muted mx-2">Жол ақы</small>
                        </div>
                    </div>
                </div> 
                <!-- List Group -->
                <div class="list-group" id="reserve-field">
                    <div class="list-group-item border reserve-item">
                        <div class="row">
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm form-control-border" name="firstname[]" required>
                                    <small class="text-muted mx-2">Аты</small>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm form-control-border" name="middlename[]" placeholder="(optional)">
                                    <small class="text-muted mx-2">Әкесінің аты</small>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-sm form-control-border" name="lastname[]" required>
                                    <small class="text-muted mx-2">Тегі</small>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group text-right">
                                    <button class="btn btn-danger btn-sm btn-flat btn-remove" type="button"><i class="fa fa-trash"></i> Жою</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-between my-2">
                    <div class="form-group">
                        <button class="btn btn-sm btn-info btn-flat" type="button" id="add_item"><i class="fa fa-plus"></i> Жолаушы қосу</button>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-sm btn-primary btn-flat">Орынды резервтеу</button>
                    </div>
                </div>
                <!-- List Group -->

            </form>
        </div>
    </div>
</div>

<script>
   function remove_passenger($this){
       if($('.reserve-item').length == 1){
           alert("Жолаушы мәліметтерін жою мүмкін емес. Брондау формасы үшін кемінде 1 жолаушы қажет.")
           return false;
       }
        $this.closest('.reserve-item').remove()
   }
   $(function(){
       $('[name="seat_type"]').change(function(){
            var type = $(this).val()
            if(type == 1){
                $('[name="fare_amount"]').val('<?= $first_class_fare ?>')
            }else{
                $('[name="fare_amount"]').val('<?= $economy_fare ?>')
            }
       })
       $('.btn-remove').click(function(){
            remove_passenger($(this))
        })
       $('#add_item').click(function(){
           var item = $('.reserve-item').first().clone();
            item.find('input').val('')
            $('#reserve-field').append(item)
            item.find('.btn-remove').click(function(){
                remove_passenger($(this))
            })
       })


        $('#reserve-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_reservation",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("Қате пайда болды",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        // alert_toast("Success",'success')
                        location.href = "<?php echo base_url ?>admin/?page=tickets&ids="+resp.ids
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
                    $('html,body').animate({scrollTop:0},'fast')
                    end_loader();
                }
            })
        })

   })
    
</script>