
<form action="index.php" method="post"> 
<input type="submit" class="button" name="action" value="tambahdata"/>
</form> 
<form action="index.php" method="post"> 
<input type="submit" class="button" name="action" value="viewdata"/>  
</form> 
<h2>List Data</h2>
<table border="1">
    <tr><th>NO</th><th>Variabel</th><th>Nilai</th><th>Variable</th><th>Nilai</th><th>Waktu</th></tr>
<?php
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
			case 'tambahdata':
                tambahdata();
                break;
			case 'viewdata':
                viewdata();
                break;
        }
	}
// Menambahkan Data
    function tambahdata() {
		$conn = mysqli_connect('localhost','root','','logdata_db');
		$open = fopen('databesaran.txt','r');
		while (!feof($open)) 
		{
			$getTextLine = fgets($open);
			$explodeLine = explode(",",$getTextLine);
			list($volt_name,$volt_data,$curr_name,$curr_data,$time) = $explodeLine;
			$qry = "insert into datalog 
			(`volt_name`,`volt_data`,`curr_name`,`curr_data`,`time`) 
			values('".$volt_name."','".$volt_data."','".$curr_name."','".$curr_data."','".$time."')";
			mysqli_query($conn,$qry);
		}
		fclose($open);
        exit;
	}
	
// Menampilkan data
    function viewdata() {
		include 'koneksi.php';
    	$datalog = mysqli_query($koneksi, "SELECT * from datalog");
    	$no=1;
    	foreach ($datalog as $row){
        // $jenis_kelamin = $row['jenis_kelamin']=='P'?'Perempuan':'Laki laki';
        echo "<tr>
            <td>$no</td>
            <td>".$row['volt_name']."</td>
            <td>".$row['volt_data']."</td>
            <td>".$row['curr_name']."</td>
			<td>".$row['curr_data']."</td>
			<td>".$row['time']."</td>
              </tr>";
        $no++;
    }
        exit;
    }
?>
</table>