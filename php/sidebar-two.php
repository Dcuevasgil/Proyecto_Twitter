<section class="lista-mis-publicaciones">
    <form action="../php/back-postear.php" method="post">
        <legend>Postear</legend>
        <fieldset>
            <input type="hidden" name="userId" value="
                <?php
                    echo $_SESSION['id']
                ?>
            ">
            <textarea name="text" placeholder="¿Que estas pensando?" required></textarea>
            <button type="submit" class="btn">Publicar </button>
        </fieldset>
    </form>
</section>