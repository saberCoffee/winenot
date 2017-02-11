<?php $this->layout('layout_dashboard', ['title' => $product['name'] . ' ' . $product['millesime']]) ?>
<?php $this->start('main_content') ?>

<section>


<div id="productDetails">

<table class="table table-striped">

  <tbody>
    <tr>
      
      <td>Mark</td>
      <td>Otto</td>

    </tr>
    <tr>
      
      <td>Jacob</td>
      <td>Thornton</td>

    </tr>
    <tr>
      
      <td>Larry</td>
      <td>the Bird</td>
 
    </tr>
  </tbody>
</table>
</div>


</section>

<?php
debug($product);

?>

<?php $this->stop('main_content') ?>
