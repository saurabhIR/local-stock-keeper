
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock Keeper</title>
  <link rel="icon" type="image/x-icon" href="/image/SQuora.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="/css/feed.css">
  <link rel="stylesheet" href="/css/feed-new.css">
</head>
<body>
  <header>
    <div class="container">
      <nav class="flex-justify-between">
        <div class="head-left">
          <a href="/Feed/view"><img src="/image/stock-keeper.jpg" alt="logo"></a>
        </div>
        <div class="head-right">
		      <button><a href="/Feed/view">Show Stocks</a></button>
          <a href="/Userprofile/create"><i class="fa-solid fa-user"></i></a>
        </div>
      </nav>
    </div>
  </header>
  <main>
    <div class="container">
      <section class="feed-questions">
        <form action="/Edit/create?id=<?php echo $row['stocks_id'];?>" method="POST">
          <label for="stock_name">Stock Name:</label>
          <input type="text" id="stock_name" name="stock_name" value="<?php echo $row['stock_name'];?>" required>
          <br>

          <label for="stock_price">Stock Price:</label>
          <input type="number" id="stock_price" name="stock_price" step="0.01" value="<?php echo $row['stock_price'];?>" required>
          <br>
          <div class="flex-justify-centre">
            <button class="ask-question" type="submit">Edit Stock</button>
          </div>
        </form>
      </section>
    </div>
  </main>
</body>
</html>