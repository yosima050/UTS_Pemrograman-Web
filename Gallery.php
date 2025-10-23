<?php
require 'db_config.php';

$photos = [];

try {
    $stmt = $pdo->query("SELECT title, image_url, price FROM photos ORDER BY id ASC");
    $photos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error: Gagal mengambil data galeri. " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri Foto</title>
    
    <style>
        
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #fff;
            color: #222;
            line-height: 1.6;
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #222;
            margin-bottom: 40px;
            font-size: 2.5rem;
            font-weight: 700;
        }
        .gallery-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            max-width: 1200px;
            margin: 20px auto;
        }
        .photo-item {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.2s ease;
        }
        .photo-item:hover {
            transform: scale(1.03);
        }
        .photo-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
        }
        .photo-details {
            padding: 15px;
            text-align: left;
        }
        .photo-details h3 {
            font-size: 1.2rem;
            color: #222;
            margin-top: 0;
            margin-bottom: 10px;
        }
        .photo-details .price {
            font-size: 1.1rem;
            font-weight: bold;
            color: #007BFF;
        }
    </style>
</head>
<body>

    <h1>Galeri Foto Kami</h1>

    <div class="gallery-container">
        
        <?php
        if (empty($photos)):
        ?>
            <p style="text-align: center; grid-column: 1 / -1;">Tidak ada foto untuk ditampilkan.</p>
        
        <?php
        else:
            foreach ($photos as $photo):
        ?>

            <div class="photo-item">
                <img src="<?php echo htmlspecialchars($photo['image_url']); ?>" alt="<?php echo htmlspecialchars($photo['title']); ?>">
                
                <div class="photo-details">
                    <h3><?php echo htmlspecialchars($photo['title']); ?></h3>
                    
                    <p class="price">
                        Rp <?php echo number_format($photo['price'], 0, ',', '.'); ?>
                    </p>
                </div>
            </div>

        <?php
            endforeach;
        endif;
        ?>

    </div> </body>
</html>