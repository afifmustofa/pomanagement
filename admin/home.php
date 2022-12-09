<h2 class="text-dark">Welcome to <?php echo $_settings->info('name') ?></h2>
<hr class="border-dark">
<div class="row">
        
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-boxes"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Total P.O</span>
                <span class="info-box-number">
                  <?php 
                     $item = $conn->query("SELECT * FROM po_list where `id`")->num_rows;
                     echo number_format($item);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
           <!-- /.col -->
           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">P.O Diterima</span>
                <span class="info-box-number">
                  <?php 
                     $po_appoved = $conn->query("SELECT * FROM po_list where `status` =1 ")->num_rows;
                     echo number_format($po_appoved);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
           <!-- /.col -->
           <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">P.O Ditunda</span>
                <span class="info-box-number">
                  <?php 
                     $po_appoved = $conn->query("SELECT * FROM po_list where `status` =2 ")->num_rows;
                     echo number_format($po_appoved);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-file-invoice"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">P.O Ditolak</span>
                <span class="info-box-number">
                  <?php 
                     $po = $conn->query("SELECT * FROM po_list where `status` =2 ")->num_rows;
                     echo number_format($po);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
<div class="container">
  
</div>
