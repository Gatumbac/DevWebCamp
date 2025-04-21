<fieldset class="form__fieldset">
    <legend class="form__legend">Información Personal</legend>

    <div class="form__field">
        <label for="name" class="form__label">Nombre</label>
        <input 
            id="name"
            name="name"
            type="text"
            placeholder="Nombre Ponente"
            class="form__input"
            value="<?php echo s($speaker->getName()); ?>"
            required
        >
    </div>

    <div class="form__field">
        <label for="lastname" class="form__label">Apellido</label>
        <input 
            id="lastname"
            name="lastname"
            type="text"
            placeholder="Apellido Ponente"
            class="form__input"
            value="<?php echo s($speaker->getLastName()); ?>"
            required
        >
    </div>

    <div class="form__field">
        <label for="city" class="form__label">Ciudad</label>
        <input 
            id="city"
            name="city"
            type="text"
            placeholder="Ciudad Ponente"
            class="form__input"
            value="<?php echo s($speaker->getLastName()); ?>"
            required
        >
    </div>

    <div class="form__field">
        <label for="country" class="form__label">País</label>
        <input 
            id="country"
            name="country"
            type="text"
            placeholder="País Ponente"
            class="form__input"
            value="<?php echo s($speaker->getLastName()); ?>"
            required
        >
    </div>

    <div class="form__field">
        <label for="image" class="form__label">Imagen</label>
        <input 
            id="image"
            name="image"
            type="file"
            class="form__input form__input--file"
            required
        >
    </div>

</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Información Extra</legend>

    <div class="form__field">
        <label for="tags-input" class="form__label">Áreas de Experiencia (separadas por coma)</label>
        <input 
            id="tags-input"
            type="text"
            placeholder="Ej. Node.js, PHP, CSS, Laravel, UX/UI"
            class="form__input"
            required
        >

        <div id="tags" class="form__tagList"></div>

        <input type="hidden" name="tags" value="<?php echo '' ?>">
    </div>

</fieldset>

<fieldset class="form__fieldset">
    <legend class="form__legend">Redes Sociales</legend>

    <div class="form__field">
        <div class="form__iconContainer">
            <div class="form__icon">
                <i class="fa-brands fa-facebook"></i>
            </div>
            <input 
                type="text"
                placeholder="Facebook"
                class="form__input--social"
                name="networks[facebook]"
                value ="<?php echo ''; ?>"
                required
            >
        </div>
    </div>

    <div class="form__field">
        <div class="form__iconContainer">
            <div class="form__icon">
                <i class="fa-brands fa-twitter"></i>
            </div>
            <input 
                type="text"
                placeholder="Twitter"
                class="form__input--social"
                name="networks[twitter]"
                value ="<?php echo ''; ?>"
                required
            >
        </div>
    </div>

    <div class="form__field">
        <div class="form__iconContainer">
            <div class="form__icon">
                <i class="fa-brands fa-youtube"></i>
            </div>
            <input 
                type="text"
                placeholder="Youtube"
                class="form__input--social"
                name="networks[youtube]"
                value ="<?php echo ''; ?>"
                required
            >
        </div>
    </div>

    <div class="form__field">
        <div class="form__iconContainer">
            <div class="form__icon">
                <i class="fa-brands fa-instagram"></i>
            </div>
            <input 
                type="text"
                placeholder="Instagram"
                class="form__input--social"
                name="networks[instagram]"
                value ="<?php echo ''; ?>"
                required
            >
        </div>
    </div>

    <div class="form__field">
        <div class="form__iconContainer">
            <div class="form__icon">
                <i class="fa-brands fa-tiktok"></i>
            </div>
            <input 
                type="text"
                placeholder="TikTok"
                class="form__input--social"
                name="networks[tiktok]"
                value ="<?php echo ''; ?>"
                required
            >
        </div>
    </div>

    <div class="form__field">
        <div class="form__iconContainer">
            <div class="form__icon">
                <i class="fa-brands fa-github"></i>
            </div>
            <input 
                type="text"
                placeholder="GitHub"
                class="form__input--social"
                name="networks[github]"
                value ="<?php echo ''; ?>"
                required
            >
        </div>
    </div>

</fieldset>