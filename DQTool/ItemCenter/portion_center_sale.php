<?php 
    // 地元ゲームコラボ記念なので機能実装→リファクタの順番でやっている    

    // 集計開始メッセージ
    logInformation("ポーション管理局です");
    logInformation("札幌市大通りから報告を受け取りました");

    // 実行時の前日を取り出して、薬局側は手動で実行しないようにする

    // ポーションセンターの各種支店から、当日のポーション売上一覧を取得する
    $myPath = __FILE__;              
    $dirpath = dirname($myPath);
    // ポーションは以下のような構造を持つ予定
    // name.... 売った人の名前
    // hour.... 売却した時間帯(お昼の12時は12 23時は23 )
    // num .....該当した人がポーションを売った時間帯
    $fp = fopen(sprintf("%s/report_dir/sale_report_%s.csv", $dirpath, makeNowStatDate()), "w");
    $potion_sales = array(
        array(
            "name"=>"tawasiさん",
            "hour" => 12,
            "num" => 100,
            "present" => "おむつ",
        ),
        array(
            "name" => "riardさん",
            "num" => 20,
            "hour" => 15,
            "present" => "実験道具",
        ),
        array(
            "name"=>"tawasiさん",
            "hour" => 17,
            "num" => 50,
            "present" => "ゴールド",
        ),
        array(
            "name" => "でゅんさん",
            "hour" => 18,
            "num" => 100,
            "present" => "ねぎやんの色紙",
        ),

    );

    // 集計完了結果をメッセージで出す
    if (count($potion_sales) > 0) {
        logInformation(sprintf("おお、報告が %d 件 もあるではないかー", count($potion_sales)));
    }
    logInformation("うむ、それでは、確認をしていくぞ");
    $saler_nums = array();
    foreach ($potion_sales as $potion_sale_data) {
        makeSaleReport($potion_sale_data);
        $potion_sale_data["num"];
        if (!isset($saler_nums[$potion_sale_data["name"]])) {
            // 新しい売り上げがあったら設定をする
            $saler_nums[$potion_sale_data["name"]] = array(
                "name" => $potion_sale_data["name"],
                "num" => 0
            );
        }
        // 売上を加算
        $saler_nums[$potion_sale_data["name"]]["num"] += $potion_sale_data["num"];
    }

    // レポート情報を出力する
    // 担当者名と合計数量を記載しておく
    fputcsv($fp, array("名前", "ポーション売ったかず"));
    foreach ($saler_nums as $saler_num) {
        fputcsv($fp, $saler_num);
    }



    // 集計完了メッセージ
    logInformation("ポーション管理局の集計を完了いたしました");


    // 合計量を計算
    function makeResultMessage($total_num) {
        $total_message = sprintf("%d", $total_num);
        logInformation($total_message);
    }

    function makeSaleReport($potion_sale_data) {
        logInformation("ふむ、" );
        $report_message = sprintf("%s は %d 時にはたらいておったんじゃな", $potion_sale_data["name"], $potion_sale_data["hour"]);
        logInformation($report_message);

        logInformation("売上を確認したぞ。　");
        $finish_message = sprintf("希望は %s であったな　送っておくぞ", $potion_sale_data["present"]);
        logInformation($finish_message);

    }


   /*
     以下、最終的なクラス構成イメージ
         log...実行時文言用の基本処理をまとめたもの
         export..薬局や介護施設での実行結果のエクスポート先連携
         job.....実行日時を記載したファイル
         date....日付情報管理
    */
    function logInformation($message) {
        $result_message = sprintf("%s : %s\r\n", makeNowDate(), $message);
        echo($result_message);
        // 息切れしないように間を開ける
        sleep(5);
    }

    function makeNowStatDate() {
        return date('Ymd');

    }


    function makeNowDate() {
        return date('Y-m-d H:i:s');
    }

?>