
<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);

include 'connectdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['item_name']) && isset($_POST['price'])) {
	if (!$isLoggedIn) {
		header("Location: login.php");
		exit();
	}

	$userId = $_SESSION['user_id'];
	$item = $_POST['item_name'];
	$price = $_POST['price'];

	$check = $connect->prepare("SELECT id, quantity FROM cart WHERE user_id = ? AND item_name = ?");
	$check->bind_param("is", $userId, $item);
	$check->execute();
	$result = $check->get_result();

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$newQty = $row['quantity'] + 1;

		$update = $connect->prepare("UPDATE cart SET quantity = ? WHERE id = ?");
		$update->bind_param("ii", $newQty, $row['id']);
		$update->execute();
		$update->close();
	} else {
		$insert = $connect->prepare("INSERT INTO cart (user_id, item_name, price, quantity) VALUES (?, ?, ?, 1)");
		$insert->bind_param("isd", $userId, $item, $price);
		$insert->execute();
		$insert->close();
	}

	$check->close();
	header("Location: menu.php");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en-UK">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Not So Fast Food • Menu</title>
	<link rel="icon" href="./logo.png">
	<link rel="stylesheet" href="./style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
</head>

<body>
	<div id="header" style="border-bottom: none; box-shadow: 0 3px 6px #555555ac;">
		<a href="./home.php">
            <img id="logo" src="./logo.png" alt="logo">
            <p class="headerTxt">Not So Fast Food</p>
        </a>
        <div id="menuButtons">
            <a href="./home.php"><button class="menuBtn"><i class="ti ti-home"></i> Home</button></a>
            <a href="./menu.php"><button class="menuBtn activePage"><i class="ti ti-chef-hat-filled"></i> Menu</button></a>
            <?php if ($isLoggedIn): ?>
                <a href="./logout.php"><button class="menuBtn"><?php echo htmlspecialchars($_SESSION['user_name']); ?> <i class="ti ti-logout"></i></button></a>
            <?php else: ?>
				<a href="./login.php"><button class="menuBtn"><i class="ti ti-user"></i> Login</button></a>
            <?php endif; ?>
        </div>
	</div>
	<?php if ($isLoggedIn): ?>
	<h2 id="bodyHeading" style="margin-left: 40px;">Menu</h2>
	<div class="receipt">
    <h4 class="receiptHeading">
        <?php echo htmlspecialchars($_SESSION['user_name']); ?>'s Cart 
        <i class="ti ti-shopping-cart-filled"></i>
    </h4>

    <?php
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $stmt = $connect->prepare("SELECT id, item_name, price, quantity FROM cart WHERE user_id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<div style='border: solid 2px var(--blue); border-radius: 9px !important;'><table class='cartTable'>
						<thead>
							<tr>
								<th>Item</th>
								<th>Qty</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>";

            $total = 0;
            while ($row = $result->fetch_assoc()) {
                $itemId = $row['id'];
                $item = htmlspecialchars($row['item_name']);
                $qty = $row['quantity'];
                $price = $row['price'];
                $subtotal = $qty * $price;
                $total += $subtotal;

                echo "<tr>
                        <td>$item</td>
                        <td>
                            <form method='POST' action='update_cart.php' style='display:inline-block;'>
                                <input type='hidden' name='cart_id' value='$itemId'>
                                <input type='hidden' name='action' value='decrease'>
                                <button type='submit'>-</button>
                            </form>
                            $qty
                            <form method='POST' action='update_cart.php' style='display:inline-block;'>
                                <input type='hidden' name='cart_id' value='$itemId'>
                                <input type='hidden' name='action' value='increase'>
                                <button type='submit'>+</button>
                            </form>
                        </td>
                        <td>".number_format($price, 2)."</td>
                      </tr>";
            }

            echo "</tbody></table>";
            echo "<hr><div style='padding:0 8px 4px 8px;'><span style='font-weight: bold; margin: 4px;'>Total:</span><span style='font-weight: bold; float: right;'>Ksh " . number_format($total, 2) . "</span></div></div>";
        } else {
            echo "<p>Your cart is empty.</p>";
        }

        $stmt->close();
    } else {
        echo "<p>Please <a href='login.php'>log in</a> to view your cart.</p>";
    }
    ?>
