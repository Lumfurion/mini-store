<?php 
    require_once '../php/classes/CartRepository.php';
    require_once '../php/connect.php';

    // Создание репозитория и получение заказов
    $CartRepository = new CartRepository($pdo);
    // id для теста
    $orders = $CartRepository->GetOrderDetails(2);
    
    // Получаем количество заказов и общую цену
    $orderCount = count($orders);
    $orderTotalPrice = $orderCount ? $orders[0]['order_total_price'] : 0;
?>
<header>
    <div class="container_width">
        <div class="header_content">
            <div class="logo_container">
                <a class="logo">uniclub</a>
                <nav>
                    <ul>
                        <li><a href="index.php">Home</a></li>
                        <li><a href="catalog.php">Shop</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </nav>
            </div>
            <div class="controls">
                <a href="account.php"><i class="ri-user-fill"></i></a>
                <a href="#"><i class="ri-heart-fill"></i></a>
                <a href="#" id="cart-icon"><i class="ri-shopping-cart-2-fill"></i></a>
            </div>
        </div>
    </div>
</header>

<div class="cart_open" id="cart_open">
    <div class="header_cart">
        <p class="title">Your Cart</p>
        <p class="count"><?= $orderCount ?></p>
    </div>

    <div class="product_list">
        <?php if ($orderCount === 0): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Discount Price</th>
                        <th>Total Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                        <tr class="item_product">
                            <td><?= htmlspecialchars($order['product_name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($order['color_name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($order['size_name'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($order['quantity'], ENT_QUOTES, 'UTF-8') ?></td>
                            <td><?= htmlspecialchars($order['price'], ENT_QUOTES, 'UTF-8') ?>$</td>
                            <td><?= $order['discount_price'] ? htmlspecialchars($order['discount_price'], ENT_QUOTES, 'UTF-8') . '$' : 'No discount' ?></td>
                            <td><?= htmlspecialchars($order['total_price'], ENT_QUOTES, 'UTF-8') ?>$</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="total_price">
                <p class="title">Order Total (USD)</p>
                <p class="price"><?= $orderTotalPrice ?>$</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($orderCount > 0): ?>
        <form action="#">
            <button class="btn_continue">Continue to Checkout</button>
        </form>
    <?php endif; ?>
</div>

<div class="blackout" id="blackout"></div>
