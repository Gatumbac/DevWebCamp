<h2 class="dashboard__heading"><?php echo $title ?></h2>

<div class="dashboard__button-container">
    <a class="dashboard__button" href="/admin/ponentes/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Ponente
    </a>
</div>

<div class="dashboard__baseContainer">
    <?php if(!empty($speakers)) { ?>
        <table class="table">
            <thead class="table__head">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Ubicación</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__body">
                <?php foreach($speakers as $speaker): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $speaker->getFullName() ?>
                        </td>
                        <td class="table__td">
                            <?php echo $speaker->getLocation() ?>
                        </td>
                        <td class="table__td table__td--actions">
                            <a class="table__action table__action--update" href="/admin/ponentes/editar?id=<?php echo $speaker->getId(); ?>">
                                <i class="fa-solid fa-user-pen"></i>
                                Editar
                            </a>

                            <form action="/admin/ponentes/eliminar" method="POST" class="table__form">
                                <input type="hidden" name="id" value="<?php echo $speaker->getId(); ?>">
                                <button class="table__action table__action--delete" type="submit">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                    Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No existen ponentes registrados</p>
    <?php } ?>
</div>

<?php echo $pagination; ?>