<!DOCTYPE html>
<html lang="ja">
  <head>
    <?php require_once __DIR__."/inc/head.html"; ?>
    <title>CC課題01</title>
  </head>
  <body>
    <header>
      <div class="header inner">
        <div class="flex">
          <div class="header-logo">
            <h1 class="header-seo">大阪で一番品揃がいいキャンプのお店</h1>
            <div class="header-title">
              <a href="/"><img src="./img/logo.png" width="165" alt=""></a>
            </div>
          </div>
          <div class="header-access">
            <p class="header-tel">TEL：<span>06-0000-0000</span></p>
            <p class="header-address">住所：大阪市浪速区大国2-2-22</p>
          </div>
        </div>
        <nav class="header-nav">
          <ul class="inner flex">
            <li><a href="/index.php">トップ</a></li>
            <li><a href="/items.php">商品一覧</a></li>
            <li><a href="#news">お知らせ</a></li>
            <li><a href="/faq.php">よくある質問</a></li>
            <li><a href="/access.php">アクセス</a></li>
            <li><a href="/contact.php">お問い合わせ</a></li>
          </ul>
        </nav>
      </div>
    </header>

    <div class="mv">
      <img src="/img/main.jpg" alt="">
    </div>
    
    <div class="inner">
      <section>
        <div class="section-ttl">
          <p>items</p>
          <h2>商品一覧</h2>
        </div>
        <div class="items flex">
          <div class="flex-content">
            <div class="flex-content-img">
              <img src="/img/items01.jpg" alt="">
            </div>
            <div class="flex-content-desc">
              <p class="flex-content-desc-ttl">テント</p>
              <p>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
            </div>
          </div>
          <div class="flex-content">
            <div class="flex-content-img">
              <img src="/img/items02.jpg" alt="">
            </div>
            <div class="flex-content-desc">
              <p class="flex-content-desc-ttl">寝袋</p>
              <p>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
            </div>
          </div>
          <div class="flex-content">
            <div class="flex-content-img">
              <img src="/img/items03.jpg" alt="">
            </div>
            <div class="flex-content-desc">
              <p class="flex-content-desc-ttl">グリル</p>
              <p>テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。テキストが入ります。</p>
            </div>
          </div>
        </div>
        <div class="button">
          <a href="/items.php">商品一覧へ</a>
        </div>
      </section>

      <section id="news">
        <div class="section-ttl">
          <p>news</p>
          <h2>お知らせ</h2>
        </div>
        <table class="news-tbl">
          <tbody>
            <tr>
              <th>2018.12.24</th>
              <td>新着情報がはいります。</td>
            </tr>
            <tr>
              <th>2018.12.24</th>
              <td>新着情報がはいります。</td>
            </tr>
            <tr>
              <th>2018.12.24</th>
              <td>新着情報がはいります。</td>
            </tr>
            <tr>
              <th>2018.12.24</th>
              <td>新着情報がはいります。</td>
            </tr>
          </tbody>
        </table>
        <div class="button">
          <a href="/news.php">お知らせ一覧へ</a>
        </div>
      </section>

    </div>

    <footer>
      <?php require_once __DIR__."/inc/footer.html"; ?>
    </footer>
  </body>
</html>