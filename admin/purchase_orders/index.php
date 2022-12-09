<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">List of Purchase Orders</h3>
		<div class="card-tools">
			<a href="?page=purchase_orders/manage_po" class="btn btn-flat btn-primary"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="20%">
					<col width="10%">
					<col width="15%">
					<col width="10%">
					<col width="5%">
				</colgroup>
				<thead>
					<tr class="bg-navy">
						<th>#</th>
						<th>Tanggal Dibuat</th>
						<th>PO #</th>
						<th>Supplier</th>
						<th>Jumlah Item</th>
						<th>Jumlah Total</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id order by unix_timestamp(po.date_updated) ");
						while($row = $qry->fetch_assoc()):
							$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
							$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
							<td class=""><?php echo $row['po_no'] ?></td>
							<td class=""><?php echo $row['sname'] ?></td>
							<td class="text-center"><?php echo number_format($row['item_count']) ?></td>
							<td> <?php echo number_format($row['total_amount']) ?></td>
							<td>
								<?php 
									switch ($row['status']) {
										case '1':
											echo '<span class="badge badge-success">Approved</span>';
											break;
										case '2':
											echo '<span class="badge badge-danger">Denied</span>';
											break;
										default:
											echo '<span class="badge badge-secondary">Pending</span>';
											break;
									}
								?>
							</td>
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Aksi
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
								  	<a class="dropdown-item" href="?page=purchase_orders/view_po&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item" href="?page=purchase_orders/manage_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
				                    <div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Supplier permanently?","delete_po",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Reservaton Details","purchase_orders/view_details.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.renew_data').click(function(){
			_conf("Are you sure to renew this rent data?","renew_rent",[$(this).attr('data-id')]);
		})
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
	})
	function delete_po($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_po",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
	function renew_rent($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=renew_rent",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>