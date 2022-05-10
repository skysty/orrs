<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline card-primary rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title">Пойыздар тізімі</h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-sm btn-primary"><span class="fas fa-plus"></span>  Қосу</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="15%">
					<col width="20%">
					<col width="25%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-primary text-light">
						<th>#</th>
						<th>Құрылған Күні</th>
						<th>Пойыз #</th>
						<th>Аты</th>
						<th>Сыйымдылығы</th>
						<th>Әрекет</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `train_list` where delete_flag = 0 order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
							<td class=""><?php echo $row['code'] ?></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row['name'] ?></p></td>
							<td class="px-0">
								<div class="border-bottom"><span class="text-muted">Купе:</span> <b><?= number_format($row['first_class_capacity']) ?></b></div>
								<span class="text-muted">Плацкарт:</span> <b><?= number_format($row['economy_capacity']) ?></b>
							</td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Әрекет
				                    <span class="sr-only">Ашылмалы тізімді ауыстыру</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Өзерту</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Жою</a>
				                  </div>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
        $('#create_new').click(function(){
			uni_modal("Жаңа Пойыз Қосу","trains/manage_train.php")
		})
        $('.edit_data').click(function(){
			uni_modal("Пойыз туралы ақпаратты жаңарту","trains/manage_train.php?id="+$(this).attr('data-id'))
		})
		$('.delete_data').click(function(){
			_conf("Сіз бұл пойызды біржола жойғыңыз келетініне сенімдісіз бе?","delete_train",[$(this).attr('data-id')])
		})
		$('.view_data').click(function(){
			uni_modal("Пойыз туралы мәліметтер","trains/view_train.php?id="+$(this).attr('data-id'))
		})
		$('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
	})
	function delete_train($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_train",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("Қате орын алды.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("Қате орын алды.",'error');
					end_loader();
				}
			}
		})
	}
</script>