</div>
	<div id="divMenu" style="margin-left: 40px;width: 69%;">
	<?php else: ?>
		<h2 id="bodyHeading" style="margin-left: 185px;">Menu</h2>
		<div id="divMenu">
	<?php endif; ?>
		<table>
			<tr>
				<th>No.</th>
				<th>Image</th>
				<th>Description</th>
			</tr>
			<tr>
				<td class="foodNo">1.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 8.jpeg" alt="Dish 1"></td>
				<td class="foodTitle">Pizza
					<br>
					<span class="foodDesc">A delightful, oven-baked flatbread topped with a savory blend of
						sauce,
						cheese, and
						various toppings.</span>
					<br>
				<form method="POST" action="menu.php">
					<input type="hidden" name="item_name" value="Pizza">
					<input type="hidden" name="price" value="1199">
					<button type="submit" id="cartBtn">Add to Cart</button>
				</form>
				</td>
			</tr>
			<tr>
				<td class="foodNo">2.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 16.jpeg" alt="Dish 2"></td>
				<td class="foodTitle">Burger
					<br>
					<span class="foodDesc">A delicious sandwich consisting of a cooked patty, usually beef,
						placed
						inside a sliced bun, and often topped with cheese, lettuce, tomato, and
						condiments.</span>
					<br>
				<form method="POST" action="menu.php">
					<input type="hidden" name="item_name" value="Burger">
					<input type="hidden" name="price" value="649">
					<button type="submit" id="cartBtn">Add to Cart</button>
				</form>
				</td>
			</tr>
			<tr>
				<td class="foodNo">3.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 18.jpeg" alt="Dish 3"></td>
				<td class="foodTitle">Burger Meal
					<br>
					<span class="foodDesc">A classic, satisfying fast-food trio that combines crispy fries, a
						juicy
						burger, and a refreshing cola.</span>
					<br>
					<form method="POST" action="menu.php">
						<input type="hidden" name="item_name" value="Burger Meal">
						<input type="hidden" name="price" value="879">
						<button type="submit" id="cartBtn">Add to Cart</button>
					</form>
				</td>
			</tr>
			<tr>
				<td class="foodNo">4.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 17.jpeg" alt="Dish 4"></td>
				<td class="foodTitle">Chips/Fries
					<br>
					<span class="foodDesc">A crispy, golden strips of potatoes, often seasoned with salt, and
						perfect
						for snacking or as a side dish.</span>
					<br>			
				<form method="POST" action="menu.php">
					<input type="hidden" name="item_name" value="Chips/Fries">
					<input type="hidden" name="price" value="249">
					<button type="submit" id="cartBtn">Add to Cart</button>
				</form>
				</td>
			</tr>
			<tr>
				<td class="foodNo">5.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 7.jpeg" alt="Dish 5"></td>
				<td class="foodTitle">Salad
					<br>
					<span class="foodDesc">A fresh, nutritious mix of greens, vegetables, and often proteins,
						tossed
						together for a wholesome meal.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Salad">
    <input type="hidden" name="price" value="379">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">6.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 6.jpeg" alt="Dish 6"></td>
				<td class="foodTitle">Just Water
					<br>
					<span class="foodDesc">A simple, refreshing drink essential for staying hydrated.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Just Water">
    <input type="hidden" name="price" value="179">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">7.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 4.jpeg" alt="Dish 7"></td>
				<td class="foodTitle">Tea
					<br>
					<span class="foodDesc">A soothing drink made from steeped tea leaves or herbs, enjoyed hot
						or
						iced.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Tea">
    <input type="hidden" name="price" value="199">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">8.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 5.jpeg" alt="Dish 8"></td>
				<td class="foodTitle">Coffee
					<br>
					<span class="foodDesc">A rich, aromatic beverage brewed from roasted coffee beans, perfect
						for a
						caffeine boost.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Coffee">
    <input type="hidden" name="price" value="199">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">9.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 3.jpeg" alt="Dish 9"></td>
				<td class="foodTitle">Espresso
					<br>
					<span class="foodDesc">A strong, concentrated coffee shot brewed by forcing hot water
						through
						finely-ground coffee beans.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Espresso">
    <input type="hidden" name="price" value="199">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">10.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 2.jpeg" alt="Dish 10"></td>
				<td class="foodTitle">Hot Chocolate
					<br>
					<span class="foodDesc">A warm, velvety drink made from melted chocolate or cocoa powder
						mixed with
						milk or water, perfect for a cozy treat.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Hot Chocolate">
    <input type="hidden" name="price" value="199">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">11.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 14.jpeg" alt="Dish 11"></td>
				<td class="foodTitle">Fresh Juices
					<br>
					<span class="foodDesc">A refreshing drink made from the extraction of fruit or vegetable
						liquids,
						packed with natural flavors.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Fresh Juices">
    <input type="hidden" name="price" value="189">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">12.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 15.jpeg" alt="Dish 12"></td>
				<td class="foodTitle">Sodas
					<br>
					<span class="foodDesc">A fizzy, carbonated drink often sweetened and flavored, ideal for a
						refreshing treat.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Sodas">
    <input type="hidden" name="price" value="189">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">13.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 12.jpeg" alt="Dish 13"></td>
				<td class="foodTitle">Raspberry Cake
					<br>
					<span class="foodDesc">A luscious cake filled with fresh raspberries and a hint of
						tartness.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Raspberry Cake">
    <input type="hidden" name="price" value="229">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">14.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 13.jpeg" alt="Dish 14"></td>
				<td class="foodTitle">Rainbow Cake
					<br>
					<span class="foodDesc">A vibrant, multi-layered cake with colorful sponge layers and creamy
						frosting.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Rainbow Cake">
    <input type="hidden" name="price" value="239">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">15.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 11.jpeg" alt="Dish 15"></td>
				<td class="foodTitle">Molten Lava Cake
					<br>
					<span class="foodDesc">A rich, decadent chocolate cake with a gooey, molten center.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Molten Lava Cake">
    <input type="hidden" name="price" value="239">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">16.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 10.jpeg" alt="Dish 16"></td>
				<td class="foodTitle">Vanilla Muffin
					<br>
					<span class="foodDesc">A soft, moist muffin infused with the classic flavor of
						vanilla.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Vanilla Muffin">
    <input type="hidden" name="price" value="219">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
			<tr>
				<td class="foodNo">17.</td>
				<td><img class="foodImg" src="./Images/HEIF Image 9.jpeg" alt="Dish 17"></td>
				<td class="foodTitle">Chocolate Chip Cookies
					<br>
					<span class="foodDesc">A crisp, buttery cookies studded with delicious chocolate
						chips.</span>
					<br>
					
<form method="POST" action="menu.php">
    <input type="hidden" name="item_name" value="Chocolate Chip Cookies">
    <input type="hidden" name="price" value="189">
    <button type="submit" id="cartBtn">Add to Cart</button>
</form>

				</td>
			</tr>
		</table>
		<hr>
		<div id="tableFooter">
			<div>17 Items</div>
		</div>
	</div>
	<footer>
		<p>Aditya More • 193384 • DBIT-B • <a href="./contactus.php"><button class="menuBtn">Contact Us</button></a></p>
	</footer>
	<script>
	</script>
</body>


</html>