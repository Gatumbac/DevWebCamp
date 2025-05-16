<h2 class="dashboard__heading"><?php echo $title ?></h2>

<div class="dashboard__baseContainer">
    <?php if(!empty($registrations)) { ?>
        <table class="table">
            <thead class="table__head">
                <tr>
                    <th scope="col" class="table__th">Nombre</th>
                    <th scope="col" class="table__th">Email</th>
                    <th scope="col" class="table__th">Paquete</th>
                </tr>
            </thead>
            <tbody class="table__body">
                <?php foreach($registrations as $registration): ?>
                    <tr class="table__tr">
                        <td class="table__td">
                            <?php echo $registration->getUserName() ?>
                        </td>
                        <td class="table__td">
                            <?php echo $registration->getUserEmail() ?>
                        </td>
                            <td class="table__td">
                            <?php echo $registration->getPackageName() ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p class="text-center">No existen usuarios registrados</p>
    <?php } ?>
</div>

<?php echo $pagination ?? ''; ?>