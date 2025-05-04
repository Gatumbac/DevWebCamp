<h2 class="dashboard__heading"><?php echo $title ?></h2>

<div class="dashboard__button-container">
    <a class="dashboard__button" href="/admin/eventos/crear">
        <i class="fa-solid fa-circle-plus"></i>
        Añadir Evento
    </a>
</div>

<?php
    require_once __DIR__ . '/../../templates/alerts.php';
?>

<div class="dashboard__baseContainer">
    <?php if(!empty($events)) { ?>
        <table class="table">
            <thead class="table__head">
                <tr>
                    <th scope="col" class="table__th">Event</th>
                    <th scope="col" class="table__th">Categoría</th>
                    <th scope="col" class="table__th">Fecha</th>
                    <th scope="col" class="table__th">Ponente</th>
                    <th scope="col" class="table__th"></th>
                </tr>
            </thead>
            <tbody class="table__body">
                <?php foreach($events as $event): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $event->getName() ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->getCategory() ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->getDay() . ' | ' . $event->getHour(); ?>
                        </td>
                        <td class="table__td">
                            <?php echo $event->getSpeaker() ?>
                        </td>
                        <td class="table__td table__td--actions">
                            <a class="table__action table__action--update" href="/admin/eventos/editar?id=<?php echo $event->getId(); ?>">
                                <i class="fa-solid fa-pencil"></i>
                                Editar
                            </a>

                            <form action="/admin/eventos/eliminar" method="POST" class="table__form">
                                <input type="hidden" name="id" value="<?php echo $event->getId(); ?>">
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
        <p class="text-center">No existen eventos registrados</p>
    <?php } ?>
</div>

<?php echo $pagination ?? ''; ?>