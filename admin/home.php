<h1>Қош келдіңіз <?php echo $_settings->info('name') ?></h1>
<hr class="border-info">
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-train"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Пойыздар саны</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `train_list` where delete_flag = 0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-info elevation-1"><i class="fas fa-calendar"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Күнделікті</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `schedule_list` where `type` = 1 and delete_flag=0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-primary elevation-1"><i class="fas fa-calendar-day"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Бір-реттік</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `schedule_list` where `type` = 2 and delete_flag=0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-gradient-light shadow">
            <span class="info-box-icon bg-gradient-teal elevation-1"><i class="fas fa-ticket-alt"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Брондаған жолаушылар</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `reservation_list` where  unix_timestamp(schedule) >= '".(time())."' ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>
<hr>
