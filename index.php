<?php include __DIR__. '/partials/header.php'; 
// var_dump($hotels);
?>
<?php 
function filterHotelsByParking($hotels, $filterOption = 'all') {
    return array_filter($hotels, function ($hotel) use ($filterOption) {
        if ($filterOption === 'available') {
            return $hotel['parking'];
        } elseif ($filterOption === 'unavailable') {
            return !$hotel['parking'];
        } else {
            return true;
        }
    });
    
} 
$selectedFilter = isset($_GET['parking_filter']) ? $_GET['parking_filter'] : 'all';
$filteredHotels = filterHotelsByParking($hotels, $selectedFilter);
?>
<main class="container">
    <div class="row">
        <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <label for="filter_select">Filter by Parking:</label>
            <select class="form-select w-50 d-inline-block" name="parking_filter" id="filter_select">
                <option value="all" <?php if (!isset($_GET['parking_filter']) || $_GET['parking_filter'] === 'all') echo 'selected'; ?>>All Hotels</option>
                <option value="available" <?php if (isset($_GET['parking_filter']) && $_GET['parking_filter'] === 'available') echo 'selected'; ?>>Hotels with Parking</option>
                <option value="unavailable" <?php if (isset($_GET['parking_filter']) && $_GET['parking_filter'] === 'unavailable') echo 'selected'; ?>>Hotels without Parking</option>
            </select>
            <button class="btn btn-primary my-2" type="submit">Filter</button>
        </form>
        <table class="table">
            <thead>
                <tr>
                    <?php 
                    $headerKeys = array_keys($hotels[0]);
                    foreach ($headerKeys as $key) { ?>
                        <th scope="col"><?php echo ucfirst(str_replace('_', ' ', $key)) ?></th>
                    <?php } ?>    
                </tr> 
            </thead>
            <tbody>
                <?php foreach ($filteredHotels as $hotel) { ?>
                    <tr>
                        <th scope="row"><?php echo $hotel['name']; ?></th>
                        <td><?php echo $hotel['description']; ?></td>
                        <td><?php echo $hotel['parking']  ? 'Available' : 'No Parking'; ?></td>    
                        <td><?php echo $hotel['vote']; ?></td>
                        <td><?php echo $hotel['distance_to_center'].' km'; ?></td>
                    </tr>
                <?php } ?>  
            </tbody>
        </table>
    </div>
</main>

<?php include __DIR__. '/partials/footer.php'; ?>