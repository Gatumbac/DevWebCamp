<fieldset class="form__fieldset">
    <legend class="form__legend">Información Evento</legend>

    <div class="form__field">
        <label for="name" class="form__label">Nombre</label>
        <input 
            id="name"
            name="name"
            type="text"
            placeholder="Nombre Evento"
            class="form__input"
            value="<?php echo s($event->getName()); ?>"
            required
        >
    </div>

    <div class="form__field">
        <label for="description" class="form__label">Descripción</label>
        <textarea 
            id="description"
            name="description"
            placeholder="Descripción Evento"
            class="form__input"
            rows="8",
            required
        ><?php echo s($event->getDescription()); ?></textarea>
    </div>

    <div class="form__field">
        <label for="categories" class="form__label">Categoría o Tipo de Evento</label>
        <select name="category_id" id="categories" class="form__select">
            <option value="" selected disabled>--Seleccionar--</option>
            <?php foreach($categories as $category): ?>
                <option <?php echo ($event->getCategoryId() == $category->getId()) ? 'selected' : '' ?> value="<?php echo $category->getId() ?>"><?php echo $category->getName() ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form__field">
        <label for="" class="form__label">Selecciona el día</label>
        <div class="form__radio">
            <?php foreach($days as $day): ?>
                <div class="form__radioContainer">
                    <label for="<?php echo strtolower($day->getName()); ?>"><?php echo $day->getName(); ?></label>
                    <input 
                        id="<?php echo strtolower($day->getName()); ?>"
                        type="radio"
                        name="day_id"
                        value="<?php echo strtolower($day->getId()); ?>"
                    >
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div id="hours" class="form__field">
        <label for="" class="form__label">Selecciona la hora</label>
        
        <ul class="hours">
            <?php foreach($hours as $hour): ?>
                <li class="hour"><?php echo $hour->getHour() ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Información Extra</legend>

    <div class="form__field">
        <label for="speaker" class="form__label">Ponente</label>
        <input 
            id="speaker"
            type="text"
            placeholder="Buscar Ponente"
            class="form__input"
            required
        >
    </div>

    <div class="form__field">
        <label for="seatQuantity" class="form__label">Lugares Disponibles</label>
        <input 
            id="seatQuantity"
            name="seat_quantity"
            type="number"
            placeholder="Ej. 20"
            class="form__input"
            min="1"
            max="500"
            value="<?php echo s($event->getSeatQuantity()); ?>"
            required
        >
    </div>

</fieldset>
