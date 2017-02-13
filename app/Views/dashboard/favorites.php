<?php $this->layout('layout_dashboard', ['title' => 'Vos favoris']) ?>
<?php $this->start('main_content') ?>




<section class="backgroundColor">
	<table class="table table-striped">
	  <thead>
	    <tr> 
	      <th>Vins</th>
	      <th>Cépage</th>
	      <th>Username</th>
	    </tr>
	  </thead>
	  <tbody>
	    <tr>
	      
	      <td>Mark</td>
	      <td>Otto</td>
	      <td>@mdo</td>
	    </tr>
	    <tr>
	     
	      <td>Jacob</td>
	      <td>Thornton</td>
	      <td>@fat</td>
	    </tr>
	    <tr>
	     
	      <td>Larry</td>
	      <td>the Bird</td>
	      <td>@twitter</td>
	    </tr>
	  </tbody>
	</table>
</section>







<?php $this->stop('main_content') ?>

<?php $this->start('js') ?>
    <script src="<?= $this->assetUrl('js/forms.js') ?>"></script>
<?php $this->stop('js') ?>