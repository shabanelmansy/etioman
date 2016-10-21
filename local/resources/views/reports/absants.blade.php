<?
header('Content-Type:text/html; charset=UTF-8');
?>
<head>
<style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 5mm;
        margin: 10mm auto;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        
        height: 257mm;
        
    }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
	
	th, td {
		padding:2px;
        font-size:19px;
}
</style>
</head>
<body>
<div class="book">

    
   
    <div class="page">
        <table width="752" border="1"  cellpadding="0" cellspacing="0"  style="float:right;">
  <tr>
    <td width="10">الدرجه</td>
	<td width="440"><div align="right"></div></td>
    <td width="200"><div align="right">الاسم</div></td>
	
  </tr>
  <tr>
    <td></td>
	<td><div align="right"></div></td>
    <td><div align="right">الرقم الجامعى </div></td>
	
  </tr>
  
  <tr>
    <td></td>
	<td><div align="right"> </div></td>
    <td><div align="right"></div></td>
	
  </tr>
  <? } ?>
</table>
  </div>
 
   
    
</div> 
</body>
