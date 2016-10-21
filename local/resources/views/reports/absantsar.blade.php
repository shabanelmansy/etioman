<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

<table  class="table table-hover table-striped table-bordered responsive-utilities bulk_action jambo_table">

	<thead>
	<tr>
		<td colspan="7" style="text-align: center; font-size:30px;"> 
	<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?>كشف حضور والانصراف لبرنامج
	</td>

	<tr>
		<td colspan="7"> 
	<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?>فنيات اعداد البرنامج الارشاديه 
	</td>

	<tr>
		<td colspan="7"> 
	<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?>د.حسين الخزاعى
	</td>


	<tr>
		<td colspan="7"> 
	<?php echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';?>كشف حضور والانصراف لبرنامج
	</td>


	</tr>
		
</thead>
<tbody>


<tr class="headings">

			<th>  الرقم </th>
			<th> الاسم  </th>
			<th><?php echo '&nbsp;&nbsp;'."/".str_repeat('&nbsp;', 2)."/". str_repeat('&nbsp;', 2); ?> </th>
			<th><?php echo '&nbsp;&nbsp;'."/".str_repeat('&nbsp;', 2)."/". str_repeat('&nbsp;', 2); ?> </th>
			<th><?php echo '&nbsp;&nbsp;'."/".str_repeat('&nbsp;', 2)."/". str_repeat('&nbsp;', 2); ?> </th>
			<th><?php echo '&nbsp;&nbsp;'."/".str_repeat('&nbsp;', 2)."/". str_repeat('&nbsp;', 2); ?> </th>
			<th><?php echo '&nbsp;&nbsp;'."/".str_repeat('&nbsp;', 2)."/". str_repeat('&nbsp;', 2); ?> </th>
			
	</tr>
 
	@foreach($students as $student)
	<tr>
		<td>
			{{ $student->name_en }}
		</td>
		<td >
			 
		</td>
		<td>
			 
		</td>
		<td>
			 
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
		<td>
			
		</td>
		
	</tr>
		@endforeach
</tbody>
