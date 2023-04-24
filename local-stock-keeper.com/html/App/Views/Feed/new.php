
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
          <a href="#"><i class="fa-solid fa-user"></i></a>
        </div>
      </nav>
    </div>
  </header>
  <main>
    <div class="container">
      <section class="feed-questions">
        <form action="/Feed/create" method="POST">
          <label for="stock_name">Stock Name:</label>
          <input type="text" id="stock_name" name="stock_name" required>
          <br>

          <label for="stock_price">Stock Price:</label>
          <input type="number" id="stock_price" name="stock_price" step="0.01" required>
          <br>
          <div class="flex-justify-centre">
            <button class="ask-question" type="submit">Add Stock</button>
          </div>
        </form>
      </section>
      <section class="user-posts">
        <h3><?php echo $row[0]["email"];?> All of your Stocks</h3><br>
        <table>
          <tr><th>Stock Name</th><th>Stock Price</th><th>Created Date</th><th>Last Updated</th><th>Edit Entry</th><th>Remove Entry</th></tr>
          <?php foreach($row as $rows){ ?>
            <tr>
              <td><?php echo $rows["stock_name"];?></td>
              <td><?php echo $rows["stock_price"];?></td>
              <td><?php echo $rows["created_date"];?></td>
              <td><?php echo $rows["last_updated"];?></td>
              <?php if ($rows["email"] == $_SESSION['email']) {
                echo "<td><a href='/Feed/remove?id=" . $rows["stocks_id"] . "'>Remove</a></td>";
                echo "<td><a href='/Edit/new?id=" . $rows["stocks_id"] . "'>Edit</a></td>";
                } else {
                echo "<td></td>";
              } ?>
            </tr>
          <?php }?>
        </table>
      </section>
    </div>
  </main>
</body>
</html>