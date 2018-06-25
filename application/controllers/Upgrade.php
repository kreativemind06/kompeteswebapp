<?php
/**
 * Created by PhpStorm.
 * User: prudent
 * Date: 29-Apr-18
 * Time: 8:06 PM
 */

class Upgrade extends CI_Controller{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(array('url', 'form'));
        $this->load->library(array('session', 'form_validation'));
        $this->load->database();
    }



    public function index(){


        if(!isset($_SESSION['userLogginID'])){
            redirect(base_url('login?redirect=upgrade'));
        }

        else{

            require_once('action/fetch_user.php');


            $data['title']="Subscribe";
            $data['Success']="";

            $this->load->view("template/header",$data);
            $this->load->view("upgrade", $data);
            $this->load->view("template/footer",$data);

        }
    }


    public function checkout(){

        if(isset($_SERVER['REQUEST_METHOD']) == 'POST' && isset($_SESSION['userLogginID'])){

            $creditUnit = $this->input->post('unit');

            if(!empty($creditUnit)){


                $this->db->where("credit_unit='$creditUnit'");
                $getCredit = $this->db->get('credit_price')->result();

                foreach($getCredit as $creditDetails){

                    $data['creditU'] = $creditDetails->credit_unit;
                    $data['pricePerUnit'] = $creditDetails->price_per_credit;
                    $data['creditPrice'] = $creditDetails->credit_price;
                    $data['creditStatus'] = $creditDetails->status;

                }

                require_once("action/fetch_user.php");
                //require_once("./includes/braintree_init.php");
                $data['title'] =  "Checkout ". $data['creditPrice'];
                $data['successs'] = "";
                $data['error'] = "";


                if($this->form_validation->run() == false) {
                    $this->load->view("template/header", $data);
                    $this->load->view("checkpay", $data);
                    //$this->load->view("checkout", $data);
                    $this->load->view("template/footer", $data);
                }


            }
            else{

                $success = "<div class='alert alert-danger'>Please selected the amount of unit you want to subscribe <a class='close' data-dismiss='alert'>x</a> </div>";

            }
        }
        else{
            redirect(base_url('login?redirect=upgrade'));
        }

    }

    public function payout(){

        require_once("./vendor/autoload.php");

        if(file_exists(__DIR__ . "/../.env")) {
            $dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
            $dotenv->load();
        }

        $gateway = new Braintree\Gateway([
            'environment' => 'production',
            'merchantId' => 'cwkjm2k88qyk4wxz',
            'publicKey' => 'x74r6tx4npf4m6gn',
            'privateKey' => '2518f4aac1e4ac5ed89bd7f9b7c436bf'
        ]);


        $amount = $_POST["amount"];
        $nonce = $_POST["payment_method_nonce"];

        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success || !is_null($result->transaction)) {
            $transaction = $result->transaction;
            header("Location: transaction?id=" . $transaction->id);
        } else {
            $errorString = "";

            foreach($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }

            $_SESSION["errors"] = $errorString;
            header("Location: index.php");
        }
    }



    public function transaction(){
        if(!isset($_SESSION['userLogginID'])){
            redirect(base_url('login?redirect=upgrade/transaction?id='.$_GET['id']));
        }
        else {
            if (isset($_GET['id'])) {

                //4111 1111 1111 1111
                $transactionID = $_GET['id'];
                $data['title'] = "";

                    require_once('action/fetch_user.php');
                    require_once('action/time_function.php');

                require_once("./vendor/autoload.php");

                if (file_exists(__DIR__ . "/../.env")) {
                    $dotenv = new Dotenv\Dotenv(__DIR__ . "/../");
                    $dotenv->load();
                }

                $gateway = new Braintree\Gateway([
                    'environment' => 'production',
                    'merchantId' => 'cwkjm2k88qyk4wxz',
                    'publicKey' => 'x74r6tx4npf4m6gn',
                    'privateKey' => '2518f4aac1e4ac5ed89bd7f9b7c436bf'
                ]);

                $data['gateway'] = $gateway;

                $data['transaction'] = $gateway->transaction()->find($_GET["id"]);


                $transactionSuccessStatuses = [
                    Braintree\Transaction::AUTHORIZED,
                    Braintree\Transaction::AUTHORIZING,
                    Braintree\Transaction::SETTLED,
                    Braintree\Transaction::SETTLING,
                    Braintree\Transaction::SETTLEMENT_CONFIRMED,
                    Braintree\Transaction::SETTLEMENT_PENDING,
                    Braintree\Transaction::SUBMITTED_FOR_SETTLEMENT
                ];

                $amount = $data['transaction']->amount;



                //get transaction data
                $transaction_amount = ceil($data['transaction']->amount);
                $this->db->where("credit_price ='$transaction_amount'");
                $getCreditUnit = $this->db->get('credit_price')->result_array();
                foreach($getCreditUnit as $creditUnit);

                //check if the transaction id already inserted

                $this->db->where("transaction_id ='$transactionID'");
                $countTrans = $this->db->count_all_results('transactionx');

                if($countTrans <=0) {

                    $interTransaction = array(
                        'username' => $data['username'],
                        'user_id' => $_SESSION['userLogginID'],
                        'transaction_id' => $transactionID,
                        'transaction_status' => $data['transaction']->status,
                        'amount' => $data['transaction']->amount,
                        'total_unit' => $creditUnit['credit_unit'],
                        'date' => $data['transaction']->updatedAt->format('Y-m-d H:i:s'),
                    );
                    $this->db->insert('transactionx', $interTransaction);
                }

                //Success Transaction

                if (in_array($data['transaction']->status, $transactionSuccessStatuses)) {
                    $data['header'] = '<h1 class="f-s-22 text-center text-green f-bitter"> <img src="'. base_url('img/icons/svg/success.svg'). '" class="m-b-20"><br> Transaction SuccessFull</h1>';
                    $data['icon'] = "success";
                    $data['message'] = "<p class='text-center m-t-25 f-s-14 f-ubuntu'> Your transaction was Successful !!. Check below to see the details of your transaction  " . "</p>";

                    //Update the user balance
                    $username =$data['username'];
                    $user_ID = $_SESSION['userLogginID'];

                    $this->db->where("user_id = '$user_ID'");
                    $countSubscriber =$this->db->count_all_results("credit_subscription");

                    if($countSubscriber >=1 AND $countTrans <=0){
                        $this->db->where("user_id='$user_ID'");
                        $this->db->update('credit_subscription', array('credit'=> $creditUnit['credit_unit'] + $data['creditUnit']));
                    }

                    elseif($countTrans <=0){
                        //insert new subscriber

                        $insertSubscriber = array(
                            'username'=> $username,
                            'user_id'=> $user_ID,
                            'email' =>  $data['userEmail'],
                            'credit'=> $data['transaction']->amount,
                            'subscription_date'=>$data['transaction']->updatedAt->format('Y-m-d H:i:s'),
                        );
                        $this->db->insert("credit_subscription", $insertSubscriber);
                    }


                    //notify the user

                    $insertNotification = array(

                        array(
                            'message'=>"You have successfully subscribed for ". $creditUnit['credit_unit'] .' credit point at the rate of £'. $amount,
                            'link'=> base_url('transaction/check/'.$transactionID),
                            'user_id' => $_SESSION['userLogginID'],
                            'date'=> date('Y-m-d'),
                        ),
                        array(
                            'message'=>$data['username'] ." has successfully subscribed for ". $creditUnit['credit_unit'] .' credit point at the rate of £'. $amount,
                            'link'=> base_url('transaction/check/'.$transactionID),
                            'user_id' => 'Admin',
                            'date'=> date('Y-m-d'),
                        )
                    );


                    $this->db->insert_batch('notificationx', $insertNotification );

                    //send mail







                }
                else {
                    $data['header'] = '<h1 class="f-s-22 text-center text-red f-bitter"><img src="'. base_url('img/icons/svg/fail.svg'). '" class="m-b-20"><br> Transaction Failed</h1>';
                    $data['icon'] = "fail";
                    $data['message'] = "<p class='text-center m-t-25 f-s-14 f-ubuntu'> Your last transaction has Failed, Make sure you have sufficient balance on your debit card; Check below for more Information " . "</p>";

                }

                $this->load->view('template/header', $data);
                $this->load->view('transaction');
                $this->load->view('template/footer', $data);
            }
            else {


                die('Oops');
            }
        }


    }
}