<?php 
include 'php/koneksi.php';

$post = file_get_contents('php://input');
  // log
  $time = date('Y-m-d H:i:s');
  $json_post = "MIDTRANS NOTIF==============================================================================="."\n".$time."\n".$post."\n"."===============================================================================================";
  $file_today = date("Y_m_d")."_log.txt";
  $myfile = fopen("midtrans.log", "a+") or die("Unable to open file!");
  fwrite($myfile,$json_post."\n");
  fclose($myfile);

  $callback = json_decode($post);
  if (isset($callback->order_id)) {
    
    // cek status
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL =>"https://api.sandbox.midtrans.com/v2/$callback->order_id/status",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: Basic U0ItTWlkLXNlcnZlci1YVG1aYnlVMC1RbmJOZjZEVzRlUWt5Z2M6'

      ),
    ));
    
    $response = curl_exec($curl);

    curl_close($curl);
    $result = json_decode($response);
    if (isset($result->order_id)) {
        $transaction = $result->transaction_status;
        $type = $result->payment_type;
        $order_id = $result->order_id;
        $fraud = $result->fraud_status;
        $transaction_time = $result->transaction_time;
        
        if ($transaction == 'capture') {
            // For credit card transaction, we need to check whether transaction is challenge by FDS or not
            if ($type == 'credit_card'){
              if($fraud == 'challenge'){
                    // TODO set payment status in merchant's database to 'Challenge by FDS'
                    // kemungkinan fraud, cancel aja/reject
                    // TODO merchant should decide whether this transaction is authorized or not in MAP\
                    $payment_status = -1;
                } else {
                    // TODO set payment status in merchant's database to 'Success'
                    $payment_status = 1;
                }
              }
        }else if ($transaction == 'settlement'){
            // TODO set payment status in merchant's database to 'Settlement'
            $payment_status = 3;
        }else if($transaction == 'pending'){
            // TODO set payment status in merchant's database to 'Pending'
            $payment_status = 2;
        } else if ($transaction == 'deny') {
            // TODO set payment status in merchant's database to 'Denied'
            $payment_status = -1;
        } else if ($transaction == 'expire') {
            // TODO set payment status in merchant's database to 'expire'
            $payment_status = -1;
        }else if ($transaction == 'cancel') {
            // TODO set payment status in merchant's database to 'Denied'
            $payment_status = -1;
        }
        
        $query = "UPDATE keranjang SET 
        status = '$payment_status'
        WHERE id_keranjang = $result->order_id";
        mysqli_query($conn, $query);
        
        echo json_encode(['status'=>'Success Update']);
    }
   
   
  }



?>