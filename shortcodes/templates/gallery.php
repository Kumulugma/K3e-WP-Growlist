<div class="photo-grid">
    <?php foreach ($photos as $photo) { ?>
        <a href="<?= $photo['src'] ?>" data-lightbox="<?= $photo['lightbox'] ?>" data-title="<?= $photo['title'] ?>">
            <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7" data-src="<?= $photo['thumb'] ?>" class="lazyload"/>
        </a> 
    <?php } ?>
</div>