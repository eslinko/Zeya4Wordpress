<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!--connect Montserrat google font-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        .wrap {
            width: 536px;
            background-image: url("https://viralhelp.me//wp-content/plugins/Zeya4Wordpress/assets/images/email_bg.png");
            margin: 0 auto;
            border-radius: 32px;
            padding: 32px 32px 80px;
            box-sizing: border-box;
        }
        .logo-img {
            text-align: center;
            margin-bottom: 24px;
        }
        .logo-img img {
            width: 120px;
            height: 120px;
        }
        .text-wrap {
            text-align: center;
            color: #261B54;
            font-family: Montserrat;
            font-size: 22px;
            font-style: normal;
            font-weight: 500;
            line-height: 140%; /* 30.8px */
        }
        .text-wrap a {
            color: #8100E7;
            text-decoration: underline;
        }
        .text-wrap.invitation-code {
            color: #7E00E2;
            font-size: 28px;
            font-weight: 700;
        }
    </style>
</head>
<body>
<?php
if(empty($data)){
    //mockup data
    $data = [
        'lovestar_reason' => 'test reason',
        'lovestar_count' => 10,
        'invitation_code' => 'SWQ-SAQ-AWS-SFA',
    ];
}
?>

<div style="width: 100%;">
    <div class="wrap">
        <div class="logo-img">
            <img
                src="https://viralhelp.me/wp-content/plugins/Zeya4Wordpress/assets/images/zeya_logo.png"
                alt=""
            >
        </div>

        <div class="text-wrap" style="margin-bottom: 16px;">
            <?php echo sprintf(__('We\'re thrilled to let you know that due to %s, you\'ve earned %s Lovestars!', VH2ZEYA4EVE_TEXTDOMAIN), $data['lovestar_reason'], $data['lovestar_count'])?>
        </div>

        <div class="text-wrap" style="margin-bottom: 8px;">
            <?php echo __('Your unique invitation code is:', VH2ZEYA4EVE_TEXTDOMAIN)?>
        </div>

        <div class="text-wrap invitation-code" style="margin-bottom: 16px;">
            <?php echo $data['invitation_code']?>
        </div>

        <div class="text-wrap" style="margin-bottom: 8px;">
            <?php echo sprintf(__('If you haven’t created an account on %s yet, please use the invitation code above. You’ll be asked for this code during registration.', VH2ZEYA4EVE_TEXTDOMAIN), '<a href="http://Zeya4Eve.io">http://Zeya4Eve.io</a>')?>
        </div>

        <div class="text-wrap">
            <?php echo sprintf(__('Already registered? Awesome! Simply head to the "My Lovestars" section in the Telegram chatbot %s. Utilize the "Claim my Lovestars" option. Enter your unique code, and your new Lovestars will be automatically added to your account. %s
Through the Zeya4Eve platform, you’ll be able to find like-minded people and support each other.', VH2ZEYA4EVE_TEXTDOMAIN), '<a href="https://t.me/Zeya4eve_bot">@zeya4eve_bot</a>', '<br>')?>
        </div>
    </div>
</div>

</body>
</html>