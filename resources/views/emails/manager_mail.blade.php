<body>
    <p>
        {{ $mtManager->manager_name }}　様<br>
        wundou WEB発注システムへの登録が完了いたしました。
    </p>

    <p>
        ログインID：{{ $mtManager->ec_login_id }}<br>
        パスワード：{{ $raw_password }}
    </p>

    <p>https://wundoumember.com/ecuser/ よりログインいただけます。</p>

    <P>
        注意:このメールはシステムより自動送信しております。<br>
        本メールへの返信はご遠慮ください。
    </P>
</body>