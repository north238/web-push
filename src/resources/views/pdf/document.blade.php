<!DOCTYPE html>
<html lang="ja">

    <head>
        <meta charset="UTF-8">
        <title>見積書</title>
        <style>
            @font-face {
                font-family: 'ipag';
                font-style: normal;
                font-weight: normal;
                src: url('{{ storage_path('fonts/IPAfont/ipag.ttf') }}') format('truetype');
            }

            @font-face {
                font-family: 'ipag';
                font-style: bold;
                font-weight: bold;
                src: url('{{ storage_path('fonts/IPAfont/ipag.ttf') }}') format('truetype');
            }

            /* =================================================================
         * CSSリセットと基本設定
         * ================================================================= */
            * {
                box-sizing: border-box;
                margin: 0;
                padding: 0;
                width: 100%;
            }

            body {
                font-family: ipag;
                font-size: 14px;
                line-height: 1.6;
                color: #333;
                background-color: #fff;
            }

            .container {
                width: 100%;
                max-width: 600px;
                margin: 0 auto;
                padding: 30px;
            }

            /* =================================================================
         * 見積書全体のスタイル
         * ================================================================= */
            .invoice-title {
                font-size: 28px;
                font-weight: bold;
                text-align: center;
                margin-bottom: 8px;
            }

            .issue-date {
                text-align: center;
                color: #666;
                margin-bottom: 40px;
            }

            /* ヘッダー（宛先と発行者）のレイアウト */
            .invoice-header {
                overflow: hidden;
                /* floatの回り込み解除 */
                margin-bottom: 40px;
            }

            .recipient {
                float: left;
                width: 50%;
            }

            .recipient .company-name {
                font-size: 18px;
                border-bottom: 1.5px solid #333;
                padding-bottom: 4px;
                display: inline-block;
            }

            .sender {
                float: right;
                width: 40%;
                text-align: right;
            }

            .sender .sender-name {
                font-weight: bold;
            }

            /* 合計金額欄 */
            .total-amount-box {
                text-align: center;
                background-color: #f7f7f7;
                padding: 20px;
                border-radius: 8px;
                margin: 20px 0 40px 0;
            }

            .total-amount-box .label {
                font-size: 18px;
                font-weight: bold;
            }

            .total-amount-box .amount {
                font-size: 32px;
                font-weight: bold;
                letter-spacing: 1px;
            }

            .total-amount-box .tax-note {
                font-size: 14px;
                font-weight: normal;
            }

            /* 内容・明細 */
            .content-section .title {
                font-size: 18px;
                font-weight: bold;
                border-bottom: 1px solid #ccc;
                padding-bottom: 8px;
                margin-bottom: 12px;
            }

            .content-body {
                border: 1px solid #ddd;
                border-radius: 8px;
                padding: 16px;
                min-height: 150px;
                white-space: pre-wrap;
                word-wrap: break-word;
            }

            /* 備考欄 */
            .notes-section {
                margin-top: 40px;
                font-size: 12px;
                color: #555;
            }

            .notes-section ul {
                list-style-position: inside;
                padding-left: 10px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1 class="invoice-title">御見積書</h1>
            <p class="issue-date">発行日: {{ date('Y年m月d日') }}</p>

            {{-- 宛先と発行者情報 --}}
            <div class="invoice-header">
                {{-- 宛先（左側） --}}
                <div class="recipient">
                    <p class="company-name">{{ $company }} 御中</p>
                </div>
                {{-- 発行者（右側） --}}
                <div class="sender">
                    <p class="sender-name">発行者: {{ $name }}</p>
                    <p>（ここに発行者の住所や連絡先）</p>
                </div>
            </div>

            {{-- 金額 --}}
            <div>
                <p>下記の通りお見積り申し上げます。</p>
                <div class="total-amount-box">
                    <p class="label">合計金額</p>
                    <p class="amount">¥ 123,450- <span class="tax-note">(税込)</span></p>
                </div>
            </div>

            {{-- 内容 --}}
            <div class="content-section">
                <h2 class="title">件名・内容</h2>
                <div class="content-body">
                    {!! nl2br(e($body)) !!}
                </div>
            </div>

            {{-- 備考欄 --}}
            <div class="notes-section">
                <p>備考:</p>
                <ul>
                    <li>本見積書の有効期限は発行日より30日間とさせていただきます。</li>
                    <li>価格は全て税込み表示です。</li>
                </ul>
            </div>
        </div>
    </body>

</html>
