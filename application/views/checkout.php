<?php

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
?>


<body>

<section class="content" style="margin-top: 55px;padding: 0; background: url(<?php echo base_url('img/bg/credit_bg.jpg')?>) no-repeat; background-size: cover; min-height: 720px">

    <div class="container-fluid">

        <div class="col-sm-6 col-sm-offset p-20" style="background: #fff;min-height: 550px">

            <header class="main">

                <div class="notice-wrapper">
                    <?php if(isset($_SESSION["errors"])) : ?>
                        <div class="show notice error notice-error">
                    <span class="notice-message">
                        <?php
                        echo($_SESSION["errors"]);
                        unset($_SESSION["errors"]);
                        ?>
                        <span>
                        </div>
                    <?php endif; ?>
                </div>
            </header>
            <header>
                <h4 class="f-bitter">Confirm and Make Payment<br></h4>
                <p>
                    You have chosen to purchase <?php echo $creditU .' Credit Points' ?>
                </p>
            </header>

            <table class="table">

                <thead>
                <tr class="text-center f-s-18">
                    <td>Credit Point (CP)</td>
                    <td>Price Per Point</td>
                    <td>Total Price (£)</td>
                </tr>
                </thead>
                <tbody>
                <tr class="text-center f-s-18">
                    <td><?php echo $creditU ?></td>
                    <td><?php echo $pricePerUnit ?></td>
                    <td class="text-red"><?php echo '£'.$creditPrice ?></td>
                </tr>
                </tbody>
            </table>

            <?php echo form_open('upgrade/payout',array('id'=>'payment-form'))?>
            <section>
                <label for="amount">

                    <div class="form-group amount-wrapper">
                        <input id="amount" name="amount" class="form-control" type="hidden" min="1" placeholder="Amount" hidden value="<?php echo $creditPrice ?>">
                    </div>
                </label>

                <div class="bt-drop-in-wrapper">
                    <div id="bt-dropin"></div>
                </div>
            </section>

            <input id="nonce" name="payment_method_nonce" type="hidden" />
            <button class="btn btn-danger btn-lg no-border-radius" type="submit"><span>Make Payment <?php echo '(£'.$creditPrice.')' ?> </span></button>
            <?php form_close()?>
        </div>

    </div>
</section>


<script src="<?php echo base_url()?>/js/dropin.min.js"></script>
<script>
    var form = document.querySelector('#payment-form');
    var client_token = "<?php echo($gateway->ClientToken()->generate()); ?>";

    braintree.dropin.create({
        authorization: client_token,
        selector: '#bt-dropin',
        paypal: {
            flow: 'vault'
        }
    }, function (createErr, instance) {
        if (createErr) {
            console.log('Create Error', createErr);
            return;
        }
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            instance.requestPaymentMethod(function (err, payload) {
                if (err) {
                    console.log('Request Payment Method Error', err);
                    return;
                }

                // Add the nonce to the form and submit
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
            });
        });
    });
</script>
<script src="<?php echo base_url('js/demo.js')?>"></script>
