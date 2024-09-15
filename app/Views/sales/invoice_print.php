<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>SaimTech</title>
  <link rel="stylesheet" href="<?= URL ?>assets/css/normalize.css">
  <link rel="stylesheet" href="<?= URL ?>assets/css/paper.css">
  <script src="http://logisticasaan365.com/pos/js/jquery-3.7.1.min.js"></script>
  <style>
    @page { size: portrait }
    body.receipt .sheet { width: 58mm !important; height: 50mm !important}
    @media print {
      body.receipt {
         width: 58mm
      } 
    }

    .nopm
    {
        padding: 1 1 1 1px;
        margin: 0 0 1 1px;
    }
    
    .nopmh
    {
        padding: 0 0 0 0px;
        margin: 0 0 0 0px;
    }
    
    .font
    {
      font-size: 11px;
    }

    .font-sm
    {
      padding-left: 2px;
      font-size: 10px;
    }

    .element {
      padding-right: 0px;
      padding-left: 50px;
}
  </style>
</head>
<script type="text/javascript">
    window.print();
</script>
<body class="receipt">
  <section class="sheet padding-10mm">
      <hr>
    <center>
        <h4 class="nopmh" id="shop-name-span"> Khokhar book depot</h4>
        <p class="nopmh font" id="shop-detail-span"> Khokhar book depot</p>
    </center>
    <hr>
    <p class="nopm font"><b> Invoice number#:</b> <span id="invoice-span"><?= $invoice_detail[0]->invoice_code ?></span></p>
    <p class="nopm font"><b> Date time:</b> <span id="date-span"><?= $invoice_date ?></span></p>
    <p class="nopm font"><b> Payment mode:</b> <span id="paym-span"><?= $payment_mode ?></span></p>
    <p class="nopm font"><b> Customer detail:</b> <span id="customer-span"></span></p>
    <table border="1" width="99%" id="bill-table">
      <thead>
      <tr>
        <th class="font" width="8%">Sr</th>
        <th class="font" width="50%">Item</th>
        <th class="font" width="15%">Price</th>
        <th class="font" width="10%">Qty</th>
        <th class="font" width="10%">Disc</th>
        <th class="font" width="18%">Total</th>
      </tr>
      </thead>
      <tbody  id="bill-table-body">
        <?php if($invoice_detail):
            $i= 0;
            $total_price = $total_discount = $total_net_price = 0;
            ?>
            <?php foreach($invoice_detail as $row):
                $i++;
                ?>
                <tr class="font">
                    <td><center></center><?= $i ?></center></td>
                    <td class='font-sm'><?= $row->item_name ?></td>
                    <td class='font-sm'>
                        <center>
                            <?php
                                $price = $row->price +0; 
                                $total_price+= $row->price; 
                                echo $price;
                             ?>
                        </center>
                    </td>
                    <td><center><?= $row->quantity ?></center>
                    <td>
                        <center>
                            <?php
                                $discount = $row->discount + 0; 
                                $total_discount+= $row->discount; 
                                echo $discount;
                             ?>
                        </center>
                    </td>
                    <td>
                        <center>
                            <?php
                                $net_price = $row->net_price + 0; 
                                $total_net_price+= $row->net_price; 
                                echo $net_price.'/-';
                             ?>
                        </center>
                    </td>
                </tr>

            <?php endforeach;?>
        <?php endif;?>
      </tbody>
      <tfoot>
        <tr class="font">
          <th colspan="5" class="element">Total amount</th>
          <td id="total-amount"><center><?= $total_price.'/-' ?></center></td>
        </tr>
        <tr class="font">
          <th colspan="5" class="element">Discount amount</th>
          <td id="discount-amount"><center><?= $total_discount.'/-' ?></center></td>
        </tr>
        <tr class="font">
          <th colspan="5" class="element">Net amount</th>
          <td id="net-amount"><center><?= $total_net_price.'/-' ?></center></td>
        </tr>
      </tfoot>
    </table>
    <center><p class="nopm font-sm"><b>Thank you for shopping.</p></center>
    <hr>
    <center><p class="nopm font"><b>Atta son's (Saimtech)</p></center>
  </section>
</body>