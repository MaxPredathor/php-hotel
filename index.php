<?php include __DIR__. '/partials/header.php'; 
// var_dump($hotels);
?>

<main class="container">
    <div class="row">
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
                <?php foreach ($hotels as $hotel) { ?>
                    <tr>
                        <th scope="row"><?php echo $hotel['name']; ?></th>
                        <td><?php echo $hotel['description']; ?></td>
                        <td><?php if ($hotel['parking']) {  ?>
                                Avaliable 
                            <?php } else { ?>
                                No-Parking
                            <?php } ?>
                        </td>    
                        <td><?php echo $hotel['vote']; ?></td>
                        <td><?php echo $hotel['distance_to_center'].' km'; ?></td>
                    </tr>
                <?php } ?>  
            </tbody>
        </table>
    </div>
</main>

<?php include __DIR__. '/partials/footer.php'; ?>