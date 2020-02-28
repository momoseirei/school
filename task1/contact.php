<!DOCTYPE html>
<html lang="ja">
    <head>
        <?php require_once __DIR__."/inc/head.html"; ?>
        <title>お問い合わせ | CC課題01</title>
    </head>
    <body>
        <header>
            <?php require_once __DIR__."/inc/header.html"; ?>
        </header>

        <div class="mv">
            <img src="/img/page-thum01.jpg" alt="">
        </div>
        
        <div class="inner">
            <section>
                <div class="section-ttl">
                    <p>contact</p>
                    <h2>お問い合わせ</h2>
                    <span>内容を入力の上、送信ボタンを押して下さい</span>
                </div>
                <div class="form-wrap">
                    <form action="" method="POST">
                        <table class="form-table">
                            <tbody>
                                <tr>
                                    <th><label for="username" class="required">名前</label></th>
                                    <td><div class="form-group">
                                        <input type="text" id="username" class="form-control" name="username" placeholder="山田 太郎" required>
                                    </div></td>
                                </tr>
                                <tr>
                                    <th><label for="email" class="required">メールアドレス</label></th>
                                    <td><div class="form-group">
                                        <input type="text" id="email" class="form-control" name="email" placeholder="mail@gmail.com" required>
                                    </div></td>
                                </tr>
                                <tr>
                                    <td><input type="radio" value="男" id="man" name="sex"><label for="man">男</label>
                                    <input type="radio" value="女" id="woman" name="sex"><label for="woman">女</label></td>
                                </tr>
                                <tr>
                                    <th><label for="item">お問い合わせ項目</label></th>
                                    <td><div class="form-group"><select id="item" class="form-control" name="item">
                                        <option value="選択肢01">選択肢01</option>
                                        <option value="選択肢02">選択肢02</option>
                                        <option value="選択肢03">選択肢03</option>
                                        <option value="選択肢04">選択肢04</option>
                                    </select></div></td>
                                </tr>
                                <tr>
                                    <th><label for="coment" class="required">コメント</label></th>
                                    <td><div class="form-group">
                                        <textarea class="form-control" name="coment" id="coment" rows="5"></textarea>
                                    </div></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="button">
                            <input type="submit" value="送信する">
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <footer>
            <?php require_once __DIR__."/inc/footer.html"; ?>
        </footer>
    </body>
</html>